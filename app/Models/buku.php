<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'isbn',
        'penulis',
        'tahun_terbit'
    ];

    protected $guarded = [
        'id'
    ];
}
