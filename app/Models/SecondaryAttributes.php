<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SecondaryAttributes extends BackendBaseModel
{
    use HasFactory,UserWiseFilter;
    protected $table ='attribute_secondary_group';
    protected $fillable =['id','attribute_id','secondary_group_id','value','type'];


    public function attributes(){
        return $this->belongsTo('App\Models\Attribute','attribute_id','id');
    }


}
