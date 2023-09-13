<?php

namespace App\Http\Controllers;

use App\Models\CandidateBankInformation;
use App\Models\CandidateDemandJobInformation;
use App\Models\CandidateDocumentInformation;
use App\Models\CandidateLanguageInformation;
use App\Models\CandidateLicenseInformation;
use App\Models\CandidateMedicalReport;
use App\Models\CandidatePCCReport;
use App\Models\CandidatePersonalInformation;
use App\Models\CandidateSubStatusHistory;
use App\Models\CandidatePoliceReport;
use App\Models\CandidateProfessionalInformation;
use App\Models\CandidateProfessionalTraining;
use App\Models\CandidateQualificationInformation;
use App\Models\CompanySetting;
use App\Models\DemandInformation;
use App\Models\Folder;
use App\Models\File;
use App\Models\HealthClinicInformation;
use App\Models\JobCategory;
use App\Models\JobtoDemand;
use App\Models\JournalEntry;
use App\Models\JournalParticular;
use App\Models\OverseasAgent;
use App\Models\ReferenceInformation;
use App\Models\SecondaryGroup;
use App\Models\SubStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use CountryState;
use Intervention\Image\ImageManagerStatic as Image;


class CandidatePersonalInformationController extends Controller
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
        $candidate_personal = CandidatePersonalInformation::with('professionalInfo')->get();
        $reference = ReferenceInformation::latest()->get();
        $countries = CountryState::getCountries();
        return view('admin.candidate.index',compact('candidate_personal','reference','countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.candidate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            //candidate personal information
            $data = [
                'registration_no'          => $request->input('registration_no'),
                'serial_no'                => $request->input('serial_no'),
                'registration_date_ad'     => $request->input('registration_date_ad'),
                'registration_date_bs'     => $request->input('registration_date_bs'),
                'passport_no'              => $request->input('passport_no'),
                'birth_place'              => $request->input('birth_place'),
                'issued_date'              => $request->input('issued_date'),
                'expiry_date'              => $request->input('expiry_date'),
                'reference_information_id' => $request->input('reference_information_id'),
                'receipt_no'               => $request->input('receipt_no'),
                'document_processing_fee'  => $request->input('document_processing_fee'),
                'advance_fee'              => $request->input('advance_fee'),
                'passport_status'          => $request->input('passport_status'),
                'candidate_firstname'      => $request->input('candidate_firstname'),
                'candidate_middlename'     => $request->input('candidate_middlename'),
                'candidate_lastname'       => $request->input('candidate_lastname'),
                'age'                      => $request->input('age'),
                'next_of_kin'              => $request->input('next_of_kin'),
                'kin_relationship'         => $request->input('kin_relationship'),
                'kin_contact_no'           => $request->input('kin_contact_no'),
                'gender'                   => $request->input('gender'),
                'nationality'              => $request->input('nationality'),
                'religion'                 => $request->input('religion'),
                'date_of_birth'            => $request->input('date_of_birth'),
                'mobile_no'                => $request->input('mobile_no'),
                'contact_no'               => $request->input('contact_no'),
                'martial_status'           => $request->input('martial_status'),
                'spouse'                   => $request->input('spouse'),
                'children'                 => $request->input('children'),
                'email_address'            => $request->input('email_address'),
                'height'                   => $request->input('height'),
                'weight'                   => $request->input('weight'),
                'father_name'              => $request->input('father_name'),
                'father_contact_no'        => $request->input('father_contact_no'),
                'mother_name'              => $request->input('mother_name'),
                'mother_contact_no'        => $request->input('mother_contact_no'),
                'permanent_address'        => $request->input('permanent_address'),
                'temporary_address'        => $request->input('temporary_address'),
                'aboard_contact_no'        => $request->input('aboard_contact_no'),
                'candidate_type'           => $request->input('candidate_type'),
                'created_by'               => Auth::user()->id,
            ];

            if(!empty($request->file('image'))) {
                $image = $request->file('image');
                $name1 = uniqid() . '_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/candidate_info/' . $name1;
                $image_resize = Image::make($image->getRealPath())->orientate();
                $image_resize->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio(); //maintain image ratio
                });
                if ($image_resize->save($path, 80)) {
                    $data['image'] = $name1;
                }
            }


            $personal_info = CandidatePersonalInformation::create($data);

            Folder::create([
                'candidate_id'       => $personal_info->id,
                'folder_name'        => $personal_info->candidate_firstname.'_'.$personal_info->id,
                'created_by'         => Auth::user()->id,

            ]);

