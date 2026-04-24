<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tikits'; // nama tabel di database

    protected $fillable = [
        'judul', 'deskripsi', 'kategori', 'prioritas', 'status'
    ];
}
