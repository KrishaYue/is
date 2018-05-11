<?php

namespace ICTDUInventory;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function book(){
    	return $this->belongsTo('ICTDUInventory\Book');
    }
}
