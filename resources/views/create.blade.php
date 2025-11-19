@extends('layouts.siswa')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Tambah Siswa</h1>

    <form method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label>Lembaga</label>
            <select name="lembaga_id" class="border p-2 w-full" required>
                @foreach ($lembagas as $l)
                <option value="{{ $l->id }}">{{ $l->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>NIS</label>
            <input type="text" name="nis" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Nama</label>
            <input type="text" name="nama" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Foto (JPG/PNG max 100KB)</label>
            <input type="file" name="foto" class="border p-2 w-full">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>

</div>
@endsection
