<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $table = 'parkirs';
    protected $primary_key = 'id_parkir';
    protected $guarded = [];

        public function mahasiswa()
    {
    	return $this->belongsTo('App\Mahasiswa', 'nim', 'nim');
    }
}
