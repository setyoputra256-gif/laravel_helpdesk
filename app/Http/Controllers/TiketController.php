<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index(Request $request)
{
    $query = Tiket::latest();

    if ($request->filled('status')) { // ← pakai filled(), bukan cek string kosong
        $query->where('status', $request->status);
    }

    $tikits = $query->paginate(10);

    return view('tikits.index', compact('tikits'));
}

    public function create()
    {
        return view('tikits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status'    => 'required|in:open,in-progress,closed',
        ]);

        Tiket::create($request->all());

        return redirect()->route('tikits.index')
                         ->with('success', 'Tiket berhasil dibuat!');
    }

    public function show(Tiket $tikit)
    {
        return view('tikits.show', compact('tikit'));
    }

    public function edit(Tiket $tikit)
    {
        return view('tikits.edit', compact('tikit'));
    }

    public function update(Request $request, Tiket $tikit)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status'    => 'required|in:open,in-progress,closed',
        ]);

        $tikit->update($request->all());

        return redirect()->route('tikits.index')
                         ->with('success', 'Tiket berhasil diperbarui!');
    }

    public function destroy(Tiket $tikit)
    {
        $tikit->delete();

        return redirect()->route('tikits.index')
                         ->with('success', 'Tiket berhasil dihapus!');
    }
    public function updateStatus(Request $request, Tiket $tikit)
{
    $request->validate([
        'status' => 'required|in:open,in-progress,closed',
    ]);

    $tikit->update(['status' => $request->status]);

    return redirect()->route('tikits.index')
                     ->with('success', 'Status berhasil diperbarui!');
}

    public function userForm()
{
    return view('user.buat-tiket');
}
public function userStore(Request $request)
{
    $validated = $request->validate([
        'judul'     => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'kategori'  => 'required|string',
    ]);

    // Status & prioritas otomatis diset default
    $validated['prioritas'] = 'sedang';
    $validated['status']    = 'open';

    Tiket::create($validated);

    return redirect()->route('user.form')
                     ->with('success', 'Tiket berhasil dikirim! Tim kami akan segera menangani.');
}
}