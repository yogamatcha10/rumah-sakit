<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class UserD extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'departement',
    ];
    // ...

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // ...
}
