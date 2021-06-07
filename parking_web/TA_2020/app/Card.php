<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'card';
    protected $primary_key = 'id_card';
    protected $guarded = [];

        public function pengguna()
    {
    	return $this->belongsTo('App\Pengguna', 'uid', 'uid');
    }
}
