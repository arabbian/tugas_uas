<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table ='produk';
    protected $primarykey ='id_produk';
    public $timestaps = null;
    public $fillable =[
        'nama_produk', 'merek', 'harga', 'jumlah'
    ];
}
