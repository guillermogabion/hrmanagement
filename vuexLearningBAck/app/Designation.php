<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    public function user_designation(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function department_designate(){
        return $this->belongsTo(Department::class, 'department_id');
    }
}
