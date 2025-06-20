<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    /** @use HasFactory<\Database\Factories\PoliFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function dokters(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
