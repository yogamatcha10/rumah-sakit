<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokters';

    protected $fillable = [
    'no_resep', 
    'nama_dokter', 
    'tgl_praktik', 
    'spesialis'
];

public function detail()
{
    return $this->hasMany(Detail::class, 'no_resep', 'no_resep');
}
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
