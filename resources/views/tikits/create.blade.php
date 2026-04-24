@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl border border-gray-200 p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Buat Tiket Baru</h2>

    <form action="{{ route('tikits.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm text-gray-600 mb-1">Judul *</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                   placeholder="Nama masalah...">
            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi *</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                      placeholder="Jelaskan masalahnya...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Kategori</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    @foreach(['PC','Printer','Jaringan','Software','Lainnya'] as $k)
                        <option {{ old('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Prioritas</label>
                <select name="prioritas" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="rendah">Rendah</option>
                    <option value="sedang" selected>Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="open">Open</option>
                    <option value="in-progress">In Progress</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('tikits.index') }}"
               class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Batal</a>
            <button type="submit"
                    class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection