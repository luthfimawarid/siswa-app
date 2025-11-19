@extends('layouts.siswa')

@section('content')

<div class="bg-white p-6 rounded-lg shadow max-w-5xl mx-auto">

    <h1 class="text-xl font-semibold mb-6">👤 Edit Profil Kandidat</h1>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.kandidat.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="flex items-center gap-6">
            @if ($user->image)
                <img src="{{ asset('storage/'.$user->image) }}"
                     class="w-24 h-24 object-cover shadow">
            @else
                <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center">
                    No Image
                </div>
            @endif

            <input type="file" name="image"
                   class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-medium">Posisi</label>
            <input type="text" name="position" value="{{ $user->position }}"
                   class="border p-2 rounded w-full">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>

    </form>

</div>

@endsection
