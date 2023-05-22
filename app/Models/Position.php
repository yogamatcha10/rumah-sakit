<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Position extends Model
{
    use HasFactory;

    //protected $table = 'departements'; // Nama tabel departements


    protected $fillable = ['name', 'keterangan', 'alias'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
