@extends('layouts.app')

@section('title', 'Perbandingan Alternatif')

@section('content')
    @php
        // Di aplikasi nyata, variabel ini akan dikirim dari ComparisonController.
        // Variabel $period, $alternatives, $currentCriterion, dan $saatyOptions diasumsikan sudah ada.
    @endphp

    <x-page-content maxWidth="5xl">
        <form action="{{ route('member.comparisons.alternatives.store') }}" method="POST">
            @csrf
            <x-card>
                <x-slot name="header">
                    <div class="text-center">
                        <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold leading-tight">
                            Matriks Perbandingan Antar Alternatif
                        </h2>
                        <p class="text-md text-on-surface mt-1">
                            Berdasarkan Kriteria: <span class="font-bold">{{ $currentCriterion->name }}</span>
                        </p>
                    </div>
                </x-slot>

                <div>
                    <input name="criterion_id" type="hidden" value="{{ $currentCriterion->id }}">

                    <x-table>
                        <x-slot name="head">
                            <th class="p-4" scope="col">Kandidat</th>
                            @foreach ($alternatives as $alternative)
                                <th class="p-4 text-center" scope="col">{{ $alternative->name }}</th>
                            @endforeach
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($alternatives as $rowAlternative)
                                <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                                    <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium"
                                        scope="row">
                                        {{ $rowAlternative->name }}
                                    </th>
                                    @foreach ($alternatives as $colAlternative)
                                        <td class="p-4 text-center">
                                            @if ($rowAlternative->id === $colAlternative->id)
                                                <span
                                                    class="rounded-radius border-outline bg-surface-alt dark:bg-surface-dark-alt/50 text-on-surface-strong dark:text-on-surface-dark-strong inline-block w-full border px-4 py-2 text-sm font-semibold opacity-50">1</span>
                                            @elseif ($rowAlternative->id < $colAlternative->id)
                                                @php $key = $rowAlternative->id . '_' . $colAlternative->id; @endphp
                                                <div class="relative w-full">
                                                    <select
                                                        class="rounded-radius border-outline bg-surface-alt dark:bg-surface-dark-alt/50 text-on-surface dark:text-on-surface-dark w-full appearance-none border px-4 py-2 text-sm"
                                                        id="comp-{{ $key }}"
                                                        name="comparisons[{{ $key }}][value]"
                                                        onchange="updateReciprocal('{{ $rowAlternative->id }}', '{{ $colAlternative->id }}')">
                                                        @foreach ($saatyOptions as $option)
                                                            <option {{ $option['value'] == '1' ? 'selected' : '' }}
                                                                value="{{ $option['value'] }}">
                                                                {{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input name="comparisons[{{ $key }}][item1_id]" type="hidden"
                                                        value="{{ $rowAlternative->id }}">
                                                    <input name="comparisons[{{ $key }}][item2_id]" type="hidden"
                                                        value="{{ $colAlternative->id }}">
                                                </div>
                                            @else
                                                @php $key = $rowAlternative->id . '_' . $colAlternative->id; @endphp
                                                <span
                                                    class="rounded-radius border-outline bg-surface-alt dark:bg-surface-dark-alt/50 text-on-surface-strong dark:text-on-surface-dark-strong inline-block w-full border px-4 py-2 text-sm font-semibold opacity-50"
                                                    id="comp-{{ $key }}">1</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>

                    <x-slot name="footer">
                        <div class="flex w-full items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-on-surface dark:text-on-surface-dark text-sm font-medium">Consistency
                                    Ratio (CR):</span>
                                <span class="text-sm font-bold" id="cr-value"></span>
                                <div id="cr-consistent" style="display: none;"><x-status
                                        intent="completed">Konsisten</x-status></div>
                                <div id="cr-inconsistent" style="display: none;"><x-status intent="danger">Tidak
                                        Konsisten</x-status></div>
                            </div>

                            <div class="flex items-center justify-end">
                                <x-button-link href="{{ route('member.comparisons.create') }}"
                                    variant="outline">Kembali</x-button-link>
                                <x-form.button class="ml-4">Lanjut</x-form.button>
                            </div>
                        </div>
                    </x-slot>
                </div>
            </x-card>
        </form>
    </x-page-content>
@endsection

@push('scripts')
    <script>
        const items = @json($alternatives);
        const itemIds = items.map(c => c.id);
        const n = items.length;
        const randomIndex = {
            1: 0,
            2: 0,
            3: 0.58,
            4: 0.90,
            5: 1.12,
            6: 1.24,
            7: 1.32,
            8: 1.41,
            9: 1.45,
            10: 1.49
        };

        function getReciprocal(value) {
            if (!value || value === '1') return '1';
            if (String(value).startsWith('1/')) return String(value).split('/')[1];
            return `1/${value}`;
        }

        function parseValue(value) {
            if (String(value).startsWith('1/')) {
                return 1 / parseFloat(String(value).split('/')[1]);
            }
            return parseFloat(value);
        }

        function updateReciprocal(rowId, colId) {
            const sourceElement = document.getElementById(`comp-${rowId}_${colId}`);
            const targetElement = document.getElementById(`comp-${colId}_${rowId}`);
            if (sourceElement && targetElement) {
                targetElement.textContent = getReciprocal(sourceElement.value);
            }
            calculateCR();
        }

        function calculateCR() {
            const matrix = itemIds.map(rowId => {
                return itemIds.map(colId => {
                    if (rowId === colId) return 1;
                    const element = document.getElementById(`comp-${rowId}_${colId}`);
                    if (element) {
                        return parseValue(element.value || element.textContent);
                    } else {
                        const inverseElement = document.getElementById(`comp-${colId}_${rowId}`);
                        return parseValue(getReciprocal(inverseElement.value || inverseElement
                            .textContent));
                    }
                });
            });

            const columnSums = new Array(n).fill(0);
            for (let j = 0; j < n; j++) {
                for (let i = 0; i < n; i++) {
                    columnSums[j] += matrix[i][j];
                }
            }

            const normalizedMatrix = matrix.map(row => row.map((val, j) => val / columnSums[j]));
            const priorityVector = normalizedMatrix.map(row => row.reduce((a, b) => a + b, 0) / n);

            let lambdaMax = 0;
            for (let j = 0; j < n; j++) {
                let weightedSum = 0;
                for (let i = 0; i < n; i++) {
                    weightedSum += matrix[j][i] * priorityVector[i];
                }
                lambdaMax += weightedSum / priorityVector[j];
            }
            lambdaMax /= n;

            const consistencyIndex = (lambdaMax - n) / (n - 1);
            const ri = randomIndex[n] || 1.49;
            const consistencyRatio = (ri === 0) ? 0 : consistencyIndex / ri;

            const crValueEl = document.getElementById('cr-value');
            const consistentStatusEl = document.getElementById('cr-consistent');
            const inconsistentStatusEl = document.getElementById('cr-inconsistent');

            crValueEl.textContent = consistencyRatio.toFixed(4);

            if (consistencyRatio < 0.1) {
                consistentStatusEl.style.display = 'inline-flex';
                inconsistentStatusEl.style.display = 'none';
            } else {
                inconsistentStatusEl.style.display = 'inline-flex';
                consistentStatusEl.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', calculateCR);
    </script>
@endpush
