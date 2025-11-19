<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model {
    protected $fillable = ['nama'];

    public function siswas() {
        return $this->hasMany(Siswa::class);
    }
}

