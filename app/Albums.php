<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = array('name', 'description', 'cover_image');
    
    public function photos() {
        return $this->hasMany('App\Photos');
    }
}
