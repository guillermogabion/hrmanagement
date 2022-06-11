<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    public function designated(){
        return $this->hasMany(Designation::class);
    }
}
