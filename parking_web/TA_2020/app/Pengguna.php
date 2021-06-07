<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primary_key = 'uid';
    protected $guarded = [];

    public function card()
    {
    	return $this->hasMany('App\Card', 'uid', 'uid');
    }
}
