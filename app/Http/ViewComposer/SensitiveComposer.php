<?php


namespace App\Http\ViewComposer;

use App\Models\Module;
use Illuminate\View\View;
use App\Models\CompanySetting;
use App\Models\ThemeSetting;
use Illuminate\Support\Str;
use App\Models\Role;

class SensitiveComposer
{
    public function compose(View $view){
        $voucher_list = ['journal','receipt','payment-voucher','contra'];
        $account_list = ['attribute','primary','secondary'];
        $client_list =  ['job-to','oversea','company','demand-info','job-category'];
        $candidate_list =  ['branch-office','reference','candidate-personal','sub-status','candidate-all'];
        $setting_list = ['user','setting'];
        $employee_list = ['employee'];
        $payroll_list = ['employee-payment','employee-payroll'];
        $configuration_list = ['department','designation'];
        $processing_list = ['applied-candidate','selected-candidate','under-process-candidate'];
        $voucher_group=[];
        $account_group=[];
        $setting_group=[];
        $client_group=[];
        $employee_group=[];
        $payroll_group=[];
        $configuration_group=[];
        $processing_group=[];
        $single_group = [];
        $candidate_group = [];
        $role = Role::find(session()->get('role_id'));
        $role_key = $role ? Role::find(session()->get('role_id'))->key:'';

        if(session()->get('role_id')){
        $modules = Role::find(session()->get('role_id'))->modules;
         foreach($modules as $module){
                if(Str::contains($module->url,$voucher_list)){
                    $voucher_group[] = $module->url;
                }else if(Str::contains($module->url,$account_list)){
                    $account_group[] = $module->url;
                }else if(Str::contains($module->url,$setting_list)){
                    $setting_group[$module->url] = $module;
                }else if(Str::contains($module->url,$candidate_list)){
                    $candidate_group[] = $module->url;
                }else if(Str::contains($module->url,$configuration_list)){
                    $configuration_group[] = $module->url;
                }else if(Str::contains($module->url,$payroll_list)){
                    $payroll_group[] = $module->url;
                }else if(Str::contains($module->url,$employee_list)){
                    $employee_group[] = $module->url;
                }else if(Str::contains($module->url,$client_list)){
                    $client_group[] = $module->url;
                }else if(Str::contains($module->url,$processing_list)){
                    $processing_group[] = $module->url;
                } else{
                    $single_group[] = $module->url;
                }
            }
        }

//        $parent_modules = Role::find(session()->get('role_id'))
//            ->modules()
//            ->whereNull('parent_module_id')
//            ->orderBy('rank', 'ASC')
//            ->get();


        if ($role){
            $parent_modules = $role->modules()
                ->whereNull('parent_module_id')
                ->whereNotNull('rank')
                ->orderBy('rank', 'ASC')
                ->get();
        }else{
            $parent_modules = [];
        }



        $company_data = CompanySetting::first();
        $theme_data = ThemeSetting::first();
        $view
        ->with('company_data', $company_data)
        ->with('voucher_group', $voucher_group)
        ->with('account_group', $account_group)
        ->with('setting_group', $setting_group)
        ->with('client_group', $client_group)
        ->with('candidate_group', $candidate_group)
        ->with('employee_group', $employee_group)
        ->with('configuration_group', $configuration_group)
        ->with('payroll_group', $payroll_group)
        ->with('processing_group', $processing_group)
        ->with('single_group', $single_group)
        ->with('parent_modules', $parent_modules)
        ->with('role', $role_key)
        ->with('theme_data', $theme_data);

    }
}
