<?php

namespace App\Http\Controllers;

use App\Models\CountrySetting;
use App\Models\DemandCompany;
use App\Models\DemandCompanyCountryStates;
use App\Models\DemandInformation;
use App\Models\OverseasAgent;
use CountryState;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DemandCompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $rows               = DemandCompany::latest()->get();
        $countries          = CountryState::getCountries();
        $agents             = OverseasAgent::latest()->get()->mapWithKeys(function($agent) {
            return [$agent->id => $agent->company_name ?? $agent->fullname ?? ''];
        });
        $country_settings   = CountrySetting::latest()->get();

        return view('admin.demand_company.index',compact('rows','country_settings','countries','agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $request->request->add(['created_by' => auth()->user()->id ]);

//            if($request->hasFile('image')) {
//                $image        = $request->file('image');
//                $name1        = uniqid() . '_' . $image->getClientOriginalName();
//                $path         = base_path() . '/public/images/demand_companies/' . $name1;
//                $image_resize = Image::make($image->getRealPath())->orientate();
//                $image_resize->resize(1000, 1000, function ($constraint) {
//                    $constraint->aspectRatio(); //maintain image ratio
//                });
//                if ($image_resize->save($path, 80)) {
//                    $request->request->add(['image' => $name1]);
//                }
//            }

            $demand_company = DemandCompany::create($request->all());

            $this->syncCompanyState($request,$demand_company);


            Session::flash('success','Demand company was created successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Session::flash('error','Demand company was not created. Something went wrong.');
        }

        return redirect()->back();
    }

    public function syncCompanyState($request, $company){
        if(count($request['country_state_id'])>0){
            foreach ($request['country_state_id'] as $country_state){
                DemandCompanyCountryStates::create([
                    'demand_company_id' => $company->id,
                    'country_state_id' => $country_state,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show($id)
    {
        $demand           = DemandInformation::find($id);
        $countries        = CountryState::getCountries();

        return view('admin.demand_informations.single',compact('demand','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $data                       = [];
        $data['demand_company']     = DemandCompany::find($id);
        $data['countries']          = CountryState::getCountries();
        $data['agents']             = OverseasAgent::latest()->get()->mapWithKeys(function($agent) {
            return [$agent->id => $agent->company_name ?? $agent->fullname ?? ''];
        });
        $data['country_settings']   = CountrySetting::latest()->get();

        if ($data['demand_company']->country){
            $data['states'] = CountrySetting::where('country_code',$data['demand_company']->country)->pluck('state','id');
        }else{
            $data['states'] = [];
        }


        $render_view = view('admin.demand_company.includes.edit_form', compact('data'))->render();

        return response()->json(['rendered_view' => $render_view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data['row']       = DemandCompany::find($id);

        DB::beginTransaction();
        try {
            $request->request->add(['updated_by' => auth()->user()->id ]);

            $data['row']->update($request->all());

//            $data['row']->demandCompanyCountryStates()->detach(); // Detach existing posts
//
//            $this->syncCompanyState($request,$data['row']);

            Session::flash('success','Demand company was updated successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Demand company was not updated. Something went wrong.');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deletedemand    = DemandCompany::find($id);
        $rid             = $deletedemand->id;

        $deletedemand->delete();

        return '#demand_info_'.$rid;
    }

    public function trashindex(){
        $trashed          = DemandCompany::onlyTrashed()->get();
        $countries        = CountryState::getCountries();

        return view('admin.demand_company.trash', compact('trashed','countries'));
    }

    public function restoretrash($id){
        $restoretrash =  DemandCompany::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Demand Company Restored');
        }
        else{
            Session::flash('error','Something Went Wrong.Demand Company could not be Restored');
        }
        return redirect()->route('company.trash');
    }

    public function deletetrash($id){

        $trashremoval    = DemandCompany::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
//        if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/demand_companies/'.$trashremoval[0]->image)){
//            @unlink(public_path().'/images/demand_companies/'.$trashremoval[0]->image);
//        }

        DemandCompany::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#demand_company_'.$rid;
    }

    public function statusupdate(Request $request, $id){
        $demand          = DemandCompany::find($id);
        $demand->status  = $request->status;
        $status          = $demand->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
