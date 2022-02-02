<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sewer extends Model
{
    use HasFactory;
    protected $table='sewer';
    protected $fillable=['nip','nama','tgl_lahir','alamat','no_hp','jenis_kelamin','posisi','image'];
    protected $primaryKey = 'id_sewer';
}
