<?php

namespace App\Services;

use App\Models\CandidatePersonalInformation;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CandidatePersonalInfoService {

    use DateFilter;
    private DataTables $dataTables;
    private CandidatePersonalInformation $model;

    public function __construct(DataTables $dataTables)
    {
        $this->model        = new CandidatePersonalInformation();
        $this->dataTables = $dataTables;
    }

    public function getDataForDatatable(Request $request){

        $request->session()->forget(['filter_period','from_date','to_date','created_by']);

        $query = $this->model->query()->orderBy('created_at', 'desc');

        return $this->dataTables->eloquent($query)
            ->filter(function ($query) use($request){

                if ($request['created_by']){

                    $data = separateTypeAndId($request['created_by']);

                    $query->where('created_type',$data['type'])->where('created_by',$data['id']);
                }
                $this->FilterTableData($query,'candidate_personal_info');
            })
            ->editColumn('full_name',function ($item){
                $first_name  = $item->candidate_firstname ?? '';
                $middle_name = $item->candidate_middlename ? ' '.$item->candidate_middlename:'';
                $last_name   = $item->candidate_lastname ? ' '.$item->candidate_lastname:'';
                return '<a href="'.route('candidate-individual.dashboard',$item->id).'" >'.$first_name.$middle_name.$last_name.'</a>';
            })
            ->editColumn('check_item',function ($item){
                return '<label><input type="checkbox" name="cb-element" class="cb-element" value="'.$item->id.'" '. ($item->demandJobInfo ? "":"disabled readonly" ).'  /></label>';
            })
            ->editColumn('created_by',function ($item){
                return ucwords( $item->createdBy() ? $item->createdBy()->name :'-');
            })
            ->editColumn('mobile_no',function ($item){
                return $item->contact_no ?? $item->mobile_no ?? '-';
            })
            ->editColumn('action',function ($item){
                $params = [
                    'id'            => $item->id,
                ];
                return view('admin.candidate.partials.action', compact('params'));

            })
            ->filterColumn('full_name', function($query, $keyword) {
                $query->where('candidate_firstname', 'like', "%" . $keyword . "%")
                    ->orWhere('candidate_middlename', 'like', "%" . $keyword . "%")->orWhere('candidate_lastname', 'like', "%" . $keyword . "%");
            })
            ->filterColumn('mobile_no', function($query, $keyword) {
                $query->where('mobile_no', 'like', "%" . $keyword . "%")
                    ->orWhere('contact_no', 'like', "%" . $keyword . "%");
            })
            ->rawColumns(['action','full_name','check_item'])
            ->make(true);
    }

}
