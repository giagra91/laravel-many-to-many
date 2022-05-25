<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories(){
        return $this->belongsToMany("App\Models\Category");
    }

    /**
     * Function for the many to one relantionship
     */
    public function user(){
        return $this->belongsTo("App\User");
    }
}
