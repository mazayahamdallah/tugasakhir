<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'card';
    protected $primary_key = 'id_card';
    protected $guarded = [];

    // public function parkir()
    // {
    // 	return $this->hasMany('App\Parkir', 'nim', 'nim');
    // }
}
