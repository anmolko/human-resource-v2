<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends BackendBaseModel
{
    use SoftDeletes;
    protected $table ='modules';
    protected $fillable =['id','parent_module_id','sub_parent_module_id','name','rank','key','url','icon','status','created_by','updated_by'];

    public function roles(){
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function permissions(){
        return $this->hasMany('App\Models\Permission');
    }

    public function parentModule()
    {
        return $this->belongsTo(Module::class, 'parent_module_id');
    }

    public function subParentModules()
    {
        return $this->hasMany(Module::class, 'sub_parent_module_id');
    }

    public function childModules()
    {
        return $this->hasMany(Module::class, 'parent_module_id')->orderBy('rank','asc');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::saving(function ($module) {
//            // Check if rank is unique among sibling modules
//            if ($module->parent_module_id !== null) {
//                $existingModule = Module::where('parent_module_id', $module->parent_module_id)
//                    ->where('rank', $module->rank)
//                    ->where('id', '!=', $module->id)
//                    ->first();
//
//                if ($existingModule) {
//                    throw ValidationException::withMessages([
//                        'rank' => ['The rank must be unique among sibling modules.'],
//                    ]);
//                }
//            }
//        });
//    }

}
