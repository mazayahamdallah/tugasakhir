<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackPlat extends Model
{
    protected $table = 'track_plat';
    protected $primary_key = 'id_track';
    protected $guarded = [];

        public function plat_nomor()
    {
    	return $this->belongsTo('App\PlatNomor', 'plat_no', 'text_plat');
    }
}
