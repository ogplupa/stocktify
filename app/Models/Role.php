<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nama tabel
    protected $fillable = [
        'name' // Kolom yang bisa diisi massal
    ];

    // Mendefinisikan relasi one-to-many dengan model User
    public function users(): HasMany
    {
        return $this->hasMany(User::class); // Memperbaiki hashMany menjadi hasMany
    }
}
