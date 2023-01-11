<?php

namespace App;
use App\Models\Navigation;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function navigation(){
        return $this->belongsTo(Navigation::class,'navigation_id','id');
    }
}
