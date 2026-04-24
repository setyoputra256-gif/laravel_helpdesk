@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Daftar Tiket</h2>
</div>

{{-- Filter Status --}}
<div class="flex gap-2 mb-4">
    <a href="{{ route('tikits.index') }}"
       class="px-4 py-1.5 rounded-full text-sm border {{ !request('status') ? 'bg-indigo-100 text-indigo-700 border-indigo-300 font-medium' : 'bg-white text-gray-500 border-gray-200' }}">
        Semua
    </a>
    <a href="{{ route('tikits.index', ['status' => 'open']) }}"
       class="px-4 py-1.5 rounded-full text-sm border {{ request('status') == 'open' ? 'bg-indigo-100 text-indigo-700 border-indigo-300 font-medium' : 'bg-white text-gray-500 border-gray-200' }}">
        Open
    </a>
    <a href="{{ route('tikits.index', ['status' => 'in-progress']) }}"
       class="px-4 py-1.5 rounded-full text-sm border {{ request('status') == 'in-progress' ? 'bg-indigo-100 text-indigo-700 border-indigo-300 font-medium' : 'bg-white text-gray-500 border-gray-200' }}">
        In Progress
    </a>
    <a href="{{ route('tikits.index', ['status' => 'closed']) }}"
       class="px-4 py-1.5 rounded-full text-sm border {{ request('status') == 'closed' ? 'bg-indigo-100 text-indigo-700 border-indigo-300 font-medium' : 'bg-white text-gray-500 border-gray-200' }}">
        Closed
    </a>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Judul</th>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Deskripsi</th>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Kategori</th>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Prioritas</th>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Status</th>
                <th class="text-left px-5 py-3 text-gray-500 font-medium">Tanggal</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tikits as $tikit)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 font-medium text-gray-800">{{ $tikit->judul }}</td>
                <td class="px-5 py-3 text-gray-600">{{ Str::limit($tikit->deskripsi, 40) }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $tikit->kategori }}</td>

                {{-- Prioritas --}}
                <td class="px-5 py-3">
                    @if($tikit->prioritas == 'tinggi')
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tinggi</span>
                    @elseif($tikit->prioritas == 'sedang')
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Sedang</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Rendah</span>
                    @endif
                </td>

                {{-- Status --}}
                <td class="px-5 py-3">
                <form action="{{ route('tikits.updateStatus', $tikit->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()"
                            class="text-xs border rounded-full px-2 py-1 focus:outline-none cursor-pointer
                            @if($tikit->status == 'open') bg-blue-100 text-blue-800 border-blue-200
                            @elseif($tikit->status == 'in-progress') bg-amber-100 text-amber-800 border-amber-200
                            @else bg-red-100 text-red-800 border-red-200 @endif">
                        <option value="open"        {{ $tikit->status == 'open'        ? 'selected' : '' }}>Open</option>
                        <option value="in-progress" {{ $tikit->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="closed"      {{ $tikit->status == 'closed'      ? 'selected' : '' }}>Closed</option>
                    </select>
                </form>
                </td>

                <td class="px-5 py-3 text-gray-400 text-xs">{{ $tikit->created_at->format('d M Y') }}</td>

                {{-- Aksi --}}
                <td class="px-5 py-3">
                    <div class="flex gap-2 justify-end">

                        <form action="{{ route('tikits.destroy', $tikit) }}" method="POST"
                              onsubmit="return confirm('Hapus tiket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 border border-red-200 rounded text-xs text-red-600 hover:bg-red-50">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-10 text-gray-400">Belum ada tiket</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $tikits->links() }}</div>
@endsection