<?php

namespace App\Exports;

use App\Models\Siswa;

class SiswaCsvExport
{
    public static function generate($filters)
    {
        $query = Siswa::query();

        if (!empty($filters['lembaga_id'])) {
            $query->where('lembaga_id', $filters['lembaga_id']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'LIKE', "%$search%")
                  ->orWhere('nama', 'LIKE', "%$search%");
            });
        }

        $data = $query->get();

        $filename = 'siswa_export_' . date('Ymd_His') . '.csv';
        $handle = fopen($filename, 'w');

        // Header CSV
        fputcsv($handle, ['NIS', 'Nama', 'Email', 'Lembaga']);

        // Isi CSV
        foreach ($data as $s) {
            fputcsv($handle, [
                $s->nis,
                $s->nama,
                $s->email,
                $s->lembaga->nama,
            ]);
        }

        fclose($handle);

        return $filename;
    }
}
