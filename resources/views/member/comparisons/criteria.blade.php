@extends('layouts.app')

@section('title', 'Perbandingan Kriteria')

@section('content')
    @php
        // Simulasi data dari Controller
        $criteria = [
            ['id' => 1, 'name' => 'Komunikasi'],
            ['id' => 2, 'name' => 'Kontribusi'],
            ['id' => 3, 'name' => 'Pengalaman'],
        ];
        $saatyOptions = [
            ['value' => '9', 'label' => '9 - Mutlak Lebih Penting'],
            ['value' => '7', 'label' => '7 - Sangat Lebih Penting'],
            ['value' => '5', 'label' => '5 - Lebih Penting'],
            ['value' => '3', 'label' => '3 - Cukup Lebih Penting'],
            ['value' => '1', 'label' => '1 - Sama Penting'],
            ['value' => '1/3', 'label' => '1/3 - Cukup Kurang Penting'],
            ['value' => '1/5', 'label' => '1/5 - Kurang Penting'],
            ['value' => '1/7', 'label' => '1/7 - Sangat Kurang Penting'],
            ['value' => '1/9', 'label' => '1/9 - Mutlak Kurang Penting'],
        ];
    @endphp

    <x-page-content maxWidth="5xl">
        <x-card>
            <x-slot name="header">
                <div class="text-center">
                    <h2 class="text-on-surface-strong dark:text-on-surface-dark-strong text-2xl font-bold leading-tight">
                        Matriks Perbandingan Antar Kriteria</h2>
                    <p class="text-md text-on-surface-dark mt-1">Seberapa penting satu kriteria dibandingkan dengan kriteria
                        lainnya?</p>
                </div>
            </x-slot>

            <div>
                <form action="#" method="POST">
                    <x-table>
                        <x-slot name="head">
                            <th class="p-4" scope="col">Kriteria</th>
                            @foreach ($criteria as $criterion)
                                <th class="p-4 text-center" scope="col">{{ $criterion['name'] }}</th>
                            @endforeach
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($criteria as $rowCriterion)
                                <tr class="hover:bg-surface-alt/50 dark:hover:bg-surface-dark-alt/50">
                                    <th class="text-on-surface-strong dark:text-on-surface-dark-strong p-4 font-medium"
                                        scope="row">{{ $rowCriterion['name'] }}</th>
                                    @foreach ($criteria as $colCriterion)
                                        <td class="p-4 text-center">
                                            @if ($rowCriterion['id'] === $colCriterion['id'])
                                                <span
                                                    class="rounded-radius border-outline bg-surface-alt dark:bg-surface-dark-alt/50 text-on-surface-strong dark:text-on-surface-dark-strong inline-block w-full border px-4 py-2 text-sm font-semibold opacity-50">1</span>
                                            @elseif ($rowCriterion['id'] < $colCriterion['id'])
                                                @php $key = $rowCriterion['id'] . '_' . $colCriterion['id']; @endphp
                                                {{-- Ganti combobox dengan select standar & tambahkan onchange --}}
                                                <div class="relative w-full">
                                                    <svg ... class="... pointer-events-none absolute">...</svg>
                                                    <select
                                                        class="rounded-radius border-outline bg-surface-alt dark:bg-surface-dark-alt/50 text-on-surface dark:text-on-surface-dark w-full appearance-none border px-4 py-2 text-sm"
                                                        id="comp-{{ $key }}"
                                                        name="comparison[{{ $rowCriterion['id'] }}][{{ $colCriterion['id'] }}]"
                                                        onchange="updateReciprocal('{{ $rowCriterion['id'] }}', '{{ $colCriterion['id'] }}')">
                                                        @foreach ($saatyOptions as $option)
                                                            <option {{ $option['value'] == '1' ? 'selected' : '' }}
                                                                value="{{ $option['value'] }}">{{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                @php $key = $rowCriterion['id'] . '_' . $colCriterion['id']; @endphp
                                                {{-- Beri id unik pada span reciprocal --}}
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

                                <div id="cr-consistent" style="display: none;">
                                    <x-status intent="completed">Konsisten</x-status>
                                </div>

                                <div id="cr-inconsistent" style="display: none;">
                                    <x-status intent="danger">Tidak Konsisten</x-status>
                                </div>
                            </div>

                            <div class="flex items-center justify-end">
                                <x-button-link href="#" variant="outline">Batal</x-button-link>
                                <x-form.button class="ml-4">Simpan & Lanjutkan</x-form.button>
                            </div>
                        </div>
                    </x-slot>
                </form>
            </div>
        </x-card>
    </x-page-content>


@endsection

@push('scripts')
    <script>
        const criteria = @json($criteria);
        const criteriaIds = criteria.map(c => c.id);
        const n = criteria.length;

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
                const reciprocalValue = getReciprocal(sourceElement.value);
                targetElement.textContent = reciprocalValue;
            }

            calculateCR();
        }

        function calculateCR() {
            const matrix = criteriaIds.map(rowId => {
                return criteriaIds.map(colId => {
                    if (rowId === colId) return 1;

                    const element = document.getElementById(`comp-${rowId}_${colId}`);
                    // Jika elemen ada (input/span), ambil nilainya. Jika tidak, ambil kebalikannya.
                    if (element) {
                        return parseValue(element.value || element.textContent);
                    } else {
                        const inverseElement = document.getElementById(`comp-${colId}_${rowId}`);
                        return parseValue(getReciprocal(inverseElement.value || inverseElement
                            .textContent));
                    }
                });
            });

            // Step 2: Hitung jumlah setiap kolom
            const columnSums = new Array(n).fill(0);
            for (let j = 0; j < n; j++) {
                for (let i = 0; i < n; i++) {
                    columnSums[j] += matrix[i][j];
                }
            }

            // Step 3: Normalisasi matriks
            const normalizedMatrix = matrix.map(row => row.map((val, j) => val / columnSums[j]));

            // Step 4: Hitung Priority Vector (Eigenvector) dengan rata-rata baris
            const priorityVector = normalizedMatrix.map(row => row.reduce((a, b) => a + b, 0) / n);

            // Step 5: Hitung Lambda Max (λmax)
            let lambdaMax = 0;
            for (let j = 0; j < n; j++) {
                let weightedSum = 0;
                for (let i = 0; i < n; i++) {
                    weightedSum += matrix[j][i] * priorityVector[i];
                }
                lambdaMax += weightedSum / priorityVector[j];
            }
            lambdaMax /= n;

            // Step 6: Hitung Consistency Index (CI)
            const consistencyIndex = (lambdaMax - n) / (n - 1);

            // Step 7: Hitung Consistency Ratio (CR)
            const ri = randomIndex[n] || 1.49; // Default ke 1.49 jika n > 10
            const consistencyRatio = (ri === 0) ? 0 : consistencyIndex / ri;

            // Step 8: Tampilkan hasil ke UI
            const crValueEl = document.getElementById('cr-value');
            const consistentStatusEl = document.getElementById('cr-consistent');
            const inconsistentStatusEl = document.getElementById('cr-inconsistent');

            crValueEl.textContent = consistencyRatio.toFixed(4);

            if (consistencyRatio < 0.1) {
                // Tampilkan komponen 'Konsisten' dan sembunyikan yang lain
                consistentStatusEl.style.display = 'inline-flex';
                inconsistentStatusEl.style.display = 'none';
            } else {
                // Tampilkan komponen 'Tidak Konsisten' dan sembunyikan yang lain
                inconsistentStatusEl.style.display = 'inline-flex';
                consistentStatusEl.style.display = 'none';
            }
        }

        // Jalankan kalkulasi saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', calculateCR);
    </script>
@endpush
