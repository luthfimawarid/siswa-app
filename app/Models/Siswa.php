<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model {
    protected $fillable = ['lembaga_id','nis','nama','email','foto'];

    public function lembaga() {
        return $this->belongsTo(Lembaga::class);
    }
}
