<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventaris;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'inventaris_id', // GANTI dari asset_id
        'user_id',
        'type',
        'quantity',
        'date',
    ];

    public $timestamps = false;

    // Relasi ke tabel inventaris
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class); // GANTI dari Asset::class
    }

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
