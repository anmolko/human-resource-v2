<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecondaryGroupCreateRequest;
use App\Http\Requests\SecondaryGroupUpdateRequest;
use App\Models\Attribute;
use App\Models\PrimaryAttributes;
use App\Models\PrimaryGroup;
use App\Models\SecondaryAttributes;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class SecondaryGroupController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $secondary_groups     = SecondaryGroup::all();
        $primaryvalue         = PrimaryGroup::select('id','name')->get();
        $all_attributes       = Attribute::all();

        return view('admin.secondary_group.index',compact('secondary_groups','primaryvalue','all_attributes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecondaryGroupCreateRequest $request)
    {
//         dd($request->attr);

        $secondarygroup = SecondaryGroup::create([
            'primary_group_id' =>$request->input('primary_group_id'),
            'name'        =>$request->input('name'),
            'status'      =>$request->input('status'),
            'slug'        =>$request->input('slug'),
            'created_by' =>Auth::user()->id,
        ]);

        if($secondarygroup){
            $count= 0;
            if($request->attr){
                foreach($request->attr as $key => $value){
                    SecondaryAttributes::create([
                    'attribute_id'=>$key,
                    'secondary_group_id'=>$secondarygroup->id,
                    'value'=>$value,
                    'type'=>$request->attrfieldtype[$count]
                    ]);
                    $count++;
                }
            }
            Session::flash('success','Secondary Group  Created Successfully');
        }
        else{
            Session::flash('error','Secondary Group Creation Failed');
        }
        return redirect()->back();
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editsecondarygroup        = SecondaryGroup::with('primaryGroup','secondaryAttributes')->find($id);
        $secondaryattribute_data   = SecondaryGroup::with('secondaryAttributes')->find($id);
        $all_attributes            = Attribute::all();
        $selected                  = [];
        $selected_attributes       = [];
        foreach ($editsecondarygroup->attributes as $attribute){
            array_push($selected,$attribute->id);
        }

        foreach($editsecondarygroup->primaryGroup->attributes as $attribute){
            array_push($selected_attributes,$attribute);
        }
        return response()->json(['selected_attribute_id'=>$selected,'secondarygroup_id'=>$id,'selected_attributes'=>$selected_attributes,'editsecondarygroup'=>$editsecondarygroup,'secondaryattribute_data'=>$secondaryattribute_data]);

    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SecondaryGroupUpdateRequest $request, $id)
    {
        $secondarygroup             = SecondaryGroup::find($id);
        $secondarygroup->primary_group_id  = $request->input('hidden_primary_group_id');
        $secondarygroup->name       = $request->input('name');
        $secondarygroup->slug        = $request->input('slug');
        $secondarygroup->status     = $request->input('status');
        $secondarygroup->updated_by = Auth::user()->id;
        // $manystatus =  $secondarygroup->attributes()->sync($request->input('attribute_id'));

        $sec_attr_id = $request->get('secondary_attributes_id');
        $count =0 ;
     
        if(@$request->attr !== NULL){
        foreach(@$request->attr as $key => $value){
            if(isset($sec_attr_id[$count])){
                $sec_check = SecondaryAttributes::updateOrCreate(
                    ['id' => $sec_attr_id[$count]],
                   [ 'value'=>$value,
                ]);

                $status =$secondarygroup->update();
                if(isset($sec_attr_id)){
                    $this->deleteAttribute($secondarygroup->id,$sec_attr_id);
                       
                   }
            }else{
                // dd($value);
                $status =  SecondaryAttributes::create([
                    'attribute_id'=>$key,
                    'secondary_group_id'=>$secondarygroup->id,
                    'value'=>$value,
                    'type'=>$request->attrfieldtype[$count],
                    ]);
            }
            $count++;
        }
    }else{
        $status =$secondarygroup->update();

    }

    
 
    
      

        if($status){
            Session::flash('success','Secondary Group Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Secondary Group could not be Updated');
        }
        return redirect()->route('secondary-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $deletesecondarygroup = SecondaryGroup::find($id);
        $rid             = $deletesecondarygroup->id;
        // $checksecondary = $deleteprimarygroup->secondaryGroups()->get();
        // if ($checksecondary->count() > 0) {
        //     return 0;

        // }else{

             $deletesecondarygroup->delete();
        // }
        return '#secondarygroup'.$rid;
    }

    public function trashindex(){
      $trashed = SecondaryGroup::onlyTrashed()->get();
      return view('admin.secondary_group.trash', compact('trashed'));
  }


    public function deletetrash($id){

        $secondary            = SecondaryGroup::onlyTrashed()->where('id', $id)->get();
        $rid             = $secondary[0]->id;
        $checkdelete    = $secondary[0]->attributes()->detach();

        if ($checkdelete) {
            SecondaryGroup::onlyTrashed()->where('id', $id)->forceDelete();
        }
        return  '#secondarygroup_'.$rid;

    }


    public function restoretrash($id){
        $restoretrash =  SecondaryGroup::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Secondary Group Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Secondary Group could not be Restored');
        }
        return redirect()->route('secondary-groups.trash');
    }

    public function getPrimaryAttributes(Request $request){
        if ($request->ajax()){
            $primary_attributes = PrimaryGroup::with('attributes')->find($request->id);
            return response()->json($primary_attributes);
        }
    }

    public function deleteAttribute($id, $sec_id){
        $sec_attribute = SecondaryAttributes::where('secondary_group_id',$id)->select('id')->get()->toArray();
        $sec_attr_id   = array_map(function($item){ return $item['id']; }, $sec_attribute);
        foreach($sec_attr_id as $key => $value){
            if(count($sec_id) > 0){
                if(!in_array($value,$sec_id)) {
                DB::table('attribute_secondary_group')->where('id', $value)->delete();
                }
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singlesecondary_group     = SecondaryGroup::where('id',$id)->with('secondaryAttributes')->first();

        return view('admin.secondary_group.show',compact('singlesecondary_group'));
    }


}
