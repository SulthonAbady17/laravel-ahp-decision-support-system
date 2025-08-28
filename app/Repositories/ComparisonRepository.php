<?php

namespace App\Repositories;

use App\Data\Comparison\StoreComparisonData;
use App\Models\ComparisonInput;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ComparisonRepository
{
    /**
     * Menyimpan seluruh set data perbandingan dari seorang pengguna untuk satu periode.
     */
    public function storeForUser(StoreComparisonData $data, User $user): void
    {
        // Gunakan transaksi database untuk memastikan semua data berhasil disimpan atau tidak sama sekali.
        DB::transaction(function () use ($data, $user) {

            // Hapus data lama pengguna ini untuk periode ini (jika ada) agar tidak duplikat.
            ComparisonInput::where('user_id', $user->id)
                ->where('selection_period_id', $data->periodId)
                ->delete();

            // Gabungkan kedua array perbandingan menjadi satu untuk disimpan.
            $allComparisons = array_merge(
                $this->prepareData($data->criteriaComparisons, 'criterion'),
                $this->prepareData($data->alternativeComparisons, 'alternative')
            );

            // Tambahkan user_id dan period_id ke setiap baris data.
            $dataToInsert = array_map(function ($item) use ($user, $data) {
                $item['user_id'] = $user->id;
                $item['selection_period_id'] = $data->periodId;
                $item['created_at'] = now();
                $item['updated_at'] = now();

                return $item;
            }, $allComparisons);

            // Simpan semua data sekaligus dengan satu query.
            ComparisonInput::insert($dataToInsert);
        });
    }

    /**
     * Helper untuk memformat data dari DTO agar sesuai dengan kolom database.
     */
    private function prepareData(array $comparisonItems, string $type): array
    {
        $prepared = [];
        foreach ($comparisonItems as $item) {
            $prepared[] = [
                'comparison_type' => $type,
                'criterion_id' => $item->criterionId,
                'item_1_id' => $item->item1Id,
                'item_2_id' => $item->item2Id,
                'value' => $this->parseValueForStorage($item->value),
            ];
        }

        return $prepared;
    }

    /**
     * Helper untuk mengubah nilai pecahan menjadi integer sesuai desain database kita.
     */
    private function parseValueForStorage(string $value): int
    {
        if (str_contains($value, '/')) {
            return (int) explode('/', $value)[1];
        }

        return (int) $value;
    }
}
