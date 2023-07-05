<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table ='pelanggan';
    protected $primarykey ='id_pelanggan';
    public $timestaps = false;
    public $fillable =[
        'nama_pelanggan', 'alamat', 'no_hp'
    ];
}
