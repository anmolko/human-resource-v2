<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryAttributes extends Model
{
    use HasFactory;
    protected $table ='attribute_secondary_group';
    protected $fillable =['id','attribute_id','secondary_group_id','value','type'];


    public function attributes(){
        return $this->belongsTo('App\Models\Attribute','attribute_id','id');
    }


}
