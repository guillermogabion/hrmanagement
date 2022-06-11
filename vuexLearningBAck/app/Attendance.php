<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'upda' => 'datetime:Y-m-d'
        ];

        public function users(){
            return $this->belongsTo(User::class, 'user_id');
        }

        public function getTypeAttribute($value) {
            switch($value) {
                case 1 : return 'Present'; break;
                case 2 : return 'Absent'; break;
                case 3 : return 'Leave'; break;
            }
        }
    
}
