<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $fillable = ['name','status'];
    public function participant(){
        return $this->hasMany(participant::class);
    }

}
