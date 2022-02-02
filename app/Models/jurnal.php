<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    use HasFactory;
    protected $table ='jurnal';
    protected $fillable =['id_pemasukan','id_pengeluaran','tgl','ref','debit','kredit','ket'];
    protected $primarykey = 'id';
}
