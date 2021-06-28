<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatNomor extends Model
{
    protected $table = 'plat_nomor';
    protected $primary_key = 'text_plat';
    protected $guarded = [];

    public function track_plat()
    {
    	return $this->hasMany('App\TrackPlat', 'plat_no', 'text_plat');
    }
}
