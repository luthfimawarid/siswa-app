<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Siswa::with('lembaga');

        // FILTER LEMBAGA
        if ($this->filters['lembaga_id']) {
            $query->where('lembaga_id', $this->filters['lembaga_id']);
        }

        // FILTER SEARCH
        if ($this->filters['search']) {
            $query->where(function ($q) {
                $q->where('nis', 'LIKE', "%{$this->filters['search']}%")
                  ->orWhere('nama', 'LIKE', "%{$this->filters['search']}%");
            });
        }

        return $query->get()->map(function ($s) {
            return [
                'NIS'     => $s->nis,
                'Nama'    => $s->nama,
                'Email'   => $s->email,
                'Lembaga' => $s->lembaga->nama,
            ];
        });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Email', 'Lembaga'];
    }
}
