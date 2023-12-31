<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends BackendBaseModel
{
    use HasFactory, UserWiseFilter;

    protected $table ='files';
    protected $fillable =['id','filename','status','type','folder_id','created_by','updated_by'];


    public function folder(){
        return $this->belongsTo('App\Models\Folder','folder_id','id');
    }
}
