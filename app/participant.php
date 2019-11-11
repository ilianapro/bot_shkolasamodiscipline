<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\group;


class participant extends Model
{
    protected $fillable = ['user_id','username', 'first_name', 'last_name', 'phone', 'group_id','leader','status'];
    public function group(){
        return $this->belongsTo(group::class);
    }
}
