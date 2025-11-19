@extends('layouts.siswa')

@section('content')

<div class="bg-white shadow rounded-lg p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">📚 Data Siswa</h1>

        <div class="flex items-center gap-3">
            <a href="{{ route('siswa.export', request()->only(['search','lembaga_id'])) }}"
            class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
            Export Excel
            </a>

            <a href="{{ route('siswa.create') }}"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                + Tambah Siswa
            </a>
        </div>
    </div>



    {{-- FILTER --}}
    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">

        <input
            type="text"
            name="search"
            placeholder="Cari NIS / Nama"
            class="border-gray-300 rounded-lg w-full p-2 focus:ring-blue-500 focus:border-blue-500"
            value="{{ request('search') }}"
        >

        <select
            name="lembaga_id"
            class="border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
        >
            <option value="">Semua Lembaga</option>
            @foreach ($lembagas as $l)
                <option value="{{ $l->id }}" {{ request('lembaga_id') == $l->id ? 'selected' : '' }}>
                    {{ ucfirst($l->nama) }}
                </option>
            @endforeach
        </select>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow"
        >
            Filter
        </button>
    </form>


    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table id="table-siswa" class="min-w-full bg-white border rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-700">
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">NIS</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Lembaga</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($siswa as $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        @if ($s->foto)
                            <img src="{{ asset('storage/'.$s->foto) }}" class="w-12 h-12 object-cover rounded-md shadow">
                        @else
                            <span class="text-gray-400 text-sm">Tidak ada</span>
                        @endif
                    </td>

                    <td class="p-3">{{ $s->nis }}</td>
                    <td class="p-3 font-semibold text-gray-700">{{ $s->nama }}</td>
                    <td class="p-3">{{ $s->email }}</td>
                    <td class="p-3">{{ $s->lembaga->nama }}</td>

                    <td class="p-3">
                        <div class="flex items-center gap-3">

                            <a href="{{ route('siswa.edit', $s->id) }}"
                                class="text-blue-600 hover:underline">
                                Edit
                            </a>

                            <form action="{{ route('siswa.destroy', $s->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


{{-- DATATABLES --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $('#table-siswa').DataTable({
        "pageLength": 10,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan _PAGE_ dari _PAGES_",
            "paginate": {
                "previous": "Prev",
                "next": "Next"
            }
        }
    });
</script>

@endsection
