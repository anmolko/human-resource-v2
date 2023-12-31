<?php

namespace App\Services;

use App\Models\Module;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ModuleService {


    private DataTables $dataTables;
    private Module $model;

    public function __construct(DataTables $dataTables)
    {
        $this->model      = new Module();
        $this->dataTables = $dataTables;
    }

    public function getDataForDatatable(Request $request){

        $request->session()->forget(['type']);

        $query = $this->model->query()->orderBy('created_at', 'desc');

        return Datatables::of($query)
            ->filter(function ($query) use ($request) {
                // Check if 'status' parameter is present in the request
                if ($request['parent']) {
                    $query->whereNull('parent_module_id'); // Filter by 'status' parameter
                }
                if ($request['child']) {
                    $query->whereNotNull('parent_module_id'); // Filter by 'status' parameter
                }
                if ($request->has('search') && !empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $query->where('name', 'like', "%$searchValue%")
                        ->orWhere('key', 'like', "%$searchValue%");
                    // Add other columns here
                }
            })
            ->addColumn('title', function ($item) {
                return $item->name;
            })
            ->editColumn('type',function ($item){
                return $item->parent_module_id ? 'Child Module':'Parent Module';
            })
            ->editColumn('parent_module',function ($item){
                return $item->parent_module_id ? $item->parentModule->name:' - ';
            })
            ->editColumn('status',function ($item){
                return $item->status ? '<i class="fa fa-dot-circle-o text-success"></i> Active':'<i class="fa fa-dot-circle-o text-danger"></i> Inactive';
            })
            ->editColumn('action',function ($item){
                $params = [
                    'id'            => $item->id,
                    'base_route'    => 'module.',
                ];
                return view('admin.module.includes.dataTable_action', compact('params'));

            })
            ->rawColumns(['action','status','type'])
            ->addIndexColumn()
            ->make(true);
    }

}
