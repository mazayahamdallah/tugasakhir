<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primary_key = 'nim';
    protected $guarded = [];

    public function parkir()
    {
    	return $this->hasMany('App\Parkir', 'nim', 'nim');
    }
}