//        if ($personal_info) {
//
////            $first = str_replace(" ","_",strtolower($request->input('candidate_firstname')));
////            $middle = str_replace(" ","_",strtolower($request->input('candidate_middlename')));
////            $last = str_replace(" ","_",strtolower($request->input('candidate_lastname')));
////            $slug     = $first."_".$middle."_".$last."_".$request->input('registration_no');
////            $secondarygroup = SecondaryGroup::create([
////                'primary_group_id' =>8,
////                'imported_from' => 'true',
////                'name'        =>$request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname'),
////                'status'      =>1,
////                'slug'        =>$slug,
////                'created_by'  => Auth::user()->id,
////            ]);
//
////            if($secondarygroup){
////                if($request->input('document_processing_fee') !==null){
////                    $ref                = 'JRN-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT);
////                    $journal_entry     = JournalEntry::create([
////                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
////                        'ref_no'       => $ref,
////                        'narration'    => "Journal Entry addition for ".$request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname')." for the document process fee",
////                        'total_amount' => $request->input('document_processing_fee'),
////                        'processing_status' =>'applied',
////                        'candidate_personal_id' =>$personal_info->id,
////                        'created_by'   => Auth::user()->id,
////                    ]);
////
////                    // $latestjournal       = JournalEntry::latest()->first();
////                    $journal_particulars_debit = JournalParticular::create([
////                        'journal_entry_id'=> $journal_entry->id,
////                        'by_debit_id' =>$secondarygroup->id,
////                        'initial_acc_id' =>8,
////                        'debit_amount' =>$request->input('document_processing_fee'),
////                        'credit_amount' =>0,
////                        'created_by' =>Auth::user()->id,
////                    ]);
////
////                    $journal_particulars_credit = JournalParticular::create([
////                        'journal_entry_id'=> $journal_entry->id,
////                        'to_credit_id' =>8,
////                        'initial_acc_id' =>$secondarygroup->id,
////                        'debit_amount' =>0,
////                        'credit_amount' =>$request->input('document_processing_fee'),
////                        'created_by' =>Auth::user()->id,
////                    ]);
////                }
////
////                if($request->input('advance_fee') !==null){
////
////                    $ref                = 'JRN-'.str_pad(time() + 3, 8, "0", STR_PAD_LEFT);
////                    $journal_entry     = JournalEntry::create([
////                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
////                        'ref_no'       => $ref,
////                        'narration'    => "Journal Entry addition for ".$request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname')." for the document process advance amount",
////                        'total_amount' => $request->input('advance_fee'),
////                        'processing_status' =>'applied',
////                        'candidate_personal_id' =>$personal_info->id,
////                        'created_by'   => Auth::user()->id,
////                    ]);
////
////                    // $latestjournal       = JournalEntry::latest()->first();
////                    $journal_particulars_debit = JournalParticular::create([
////                        'journal_entry_id'=> $journal_entry->id,
////                        'by_debit_id' =>$secondarygroup->id,
////                        'initial_acc_id' =>9,
////                        'debit_amount' =>$request->input('advance_fee'),
////                        'credit_amount' =>0,
////                        'created_by' =>Auth::user()->id,
////                    ]);
////
////                    $journal_particulars_credit = JournalParticular::create([
////                        'journal_entry_id'=> $journal_entry->id,
////                        'to_credit_id' =>9,
////                        'initial_acc_id' =>$secondarygroup->id,
////                        'debit_amount' =>0,
////                        'credit_amount' =>$request->input('advance_fee'),
////                        'created_by' =>Auth::user()->id,
////                    ]);
////                }
////            }
//
//        }

            DB::commit();
            Session::flash('success', 'Candidate Personal Info Created Successfully');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Candidate Personal Info Creation Failed');
        }

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate_personal = CandidatePersonalInformation::find($id);
        return response()->json($candidate_personal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $candidate_personal                             =  CandidatePersonalInformation::find($id);
            $old_firstname = $candidate_personal->candidate_firstname;
            $old_middlename = $candidate_personal->candidate_middlename;
            $old_lastname = $candidate_personal->candidate_lastname;
            $old_regno = $candidate_personal->registration_no;

            $candidate_personal->registration_no            =  $request->input('registration_no');
            $candidate_personal->serial_no                  =  $request->input('serial_no');
            $candidate_personal->registration_date_ad       =  $request->input('registration_date_ad');
            $candidate_personal->registration_date_bs       =  $request->input('registration_date_bs');
            $candidate_personal->passport_no                =  $request->input('passport_no');
            $candidate_personal->birth_place                =  $request->input('birth_place');
            $candidate_personal->issued_date                =  $request->input('issued_date');
            $candidate_personal->expiry_date                =  $request->input('expiry_date');
            $candidate_personal->reference_information_id   =  $request->input('reference_information_id');
            $candidate_personal->receipt_no                 =  $request->input('receipt_no');
            $candidate_personal->document_processing_fee    =  $request->input('document_processing_fee');
            $candidate_personal->advance_fee                =  $request->input('advance_fee');
            $candidate_personal->passport_status            =  $request->input('passport_status');
            $candidate_personal->candidate_firstname        =  $request->input('candidate_firstname');
            $candidate_personal->candidate_middlename       =  $request->input('candidate_middlename');
            $candidate_personal->candidate_lastname         =  $request->input('candidate_lastname');
            $candidate_personal->age                        =  $request->input('age');
            $candidate_personal->next_of_kin                =  $request->input('next_of_kin');
            $candidate_personal->kin_relationship           =  $request->input('kin_relationship');
            $candidate_personal->kin_contact_no             =  $request->input('kin_contact_no');
            $candidate_personal->gender                     =  $request->input('gender');
            $candidate_personal->nationality                =  $request->input('nationality');
            $candidate_personal->religion                   =  $request->input('religion');
            $candidate_personal->date_of_birth              =  $request->input('date_of_birth');
            $candidate_personal->mobile_no                  =  $request->input('mobile_no');
            $candidate_personal->contact_no                 =  $request->input('contact_no');
            $candidate_personal->martial_status             =  $request->input('martial_status');
            $candidate_personal->spouse                     =  $request->input('spouse');
            $candidate_personal->children                   =  $request->input('children');
            $candidate_personal->email_address              =  $request->input('email_address');
            $candidate_personal->height                     =  $request->input('height');
            $candidate_personal->weight                     =  $request->input('weight');
            $candidate_personal->father_name                =  $request->input('father_name');
            $candidate_personal->father_contact_no          =  $request->input('father_contact_no');
            $candidate_personal->mother_name                =  $request->input('mother_name');
            $candidate_personal->mother_contact_no          =  $request->input('mother_contact_no');
            $candidate_personal->permanent_address          =  $request->input('permanent_address');
            $candidate_personal->temporary_address          =  $request->input('temporary_address');
            $candidate_personal->aboard_contact_no          =  $request->input('aboard_contact_no');
            $candidate_personal->candidate_type             =  $request->input('candidate_type');
            $candidate_personal->created_by                 = Auth::user()->id;

            $oldimage             = $candidate_personal->image;
            if (!empty($request->file('image'))){
                $image =$request->file('image');
                $name1 = uniqid().'_'.$image->getClientOriginalName();
                $path = base_path().'/public/images/candidate_info/'.$name1;
                $image_resize = Image::make($image->getRealPath())->orientate();
                $image_resize->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio(); //maintain image ratio
                });
                if ($image_resize->save($path,80)){
                    $candidate_personal->image= $name1;
                    if (!empty($oldimage) && file_exists(public_path().'/images/candidate_info/'.$oldimage)){
                        @unlink(public_path().'/images/candidate_info/'.$oldimage);
                    }
                }
            }



            $status = $candidate_personal->update();


            $candidate_folder                               =  Folder::where('candidate_id',$id)->first();

            if($candidate_folder !== null){
                $candidate_folder->folder_name              =  $request->input('candidate_firstname').'_'.$id;
                $candidate_folder->update();
            }else{
                Folder::create([
                    'candidate_id'       => $id,
                    'folder_name'        => $request->input('candidate_firstname').'_'.$id,
                    'created_by'         => Auth::user()->id,
                ]);
            }

