<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    use HasFactory;
    protected $table='pemasukan';
    protected $fillable=['tanggal','ket_pemasukkan','nominal'];
    protected $primarykey ='id_pemasukan';
}
