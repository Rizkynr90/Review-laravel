<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    // protected $table = 'walis';

    protected $fillable = ['nama', 'id_mahasiswa'];

    public function mahasiswa()
    {
        // data dari model wali bisa dimiliki oleh model mahasiswa melalui foreign key 'id_mahasiswa;
        return $this->belongsTo('App\Models\Mahasiswa', 'id_mahasiswa');
    }
}