//
//
//            if($status){
//        //            $oldfirst           = str_replace(" ","_",strtolower($old_firstname));
//        //            $oldmiddle          = str_replace(" ","_",strtolower($old_middlename));
//        //            $oldlast            = str_replace(" ","_",strtolower($old_lastname));
//        //            $oldslug            = $oldfirst."_".$oldmiddle."_".$oldlast."_".$old_regno;
//        //            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
//        //
//        //            $first              = str_replace(" ","_",strtolower($request->input('candidate_firstname')));
//        //            $middle             = str_replace(" ","_",strtolower($request->input('candidate_middlename')));
//        //            $last               = str_replace(" ","_",strtolower($request->input('candidate_lastname')));
//        //            $slug               = $first."_".$middle."_".$last."_".$request->input('registration_no');
//
//        //            $secondarygroup->name       = $request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname');
//        //            $secondarygroup->slug        = $slug;
//        //            $secondarygroup->updated_by = Auth::user()->id;
//        //            $secondarygroup->update();
//
//        //            if($request->input('document_processing_fee') !==null){
//        //
//        //
//        //               $journal_pt = JournalParticular::where("by_debit_id",$secondarygroup->id)
//        //                                  ->where("initial_acc_id",8)->first();
//        //                if($journal_pt){
//        //                    $journal_entry     = JournalEntry::updateOrCreate(
//        //                        ['id' => $journal_pt->journal_entry_id],
//        //                        [
//        //                        'total_amount' => $request->input('document_processing_fee'),
//        //                        'processing_status' =>'applied',
//        //                        'candidate_personal_id' =>$candidate_personal->id,
//        //                        'updated_by'   => Auth::user()->id,
//        //                    ]);
//        //
//        //                    $journal_particulars_debit = JournalParticular::updateOrCreate(
//        //                        ['id' => $journal_pt->id],
//        //                        [
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'by_debit_id' =>$secondarygroup->id,
//        //                        'initial_acc_id' =>8,
//        //                        'debit_amount' =>$request->input('document_processing_fee'),
//        //                        'credit_amount' =>0,
//        //                        'updated_by' =>Auth::user()->id,
//        //                        ]);
//        //
//        //                    $journal_pt_cd = JournalParticular::where("to_credit_id",8)
//        //                        ->where("initial_acc_id",$secondarygroup->id)->first();
//        //                    $journal_particulars_credit = JournalParticular::updateOrCreate(
//        //                        ['id' => $journal_pt_cd->id],
//        //                        [
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'to_credit_id' =>8,
//        //                        'initial_acc_id' =>$secondarygroup->id,
//        //                        'debit_amount' =>0,
//        //                        'credit_amount' =>$request->input('document_processing_fee'),
//        //                        'created_by' =>Auth::user()->id,
//        //                        ]);
//        //                }else{
//        //
//        //                    $ref                = 'JRN-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT);
//        //                    $journal_entry     = JournalEntry::create([
//        //                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
//        //                        'ref_no'       => $ref,
//        //                        'narration'    => "Journal Entry addition for ".$request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname')." for the document process fee",
//        //                        'total_amount' => $request->input('document_processing_fee'),
//        //                        'processing_status' =>'applied',
//        //                        'candidate_personal_id' =>$candidate_personal->id,
//        //                        'created_by'   => Auth::user()->id,
//        //                    ]);
//        //
//        //                    // $latestjournal       = JournalEntry::latest()->first();
//        //                    $journal_particulars_debit = JournalParticular::create([
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'by_debit_id' =>$secondarygroup->id,
//        //                        'initial_acc_id' =>8,
//        //                        'debit_amount' =>$request->input('document_processing_fee'),
//        //                        'credit_amount' =>0,
//        //                        'created_by' =>Auth::user()->id,
//        //                    ]);
//        //
//        //                    $journal_particulars_credit = JournalParticular::create([
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'to_credit_id' =>8,
//        //                        'initial_acc_id' =>$secondarygroup->id,
//        //                        'debit_amount' =>0,
//        //                        'credit_amount' =>$request->input('document_processing_fee'),
//        //                        'created_by' =>Auth::user()->id,
//        //                    ]);
//        //
//        //                }
//        //            }
//        //
//        //            if($request->input('advance_fee') !==null){
//        //
//        //
//        //               $journal_pt = JournalParticular::where("by_debit_id",$secondarygroup->id)
//        //               ->where("initial_acc_id",9)->first();
//        //                if($journal_pt){
//        //                $journal_entry     = JournalEntry::updateOrCreate(
//        //                    ['id' => $journal_pt->journal_entry_id],
//        //                    [
//        //                    'total_amount' => $request->input('advance_fee'),
//        //                    'processing_status' =>'applied',
//        //                    'candidate_personal_id' =>$candidate_personal->id,
//        //                    'updated_by'   => Auth::user()->id,
//        //                ]);
//        //
//        //                $journal_particulars_debit = JournalParticular::updateOrCreate(
//        //                    ['id' => $journal_pt->id],
//        //                    [
//        //                    'journal_entry_id'=> $journal_entry->id,
//        //                    'by_debit_id' =>$secondarygroup->id,
//        //                    'initial_acc_id' =>9,
//        //                    'debit_amount' =>$request->input('advance_fee'),
//        //                    'credit_amount' =>0,
//        //                    'updated_by' =>Auth::user()->id,
//        //                    ]);
//        //
//        //                $journal_pt_cd = JournalParticular::where("to_credit_id",9)
//        //                    ->where("initial_acc_id",$secondarygroup->id)->first();
//        //                $journal_particulars_credit = JournalParticular::updateOrCreate(
//        //                    ['id' => $journal_pt_cd->id],
//        //                    [
//        //                    'journal_entry_id'=> $journal_entry->id,
//        //                    'to_credit_id' =>9,
//        //                    'initial_acc_id' =>$secondarygroup->id,
//        //                    'debit_amount' =>0,
//        //                    'credit_amount' =>$request->input('advance_fee'),
//        //                    'created_by' =>Auth::user()->id,
//        //                    ]);
//        //                }else{
//        //                    $ref                = 'JRN-'.str_pad(time() + 3, 8, "0", STR_PAD_LEFT);
//        //                    $journal_entry     = JournalEntry::create([
//        //                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
//        //                        'ref_no'       => $ref,
//        //                        'narration'    => "Journal Entry addition for ".$request->input('candidate_firstname')." ".$request->input('candidate_middlename')." ".$request->input('candidate_lastname')." for the document process advance amount",
//        //                        'total_amount' => $request->input('advance_fee'),
//        //                        'processing_status' =>'applied',
//        //                        'candidate_personal_id' =>$candidate_personal->id,
//        //                        'created_by'   => Auth::user()->id,
//        //                    ]);
//        //
//        //                    $journal_particulars_debit = JournalParticular::create([
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'by_debit_id' =>$secondarygroup->id,
//        //                        'initial_acc_id' =>9,
//        //                        'debit_amount' =>$request->input('advance_fee'),
//        //                        'credit_amount' =>0,
//        //                        'created_by' =>Auth::user()->id,
//        //                    ]);
//        //
//        //                    $journal_particulars_credit = JournalParticular::create([
//        //                        'journal_entry_id'=> $journal_entry->id,
//        //                        'to_credit_id' =>9,
//        //                        'initial_acc_id' =>$secondarygroup->id,
//        //                        'debit_amount' =>0,
//        //                        'credit_amount' =>$request->input('advance_fee'),
//        //                        'created_by' =>Auth::user()->id,
//        //                    ]);
//        //                    }
//        //
//        //
//        //            }
//
//                }
            DB::commit();
            Session::flash('success','Candidate Personal Information Updated Successfully');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error','Something Went Wrong. Candidate Personal Information could not be Updated');
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecandidate   = CandidatePersonalInformation::find($id);
        $rid               = $deletecandidate->id;
        $deletecandidate->delete();

        return '#candidate_info_'.$rid;
    }

    public function trashindex(){
        $trashed        = CandidatePersonalInformation::onlyTrashed()->get();
        return view('admin.candidate.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  CandidatePersonalInformation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Candidate Type Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Type could not be Restored');
        }
        return redirect()->route('candidate-personal-info.trash');
    }

    public function deletetrash($id){
        $trashremoval    = CandidatePersonalInformation::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        $candidate_folder     =  Folder::where('candidate_id',$id)->first();
        if($candidate_folder !== null){
            $candidate_folder->delete();
        }
        if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/candidate_info/'.$trashremoval[0]->image)){
            @unlink(public_path().'/images/candidate_info/'.$trashremoval[0]->image);
        }
        CandidatePersonalInformation::onlyTrashed()->where('id', $id)->forceDelete();
        return  '#candidate_personal_'.$rid;
    }


    public function individualDashboard($id){
        $candidate_personal = CandidatePersonalInformation::with('referenceInfo')->find($id);
        if (!$candidate_personal) {
            return abort(404);
        }
        $document_info      = CandidateDocumentInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $reference          = ReferenceInformation::latest()->get();
        $professional_info  = CandidateProfessionalInformation::with('personalInfo')->where('candidate_personal_information_id',$candidate_personal->id)->get();
        $medical_info       = CandidateMedicalReport::with('personalInfo')->where('candidate_personal_information_id',$candidate_personal->id)->first();
        $training_info      = CandidateProfessionalTraining::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $qualification_info = CandidateQualificationInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $police_info        = CandidatePoliceReport::where('candidate_personal_information_id',$candidate_personal->id)->first();
        $pcc_info           = CandidatePCCReport::where('candidate_personal_information_id',$candidate_personal->id)->first();
        $language_info      = CandidateLanguageInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $document_info      = CandidateDocumentInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $bank_info          = CandidateBankInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $license_info       = CandidateLicenseInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $demand_job_info    = CandidateDemandJobInformation::where('candidate_personal_information_id',$candidate_personal->id)->first();
        $countries          = CountryState::getCountries();
        $clinic_detail      = HealthClinicInformation::latest()->get();
        $applied_info       = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','applied')->get();
        $selected_info      = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','selected')->get();
        $under_info         = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','under-process')->get();
        $visa_info          = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','visa-received')->get();
        $ticket_info        = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','ticket-received')->get();
        $deployed_info      = CandidateSubStatusHistory::where('candidate_personal_information_id',$candidate_personal->id)->where('status','deployed')->get();
        $candidate_folder   =  Folder::where('candidate_id',$candidate_personal->id)->first();
        $files = File::where('folder_id', $candidate_folder->id)->with('folder')->get();


        return view('admin.candidate.individual_dashboard',compact('files','selected_info','under_info','visa_info','ticket_info','deployed_info','applied_info','police_info','pcc_info','clinic_detail','medical_info','demand_job_info','language_info','qualification_info','countries','professional_info','training_info','candidate_personal','document_info','reference'));

    }


    public function addalldetails($id){
        $candidate_personal = CandidatePersonalInformation::with('referenceInfo')->find($id);
        $countries          = CountryState::getCountries();
        $substatus          = SubStatus::latest()->get();
        $reference          = ReferenceInformation::latest()->get();
        $jobcategory        = JobCategory::latest()->get();
        $overseasagent      = OverseasAgent::latest()->get();
        $demandinfo         = DemandInformation::latest()->get();
        $clinic_detail      = HealthClinicInformation::latest()->get();
        $professional_info  = CandidateProfessionalInformation::with('personalInfo')->where('candidate_personal_information_id',$candidate_personal->id)->get();
        $medical_info       = CandidateMedicalReport::with('personalInfo')->where('candidate_personal_information_id',$candidate_personal->id)->first();
        $training_info      = CandidateProfessionalTraining::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $qualification_info = CandidateQualificationInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $police_info        = CandidatePoliceReport::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $pcc_info           = CandidatePCCReport::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $language_info      = CandidateLanguageInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $document_info      = CandidateDocumentInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $bank_info          = CandidateBankInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $license_info       = CandidateLicenseInformation::where('candidate_personal_information_id',$candidate_personal->id)->get();
        $demand_job_info    = CandidateDemandJobInformation::where('candidate_personal_information_id',$candidate_personal->id)->first();
        return view('admin.candidate.create',compact('candidate_personal','countries','police_info','pcc_info','clinic_detail','substatus', 'medical_info', 'reference','professional_info','training_info','qualification_info','language_info','document_info','bank_info','license_info','jobcategory','demandinfo','overseasagent','demand_job_info'));
    }

    public function getJobsofDemand(Request $request){
        if ($request->ajax()){
            $demand_id =$request->demand_id;
            $demand = DemandInformation::find($demand_id);
            $jobs = JobtoDemand::with('jobCategory')->where('demand_information_id',$demand_id)->get();
            $response = [];
            foreach( $jobs as $job )
            {
                $response[$job->id] = $job->jobCategory->name;
            }
            return response()->json(['response'=>$response,'demand'=>$demand]);
        }
    }

    public function application(Request $request, $id)
    {
        $redirect_to =  $request->input('radio');
        $candidate_personal = CandidatePersonalInformation::with('professionalInfo','referenceInfo','trainingInfo','qualificationInfo','documentInfo','languageInfo','licenseInfo','demandJobInfo','medical_report')->find($id);
        $languages =[];
        foreach ($candidate_personal->languageInfo as $lang){
            $languages[] =  $lang->language;
        }
        $countries          = CountryState::getCountries();
        $company_settings = CompanySetting::first();

        $name = strtoupper($candidate_personal->candidate_firstname)." ".strtoupper($candidate_personal->candidate_middlename)." ".strtoupper($candidate_personal->candidate_lastname);
        return view('admin.application.'.$redirect_to, compact('candidate_personal','company_settings','countries','name','languages'));
    }

    public function application2($id,$name)
    {
        $candidate_personal = CandidatePersonalInformation::with('professionalInfo','referenceInfo','trainingInfo','qualificationInfo','documentInfo','languageInfo','licenseInfo','demandJobInfo','medical_report')->find($id);
        $languages = [];
        $redirect_to = $name;
        $company_settings = CompanySetting::first();
        foreach ($candidate_personal->languageInfo as $lang){
            $languages[] =  $lang->language;
        }
        $countries          = CountryState::getCountries();
        $name = strtoupper($candidate_personal->candidate_firstname)." ".strtoupper($candidate_personal->candidate_middlename)." ".strtoupper($candidate_personal->candidate_lastname);
        return view('admin.application.'.$redirect_to, compact('candidate_personal','company_settings','countries','name','languages'));
    }



    public function genapplication(Request $request){
        $can_list = [];
        foreach ($request->input('can_id') as $id){
            $candidate_personal = CandidatePersonalInformation::with('professionalInfo','referenceInfo','trainingInfo','qualificationInfo','documentInfo','languageInfo','licenseInfo','demandJobInfo','medical_report')->find($id);
            $can_list[] =  $candidate_personal;
        }



        $countries          = CountryState::getCountries();
        $company_settings   = CompanySetting::first();
        $redirect_to        = $company_settings->application_selected;
//        return view('admin.application.'.$redirect_to, compact('candidate_personal','countries'));
        return view('admin.application.app2_test', compact('can_list','countries','company_settings'));
//        return view('admin.application.testapp');
    }

    public function showCv()
    {
        $candidate_personals = CandidatePersonalInformation::with('professionalInfo')->get();

        return view('admin.application.cv.index',compact('candidate_personals'));
    }

    public function cv(Request $request)
    {

        $candidate_personal = CandidatePersonalInformation::with('cvInfo','professionalInfo','referenceInfo','trainingInfo','qualificationInfo','documentInfo','languageInfo','licenseInfo','demandJobInfo','medical_report')->find($request->input('candidate'));
        $candidate_id = $request->input('candidate');
        $template_type = $request->input('template');

        $languages =[];
        foreach ($candidate_personal->languageInfo as $lang){
            $languages[] =  $lang->language;
        }
        $countries          = CountryState::getCountries();
        $name = strtoupper($candidate_personal->candidate_firstname)." ".strtoupper($candidate_personal->candidate_middlename)." ".strtoupper($candidate_personal->candidate_lastname);

        if($template_type=="one"){
            return view('admin.application.cv.one',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="two"){

            return view('admin.application.cv.two',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="three"){

            return view('admin.application.cv.three',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="four"){

            return view('admin.application.cv.four',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="five"){
            return view('admin.application.cv.five',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="six"){
            return view('admin.application.cv.six',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="seven"){
            return view('admin.application.cv.seven',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="eight"){
            return view('admin.application.cv.eight',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="nine"){
            return view('admin.application.cv.nine',compact('candidate_personal','name','languages','countries'));
        }elseif($template_type=="ten"){
            return view('admin.application.cv.ten',compact('candidate_personal','name','languages','countries'));
        }
    }
}
