@extends('layouts.app')
@section('content')
{{-- Sama dengan create.blade.php --}}
{{-- Ganti action & tambahkan @method('PUT') --}}
<form action="{{ route('tikits.update', $tikit) }}" method="POST" ...>
    @csrf
    @method('PUT')
    {{-- Isi value dari $tikit --}}
    <input name="judul" value="{{ old('judul', $tikit->judul) }}" ...>
    ...
</form>
@endsection