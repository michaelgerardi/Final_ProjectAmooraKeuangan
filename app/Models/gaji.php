<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    use HasFactory;
    protected $table='gaji';
    protected $fillable=['id_sewer','gaji','jenis_gaji','tgl_gaji'];
    protected $primaryKey = 'id_gaji';
    public function sewer(){
        return $this->belongsTo('App\Models\sewer');
    }
}
