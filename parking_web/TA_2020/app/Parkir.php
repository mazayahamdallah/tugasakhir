<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $table = 'track_plat';
    protected $primary_key = 'id_track';
    protected $guarded = [];

    //     public function mahasiswa()
    // {
    // 	return $this->belongsTo('App\Mahasiswa', 'nim', 'nim');
    // }
}
