<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $fillable = ['dt', 'user_id', 'username','status','name','phone','leader','group','report1_dt','report1_photo_url', 'report2_dt', 'report2_tasks','report3_dt','report3_money'];
}
