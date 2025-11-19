@extends('layouts.siswa')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Edit Siswa</h1>

    <form method="POST" action="{{ route('siswa.update', $siswa->id) }}"
          enctype="multipart/form-data" class="space-y-4">

        @csrf
        @method('PUT')

        <div>
            <label>Lembaga</label>
            <select name="lembaga_id" class="border p-2 w-full" required>
                @foreach ($lembagas as $l)
                    <option value="{{ $l->id }}" {{ $l->id == $siswa->lembaga_id ? 'selected' : '' }}>
                        {{ $l->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>NIS</label>
            <input type="text" name="nis" class="border p-2 w-full" value="{{ $siswa->nis }}" required>
        </div>

        <div>
            <label>Nama</label>
            <input type="text" name="nama" class="border p-2 w-full" value="{{ $siswa->nama }}" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" class="border p-2 w-full" value="{{ $siswa->email }}" required>
        </div>

        <div>
            <label>Foto Baru</label>
            <input type="file" name="foto" class="border p-2 w-full">
            @if ($siswa->foto)
                <img src="{{ asset('storage/'.$siswa->foto) }}" class="w-16 mt-2">
            @endif
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>
@endsection
