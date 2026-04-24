@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Buat Tiket Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Laporkan masalah kamu, tim kami akan segera menangani.</p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700 flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Judul Masalah <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul"
                       value="{{ old('judul') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                       placeholder="Contoh: PC tidak bisa menyala">
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    @foreach(['PC', 'Printer', 'Jaringan', 'Software', 'Lainnya'] as $k)
                        <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Deskripsi Masalah <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" rows="5"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                          placeholder="Jelaskan masalah secara detail...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end pt-2">
                <button type="submit"
                        class="px-6 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                    Kirim Tiket
                </button>
            </div>

        </form>
    </div>

</div>
@endsection