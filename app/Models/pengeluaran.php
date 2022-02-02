<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;
    protected $table='pengeluaran';
    protected $fillable=['ket_pengeluaran','jml_pengeluaran','tgl_pengeluaran'];
    protected $primarykey='id_pengeluaran';
}
