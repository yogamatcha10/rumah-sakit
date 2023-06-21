<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'no_resep',
        'id_obat',
        'qty',
        'harga',
        'sub_total',
    ];
    public function getObat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }
}
