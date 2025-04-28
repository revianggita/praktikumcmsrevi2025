<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tentukan atribut mana saja yang bisa diisi melalui mass assignment
    protected $fillable = [
        'asset_id', // Kolom yang bisa diisi
        'user_id',  // Kolom yang bisa diisi
        'type',     // Kolom yang bisa diisi
        'quantity', // Kolom yang bisa diisi
        'date',     // Kolom yang bisa diisi
    ];
    public $timestamps = false;
    public function asset()
    {
        return $this->belongsTo(Asset::class);  // Transaction belongs to Asset
    }

    /**
     * Relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);  // Transaction belongs to User
    }
}