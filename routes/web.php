<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Resources\Json\Resource;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
Route::get('/candidate', [App\Http\Controllers\HomeController::class, 'candidate'])->name('candidate');
Route::get('/user-dashboard', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
Route::get('/entry', [App\Http\Controllers\HomeController::class, 'entry'])->name('entry');
Route::get('/processing', [App\Http\Controllers\HomeController::class, 'processing'])->name('processing');

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::any('/register', function() {
    abort(404);
});


Route::get('/user-profile', 'App\Http\Controllers\UserController@profile')->name('user.profile');
Route::put('/user/{id}/update', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::patch('/status/{id}/update', 'App\Http\Controllers\UserController@statusupdate')->name('user-status.update');
Route::get('user/{id}/', 'App\Http\Controllers\UserController@show')->name('user.show');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('user.create')->middleware('checkpermission:create_user');
Route::post('/user', 'App\Http\Controllers\UserController@store')->name('user.store');
Route::delete('/user/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy')->middleware('checkpermission:trash_user');
Route::get('/user/{id}/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit')->middleware('checkpermission:edit_user');
Route::get('/user-trash','App\Http\Controllers\UserController@trashindex')->name('user.trash');
Route::delete('/remove-user-trash/{id}','App\Http\Controllers\UserController@deletetrash')->name('user.remove')->middleware('checkpermission:delete_user');
Route::get('/restore-user-trash/{id}','App\Http\Controllers\UserController@restoretrash')->name('user.restore')->middleware('checkpermission:restore_user');

//Route::resource('role','RoleController');
Route::get('/role', 'App\Http\Controllers\RoleController@index')->name('role.index');
Route::post('/role', 'App\Http\Controllers\RoleController@store')->name('role.store');
Route::get('/role/create', 'App\Http\Controllers\RoleController@create')->name('role.create');
Route::get('/role/{role}', 'App\Http\Controllers\@show')->name('role.show');
Route::put('/role/{role}', 'App\Http\Controllers\RoleController@update')->name('role.update');
Route::delete('/role/{role}', 'App\Http\Controllers\RoleController@destroy')->name('role.destroy');
Route::get('/role/{role}/edit', 'App\Http\Controllers\RoleController@edit')->name('role.edit');


Route::get('/role-trash','App\Http\Controllers\RoleController@trashindex')->name('role.trash');
Route::delete('/removeroletrash/{id}','App\Http\Controllers\RoleController@deletetrash')->name('role.remove');
Route::get('/restoreroletrash/{id}','App\Http\Controllers\RoleController@restoretrash')->name('role.restore');
Route::get('/module/{id}/role', 'App\Http\Controllers\RoleController@assignmodules')->name('role.assignmodules');
Route::get('/module/{id}/view', 'App\Http\Controllers\RoleController@viewmodules')->name('role.viewmodules');
Route::post('/module/{id}/role', 'App\Http\Controllers\RoleController@storemodules')->name('role.storemodules');
Route::get('/permission/{id}/role', 'App\Http\Controllers\RoleController@assignpermission')->name('role.assignpermission');
Route::post('/permission/{id}/role', 'App\Http\Controllers\RoleController@storepermissions')->name('role.storepermissions');
Route::get('/permission/{id}/view/permission', 'App\Http\Controllers\RoleController@viewroles')->name('permission.viewroles');


Route::resource('module','App\Http\Controllers\ModuleController');
Route::get('/module-trash','App\Http\Controllers\ModuleController@trashindex')->name('module.trash');
Route::delete('/removemoduletrash/{id}','App\Http\Controllers\ModuleController@deletetrash')->name('module.remove');
Route::get('/restoremoduletrash/{id}','App\Http\Controllers\ModuleController@restoretrash')->name('module.restore');
Route::get('/module/{id}/view/role', 'App\Http\Controllers\ModuleController@viewroles')->name('module.viewroles');



Route::resource('permission', 'App\Http\Controllers\PermissionController');
Route::get('/permission-trash','App\Http\Controllers\PermissionController@trashindex')->name('permission.trash');
Route::delete('/remove-permission-trash/{id}','App\Http\Controllers\PermissionController@deletetrash')->name('permission.remove');
Route::get('/restore-permission-trash/{id}','App\Http\Controllers\PermissionController@restoretrash')->name('permission.restore');
Route::get('/permission/{id}/view/permission', 'App\Http\Controllers\PermissionController@viewroles')->name('permission.viewroles');

//end of ACL Routes

//Employee
Route::get('/employee', 'App\Http\Controllers\EmployeeController@index')->name('employee.index');
Route::get('/employee/create', 'App\Http\Controllers\EmployeeController@create')->name('employee.create')->middleware('checkpermission:create_employee');
Route::post('/employee', 'App\Http\Controllers\EmployeeController@store')->name('employee.store')->middleware('checkpermission:create_employee');
Route::put('/employee/{id}/user/{userid}', 'App\Http\Controllers\EmployeeController@update')->name('employee.update')->middleware('checkpermission:edit_employee');
Route::delete('/employee/{employee}', 'App\Http\Controllers\EmployeeController@destroy')->name('employee.destroy')->middleware('checkpermission:trash_employee');
Route::get('/employee/{employee}/edit', 'App\Http\Controllers\EmployeeController@edit')->name('employee.edit')->middleware('checkpermission:edit_employee');
Route::get('/employee-trash','App\Http\Controllers\EmployeeController@trashindex')->name('employee.trash');
Route::delete('/remove-employee-trash/{id}','App\Http\Controllers\EmployeeController@deletetrash')->name('employee.remove')->middleware('checkpermission:delete_employee');
Route::get('/restore-employee-trash/{id}','App\Http\Controllers\EmployeeController@restoretrash')->name('employee.restore')->middleware('checkpermission:restore_employee');
Route::get('/employee/{id}/show', 'App\Http\Controllers\EmployeeController@show')->name('employee.show');
Route::get('/employee-department/designation', 'App\Http\Controllers\EmployeeController@getDesignation')->name('employee-department.designation');
Route::get('/cv/download/{file}', 'App\Http\Controllers\EmployeeController@cvDownload');
Route::get('/citizenship/download/{file}', 'App\Http\Controllers\EmployeeController@citizenshipDownload');

//End Employee

//Attributes

Route::get('/attribute', 'App\Http\Controllers\AttributeController@index')->name('attribute.index');
Route::get('/attribute/create', 'App\Http\Controllers\AttributeController@create')->name('attribute.create')->middleware('checkpermission:create_attributes');
Route::post('/attribute', 'App\Http\Controllers\AttributeController@store')->name('attribute.store')->middleware('checkpermission:create_attributes');
Route::put('/attribute/{attribute}', 'App\Http\Controllers\AttributeController@update')->name('attribute.update')->middleware('checkpermission:edit_attributes');
Route::delete('/attribute/{attribute}', 'App\Http\Controllers\AttributeController@destroy')->name('attribute.destroy')->middleware('checkpermission:trash_attributes');
Route::get('/attribute/{attribute}/edit', 'App\Http\Controllers\AttributeController@edit')->name('attribute.edit')->middleware('checkpermission:edit_attributes');
Route::get('/attribute-trash','App\Http\Controllers\AttributeController@trashindex')->name('attribute.trash');
Route::delete('/remove-attribute-trash/{id}','App\Http\Controllers\AttributeController@deletetrash')->name('attribute.remove')->middleware('checkpermission:delete_attributes');
Route::get('/restore-attribute-trash/{id}','App\Http\Controllers\AttributeController@restoretrash')->name('attribute.restore')->middleware('checkpermission:restore_attributes');

//End Attributes

//Primary Groups
Route::get('/primary-groups', 'App\Http\Controllers\PrimaryGroupController@index')->name('primary-groups.index');
Route::get('/primary-groups/create', 'App\Http\Controllers\PrimaryGroupController@create')->name('primary-groups.create')->middleware('checkpermission:create_primary_group');
Route::post('/primary-groups', 'App\Http\Controllers\PrimaryGroupController@store')->name('primary-groups.store')->middleware('checkpermission:create_primary_group');
Route::put('/primary-groups/{primarygroups}', 'App\Http\Controllers\PrimaryGroupController@update')->name('primary-groups.update')->middleware('checkpermission:edit_primary_group');
Route::delete('/primary-groups/{primarygroups}', 'App\Http\Controllers\PrimaryGroupController@destroy')->name('primary-groups.destroy')->middleware('checkpermission:trash_primary_group');
Route::get('/primary-groups/{primarygroups}/edit', 'App\Http\Controllers\PrimaryGroupController@edit')->name('primary-groups.edit')->middleware('checkpermission:edit_primary_group');
Route::get('/primary-groups-trash','App\Http\Controllers\PrimaryGroupController@trashindex')->name('primary-groups.trash');
Route::delete('/remove-primary-groups-trash/{id}','App\Http\Controllers\PrimaryGroupController@deletetrash')->name('primary-groups.remove')->middleware('checkpermission:delete_primary_group');
Route::get('/restore-primary-groups-trash/{id}','App\Http\Controllers\PrimaryGroupController@restoretrash')->name('primary-groups.restore')->middleware('checkpermission:restore_primary_group');
Route::get('/primary-groups/{id}/view', 'App\Http\Controllers\PrimaryGroupController@viewsecondary')->name('primary-groups.viewsecondary');
//End Primary Groups

//Secondary Groups
Route::get('/secondary-groups', 'App\Http\Controllers\SecondaryGroupController@index')->name('secondary-groups.index');
Route::get('/secondary-groups/create', 'App\Http\Controllers\SecondaryGroupController@create')->name('secondary-groups.create')->middleware('checkpermission:create_secondary_group');
Route::post('/secondary-groups', 'App\Http\Controllers\SecondaryGroupController@store')->name('secondary-groups.store')->middleware('checkpermission:create_secondary_group');
Route::put('/secondary-groups/{secondarygroups}', 'App\Http\Controllers\SecondaryGroupController@update')->name('secondary-groups.update')->middleware('checkpermission:edit_secondary_group');
Route::delete('/secondary-groups/{secondarygroups}', 'App\Http\Controllers\SecondaryGroupController@destroy')->name('secondary-groups.destroy')->middleware('checkpermission:trash_secondary_group');
Route::get('/secondary-groups/{secondarygroups}/edit', 'App\Http\Controllers\SecondaryGroupController@edit')->name('secondary-groups.edit')->middleware('checkpermission:edit_secondary_group');
Route::get('/secondary-groups-trash','App\Http\Controllers\SecondaryGroupController@trashindex')->name('secondary-groups.trash');
Route::delete('/remove-secondary-groups-trash/{id}','App\Http\Controllers\SecondaryGroupController@deletetrash')->name('secondary-groups.remove')->middleware('checkpermission:delete_secondary_group');
Route::get('/restore-secondary-groups-trash/{id}','App\Http\Controllers\SecondaryGroupController@restoretrash')->name('secondary-groups.restore')->middleware('checkpermission:restore_secondary_group');
Route::get('/secondary-groups/{secondarygroups}/single', 'App\Http\Controllers\SecondaryGroupController@show')->name('secondary-groups.single');
//End Secondary Groups

//Job category
Route::get('/job-category', 'App\Http\Controllers\JobCategoryController@index')->name('job-category.index');
Route::get('/job-category/create', 'App\Http\Controllers\JobCategoryController@create')->name('job-category.create')->middleware('checkpermission:create_job_category');
Route::post('/job-category', 'App\Http\Controllers\JobCategoryController@store')->name('job-category.store')->middleware('checkpermission:create_job_category');
Route::put('/job-category/{id}', 'App\Http\Controllers\JobCategoryController@update')->name('job-category.update')->middleware('checkpermission:edit_job_category');
Route::delete('/job-category/{jobcategory}', 'App\Http\Controllers\JobCategoryController@destroy')->name('job-category.destroy')->middleware('checkpermission:trash_job_category');
Route::get('/job-category/{jobcategory}/edit', 'App\Http\Controllers\JobCategoryController@edit')->name('job-category.edit')->middleware('checkpermission:edit_job_category');
Route::get('/job-category-trash','App\Http\Controllers\JobCategoryController@trashindex')->name('job-category.trash');
Route::delete('/remove-job-category-trash/{id}','App\Http\Controllers\JobCategoryController@deletetrash')->name('job-category.remove')->middleware('checkpermission:delete_job_category');
Route::get('/restore-job-category-trash/{id}','App\Http\Controllers\JobCategoryController@restoretrash')->name('job-category.restore')->middleware('checkpermission:restore_job_category');
Route::get('/job-category/{id}/single', 'App\Http\Controllers\JobCategoryController@show')->name('job-category.single');
//End Job category

//Overseas Agent
Route::get('/overseas-agent', 'App\Http\Controllers\OverseasAgentController@index')->name('overseas-agent.index');
Route::get('/overseas-agent/create', 'App\Http\Controllers\OverseasAgentController@create')->name('overseas-agent.create')->middleware('checkpermission:create_overseas_agent');
Route::post('/overseas-agent', 'App\Http\Controllers\OverseasAgentController@store')->name('overseas-agent.store')->middleware('checkpermission:create_overseas_agent');
Route::put('/overseas-agent/{id}', 'App\Http\Controllers\OverseasAgentController@update')->name('overseas-agent.update')->middleware('checkpermission:edit_overseas_agent');
Route::delete('/overseas-agent/{overseasagent}', 'App\Http\Controllers\OverseasAgentController@destroy')->name('overseas-agent.destroy')->middleware('checkpermission:trash_overseas_agent');
Route::get('/overseas-agent/{overseasagent}/edit', 'App\Http\Controllers\OverseasAgentController@edit')->name('overseas-agent.edit')->middleware('checkpermission:edit_overseas_agent');
Route::get('/overseas-agent-trash','App\Http\Controllers\OverseasAgentController@trashindex')->name('overseas-agent.trash');
Route::delete('/remove-overseas-agent-trash/{id}','App\Http\Controllers\OverseasAgentController@deletetrash')->name('overseas-agent.remove')->middleware('checkpermission:delete_overseas_agent');
Route::get('/restore-overseas-agent-trash/{id}','App\Http\Controllers\OverseasAgentController@restoretrash')->name('overseas-agent.restore')->middleware('checkpermission:restore_overseas_agent');
Route::get('/overseas-agent/{overseasagent}/single', 'App\Http\Controllers\OverseasAgentController@show')->name('overseas-agent.show');
Route::get('/overseas-agent/state', 'App\Http\Controllers\OverseasAgentController@getState')->name('overseas-agent.state');
Route::patch('/overseas-agent-status/{id}/update', 'App\Http\Controllers\OverseasAgentController@statusupdate')->name('overseas-agent.status.update');
//End Overseas Agent


//Company
Route::get('/company', 'App\Http\Controllers\DemandCompanyController@index')->name('company.index');
Route::get('/company/create', 'App\Http\Controllers\DemandCompanyController@create')->name('company.create')->middleware('checkpermission:create_company');
Route::post('/company', 'App\Http\Controllers\DemandCompanyController@store')->name('company.store')->middleware('checkpermission:create_company');
Route::put('/company/{id}/update', 'App\Http\Controllers\DemandCompanyController@update')->name('company.update')->middleware('checkpermission:edit_company');
Route::delete('/company/{company}', 'App\Http\Controllers\DemandCompanyController@destroy')->name('company.destroy')->middleware('checkpermission:trash_company');
Route::get('/company/{company}/edit', 'App\Http\Controllers\DemandCompanyController@edit')->name('company.edit')->middleware('checkpermission:edit_company');
Route::get('/company-trash','App\Http\Controllers\DemandCompanyController@trashindex')->name('company.trash');
Route::delete('/remove-company-trash/{id}','App\Http\Controllers\DemandCompanyController@deletetrash')->name('company.remove')->middleware('checkpermission:delete_company');
Route::get('/restore-company-trash/{id}','App\Http\Controllers\DemandCompanyController@restoretrash')->name('company.restore')->middleware('checkpermission:restore_company');
Route::get('/company/{company}/single', 'App\Http\Controllers\DemandCompanyController@show')->name('company.show');
Route::get('/company/state', 'App\Http\Controllers\OverseasAgentController@getState')->name('company.state');
Route::patch('/company-status/{id}/update', 'App\Http\Controllers\DemandCompanyController@statusupdate')->name('company.status.update');
//End Company

//Demand Information
Route::get('/demand-info', 'App\Http\Controllers\DemandInformationController@index')->name('demand-info.index');
Route::get('/demand-info/create', 'App\Http\Controllers\DemandInformationController@create')->name('demand-info.create')->middleware('checkpermission:create_demand_info');
Route::post('/demand-info', 'App\Http\Controllers\DemandInformationController@store')->name('demand-info.store')->middleware('checkpermission:create_demand_info');
Route::put('/demand-info/{id}/', 'App\Http\Controllers\DemandInformationController@update')->name('demand-info.update')->middleware('checkpermission:edit_demand_info');
Route::delete('/demand-info/{demandinfo}', 'App\Http\Controllers\DemandInformationController@destroy')->name('demand-info.destroy')->middleware('checkpermission:trash_demand_info');
Route::get('/demand-info/{demandinfo}/edit', 'App\Http\Controllers\DemandInformationController@edit')->name('demand-info.edit')->middleware('checkpermission:edit_demand_info');
Route::get('/demand-info-trash','App\Http\Controllers\DemandInformationController@trashindex')->name('demand-info.trash');
Route::delete('/remove-demand-info-trash/{id}','App\Http\Controllers\DemandInformationController@deletetrash')->name('demand-info.remove')->middleware('checkpermission:delete_demand_info');
Route::get('/restore-demand-info-trash/{id}','App\Http\Controllers\DemandInformationController@restoretrash')->name('demand-info.restore')->middleware('checkpermission:restore_demand_info');
Route::get('/demand-info/{id}/single', 'App\Http\Controllers\DemandInformationController@show')->name('demand-info.show');
Route::patch('/demand-info-status/{id}/update', 'App\Http\Controllers\DemandInformationController@statusupdate')->name('demand-info.status.update');
//End Demand Information

//Job to demand Information
Route::get('/job-to-demand', 'App\Http\Controllers\JobtoDemandController@index')->name('job-to-demand.index');
Route::get('/job-to-demand/create', 'App\Http\Controllers\JobtoDemandController@create')->name('job-to-demand.create')->middleware('checkpermission:create_job_to_demand');
Route::post('/job-to-demand', 'App\Http\Controllers\JobtoDemandController@store')->name('job-to-demand.store')->middleware('checkpermission:create_job_to_demand');
Route::put('/job-to-demand/{id}/', 'App\Http\Controllers\JobtoDemandController@update')->name('job-to-demand.update')->middleware('checkpermission:edit_job_to_demand');
Route::delete('/job-to-demand/{jobdemand}/destory', 'App\Http\Controllers\JobtoDemandController@destroy')->name('job-to-demand.destroy')->middleware('checkpermission:trash_job_to_demand');
Route::get('/job-to-demand/{jobdemand}/edit', 'App\Http\Controllers\JobtoDemandController@edit')->name('job-to-demand.edit')->middleware('checkpermission:edit_job_to_demand');
Route::get('/job-to-demand-trash','App\Http\Controllers\JobtoDemandController@trashindex')->name('job-to-demand.trash');
Route::delete('/remove-job-to-demand-trash/{id}','App\Http\Controllers\JobtoDemandController@deletetrash')->name('job-to-demand.remove')->middleware('checkpermission:delete_job_to_demand');
Route::get('/restore-job-to-demand-trash/{id}','App\Http\Controllers\JobtoDemandController@restoretrash')->name('job-to-demand.restore')->middleware('checkpermission:restore_job_to_demand');
Route::get('/job-to-demand/{id}/single', 'App\Http\Controllers\JobtoDemandController@show')->name('job-to-demand.show');
Route::post('/return-demand-info', 'App\Http\Controllers\JobtoDemandController@getDemandInfo')->name('jobs.demand-info');
Route::patch('/job-to-demand-status/{id}/update', 'App\Http\Controllers\JobtoDemandController@statusupdate')->name('job-to-demand.status.update');

//End Job to demand Information


//Reference Information
Route::get('/reference-info', 'App\Http\Controllers\ReferenceInformationController@index')->name('reference-info.index');
Route::get('/reference-info/create', 'App\Http\Controllers\ReferenceInformationController@create')->name('reference-info.create')->middleware('checkpermission:create_reference_info');
Route::post('/reference-info', 'App\Http\Controllers\ReferenceInformationController@store')->name('reference-info.store')->middleware('checkpermission:create_reference_info');
Route::put('/reference-info/{id}/', 'App\Http\Controllers\ReferenceInformationController@update')->name('reference-info.update')->middleware('checkpermission:edit_reference_info');
Route::delete('/reference-info/{referenceinfo}', 'App\Http\Controllers\ReferenceInformationController@destroy')->name('reference-info.destroy')->middleware('checkpermission:trash_reference_info');
Route::get('/reference-info/{referenceinfo}/edit', 'App\Http\Controllers\ReferenceInformationController@edit')->name('reference-info.edit')->middleware('checkpermission:edit_reference_info');
Route::get('/reference-info-trash','App\Http\Controllers\ReferenceInformationController@trashindex')->name('reference-info.trash');
Route::delete('/remove-reference-info-trash/{id}','App\Http\Controllers\ReferenceInformationController@deletetrash')->name('reference-info.remove')->middleware('checkpermission:delete_reference_info');
Route::get('/restore-reference-info-trash/{id}','App\Http\Controllers\ReferenceInformationController@restoretrash')->name('reference-info.restore')->middleware('checkpermission:restore_reference_info');
Route::get('/reference-info/{id}/single', 'App\Http\Controllers\ReferenceInformationController@show')->name('reference-info.show');
//End Reference Information

//candidate all details route
Route::get('/candidate-all-details/{id}/', 'App\Http\Controllers\CandidatePersonalInformationController@addalldetails')->name('candidate-personal-info.addalldetails');
Route::get('/candidate-dashboard/{id}/', 'App\Http\Controllers\CandidatePersonalInformationController@individualDashboard')->name('candidate-individual.dashboard');
//end candidate details route

//ajax route
Route::post('/get-jobs-mapped-demand/', 'App\Http\Controllers\CandidatePersonalInformationController@getJobsofDemand')->name('candidate-info.getdemandcategory');
//end route

//processing routes for candidates
Route::get('/applied-candidate', 'App\Http\Controllers\ProcessingController@appliedindex')->name('applied-candidate.index');
Route::put('/applied-to-selected/{candidate}', 'App\Http\Controllers\ProcessingController@appliedToSelectedUpdate')->name('applied-to-selected.update');
Route::get('/selected-candidate', 'App\Http\Controllers\ProcessingController@selectedindex')->name('selected-candidate.index');
Route::put('/selected-to-underprocess/{candidate}', 'App\Http\Controllers\ProcessingController@selectedToUnderProcessUpdate')->name('selected-to-under.update');
Route::get('/under-process-candidate', 'App\Http\Controllers\ProcessingController@underprocessindex')->name('under-processing-candidate.index');
Route::get('/ticket-received-candidate', 'App\Http\Controllers\ProcessingController@ticketreceivedindex')->name('ticket-received-candidate.index');
Route::post('/visa-to-ticket', 'App\Http\Controllers\ProcessingController@visatoTicketReceived')->name('visa-to-ticket.store');
Route::put('/ticket-to-deployed/{candidate}', 'App\Http\Controllers\ProcessingController@ticketReceivedToDeployed')->name('ticket-to-deployed.update');
Route::put('/status-rollback-update/{id}/', 'App\Http\Controllers\ProcessingController@oneStepBackUpdate')->name('status.rollback');
Route::get('/deployed-candidate', 'App\Http\Controllers\ProcessingController@deployedindex')->name('deployed-candidate.index');
Route::put('/individual-ticket-update/{id}/', 'App\Http\Controllers\ProcessingController@individualTicketUpdate')->name('individual-ticket.update');
Route::put('/status-reapply-update/{id}/', 'App\Http\Controllers\ProcessingController@statusReapply')->name('status.reapply');
Route::put('/status-reject-update/{id}/', 'App\Http\Controllers\ProcessingController@statusReject')->name('status.reject');
Route::put('/demand-update/{demand}/', 'App\Http\Controllers\ProcessingController@demandUpdate')->name('demand.update');
Route::get('/rejected-candidate', 'App\Http\Controllers\ProcessingController@rejectedindex')->name('rejected-candidate.index');
Route::get('/cancelled-candidate', 'App\Http\Controllers\ProcessingController@cancelledindex')->name('cancelled-candidate.index');

//end of processing routes for candidates


//candidate Visa information
Route::get('/candidate-visa-info', 'App\Http\Controllers\CandidateVisaInformationController@index')->name('visa.index');
Route::get('/candidate-visa-info/create', 'App\Http\Controllers\CandidateVisaInformationController@create')->name('visa.create');
Route::post('/candidate-visa-info', 'App\Http\Controllers\CandidateVisaInformationController@store')->name('visa.store');
Route::put('/candidate-visa-info/{id}/', 'App\Http\Controllers\CandidateVisaInformationController@update')->name('visa.update');
Route::delete('/candidate-visa-info/{personalinfo}', 'App\Http\Controllers\CandidateVisaInformationController@destroy')->name('visa.destroy');
Route::get('/candidate-visa-info/{personalinfo}/edit', 'App\Http\Controllers\CandidateVisaInformationController@edit')->name('visa.edit');
Route::get('/candidate-visa-info/{id}/single', 'App\Http\Controllers\CandidateVisaInformationController@show')->name('visa.show');
Route::get('/get-airline-details/id', 'App\Http\Controllers\CandidateVisaInformationController@getAgentAirline')->name('candidate.airline');


//end of candidate visa information

// Visa Stamp information

Route::post('/visa-stamp', 'App\Http\Controllers\VisaStampController@store')->name('visa-stamp.store');
//end of visa Stamp information


//Candidate Personal Information
Route::get('/candidate-personal-info', 'App\Http\Controllers\CandidatePersonalInformationController@index')->name('candidate-personal-info.index');
Route::get('/candidate-personal-info/create', 'App\Http\Controllers\CandidatePersonalInformationController@create')->name('candidate-personal-info.create')->middleware('checkpermission:create_candidate_personal_info');
Route::post('/candidate-personal-info', 'App\Http\Controllers\CandidatePersonalInformationController@store')->name('candidate-personal-info.store')->middleware('checkpermission:create_candidate_personal_info');
Route::put('/candidate-personal-info/{id}/', 'App\Http\Controllers\CandidatePersonalInformationController@update')->name('candidate-personal-info.update')->middleware('checkpermission:edit_candidate_personal_info');
Route::delete('/candidate-personal-info/{personalinfo}', 'App\Http\Controllers\CandidatePersonalInformationController@destroy')->name('candidate-personal-info.destroy')->middleware('checkpermission:trash_candidate_personal_info');
Route::get('/candidate-personal-info/{personalinfo}/edit', 'App\Http\Controllers\CandidatePersonalInformationController@edit')->name('candidate-personal-info.edit')->middleware('checkpermission:edit_candidate_personal_info');
Route::get('/candidate-personal-info-trash','App\Http\Controllers\CandidatePersonalInformationController@trashindex')->name('candidate-personal-info.trash');
Route::delete('/remove-candidate-personal-info-trash/{id}','App\Http\Controllers\CandidatePersonalInformationController@deletetrash')->name('candidate-personal-info.remove')->middleware('checkpermission:delete_candidate_personal_info');
Route::get('/restore-candidate-personal-info-trash/{id}','App\Http\Controllers\CandidatePersonalInformationController@restoretrash')->name('candidate-personal-info.restore')->middleware('checkpermission:restore_candidate_personal_info');
Route::get('/candidate-personal-info/{id}/single', 'App\Http\Controllers\CandidatePersonalInformationController@show')->name('candidate-personal-info.show');
Route::put('/candidate-personal-application/{id}', 'App\Http\Controllers\CandidatePersonalInformationController@application')->name('candidate-personal-info.application');
Route::get('/candidate-personal-application/{id}/{name}', 'App\Http\Controllers\CandidatePersonalInformationController@application2')->name('candidate-personal-info.application2');
Route::post('/generate-cv', 'App\Http\Controllers\CandidatePersonalInformationController@cv')->name('generate_cv');
Route::post('/candidate-generate-application', 'App\Http\Controllers\CandidatePersonalInformationController@genapplication')->name('candidate-personal-info.generateapp');
Route::get('/generate-candidate-cv', 'App\Http\Controllers\CandidatePersonalInformationController@showCv')->name('generate-personal-info.cv');

//End Candidate Personal Information

//Folder and File
Route::get('/folders', 'App\Http\Controllers\FolderController@index')->name('folder.index');
Route::get('/files/{id}', 'App\Http\Controllers\FolderController@file')->name('file.index');
Route::get('/files/download/{file}', 'App\Http\Controllers\FolderController@download')->name('file.download');
Route::post('/files/store/', 'App\Http\Controllers\FolderController@store')->name('file.store')->middleware('checkpermission:create_file');
Route::delete('/files/{file}', 'App\Http\Controllers\FolderController@destroy')->name('file.destroy')->middleware('checkpermission:delete_file');
Route::get('/files/{file}/edit', 'App\Http\Controllers\FolderController@edit')->name('file.edit')->middleware('checkpermission:edit_file');
Route::put('/files/{id}/', 'App\Http\Controllers\FolderController@update')->name('file.update')->middleware('checkpermission:edit_file');

//End Folder and File




//Candidate CV Information
Route::get('/candidate-cv-info', 'App\Http\Controllers\CandidateCvController@index')->name('candidate-cv-info.index');
Route::get('/candidate-cv-info/create', 'App\Http\Controllers\CandidateCvController@create')->name('candidate-cv-info.create');
Route::post('/candidate-cv-info', 'App\Http\Controllers\CandidateCvController@store')->name('candidate-cv-info.store');
Route::put('/candidate-cv-info/{id}/', 'App\Http\Controllers\CandidateCvController@update')->name('candidate-cv-info.update');
Route::delete('/candidate-cv-info/{cv}', 'App\Http\Controllers\CandidateCvController@destroy')->name('candidate-cv-info.destroy');
Route::get('/candidate-cv-info/{cv}/edit', 'App\Http\Controllers\CandidateCvController@edit')->name('candidate-cv-info.edit');
Route::get('/candidate-cv-info/{id}/single', 'App\Http\Controllers\CandidateCvController@show')->name('candidate-cv-info.show');
Route::get('/cv-info-trash','App\Http\Controllers\CandidateCvController@trashindex')->name('candidate-cv-info.trash');
Route::delete('/remove-cv-info-trash/{id}','App\Http\Controllers\CandidateCvController@deletetrash')->name('candidate-cv-info.remove');
Route::get('/restore-cv-info-trash/{id}','App\Http\Controllers\CandidateCvController@restoretrash')->name('candidate-cv-info.restore');

//End Candidate CV Information




//Candidate Medical Information
Route::get('/candidate-medical-info', 'App\Http\Controllers\CandidateMedicalReportController@index')->name('candidate-medical-info.index');
Route::get('/candidate-medical-info/create', 'App\Http\Controllers\CandidateMedicalReportController@create')->name('candidate-medical-info.create');
Route::post('/candidate-medical-info', 'App\Http\Controllers\CandidateMedicalReportController@store')->name('candidate-medical-info.store');
Route::put('/candidate-medical-info/{id}/', 'App\Http\Controllers\CandidateMedicalReportController@update')->name('candidate-medical-info.update');
Route::delete('/candidate-medical-info/{medical}', 'App\Http\Controllers\CandidateMedicalReportController@destroy')->name('candidate-medical-info.destroy');
Route::get('/candidate-medical-info/{medical}/edit', 'App\Http\Controllers\CandidateMedicalReportController@edit')->name('candidate-medical-info.edit');
Route::get('/candidate-medical-info/{id}/single', 'App\Http\Controllers\CandidateMedicalReportController@show')->name('candidate-medical-info.show');
//End Candidate CV Information

//Candidate Professional Information
Route::get('/candidate-professional-info', 'App\Http\Controllers\CandidateProfessionalInformationController@index')->name('candidate-professional-info.index');
Route::get('/candidate-professional-info/create', 'App\Http\Controllers\CandidateProfessionalInformationController@create')->name('candidate-professional-info.create')->middleware('checkpermission:create_candidate_professional_info');
Route::post('/candidate-professional-info', 'App\Http\Controllers\CandidateProfessionalInformationController@store')->name('candidate-professional-info.store')->middleware('checkpermission:create_candidate_professional_info');
Route::put('/candidate-professional-info/{id}/', 'App\Http\Controllers\CandidateProfessionalInformationController@update')->name('candidate-professional-info.update')->middleware('checkpermission:edit_candidate_professional_info');
Route::delete('/candidate-professional-info/{professionalinfo}', 'App\Http\Controllers\CandidateProfessionalInformationController@destroy')->name('candidate-professional-info.destroy')->middleware('checkpermission:delete_candidate_professional_info');
Route::get('/candidate-professional-info/{professionalinfo}/edit', 'App\Http\Controllers\CandidateProfessionalInformationController@edit')->name('candidate-professional-info.edit')->middleware('checkpermission:edit_candidate_professional_info');
Route::get('/candidate-professional-info/{id}/single', 'App\Http\Controllers\CandidateProfessionalInformationController@show')->name('candidate-professional-info.show');
//End Candidate Professional Information

//Candidate Professional trainings information
Route::get('/candidate-professional-training', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingindex')->name('candidate-professional-training.index');
Route::get('/candidate-professional-training/create', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingcreate')->name('candidate-professional-training.create')->middleware('checkpermission:create_candidate_professional_training');
Route::post('/candidate-professional-training/store', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingstore')->name('candidate-professional-training.store')->middleware('checkpermission:create_candidate_professional_training');
Route::put('/candidate-professional-training/{id}/', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingupdate')->name('candidate-professional-training.update')->middleware('checkpermission:edit_candidate_professional_training');
Route::delete('/candidate-professional-training/{professionaltraining}', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingdestroy')->name('candidate-professional-training.destroy')->middleware('checkpermission:delete_candidate_professional_training');
Route::get('/candidate-professional-training/{professionaltraining}/edit', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingedit')->name('candidate-professional-training.edit')->middleware('checkpermission:edit_candidate_professional_training');
Route::get('/candidate-professional-training/{id}/single', 'App\Http\Controllers\CandidateProfessionalInformationController@trainingshow')->name('candidate-professional-training.show');
//End Candidate Professional training information

//Candidate Qualification information
Route::get('/candidate-qualification-info', 'App\Http\Controllers\CandidateQualificationController@index')->name('candidate-qualification-info.index');
Route::get('/candidate-qualification-info/create', 'App\Http\Controllers\CandidateQualificationController@create')->name('candidate-qualification-info.create')->middleware('checkpermission:create_candidate_qualification_info');
Route::post('/candidate-qualification-info/store', 'App\Http\Controllers\CandidateQualificationController@store')->name('candidate-qualification-info.store')->middleware('checkpermission:create_candidate_qualification_info');
Route::put('/candidate-qualification-info/{id}/', 'App\Http\Controllers\CandidateQualificationController@update')->name('candidate-qualification-info.update')->middleware('checkpermission:edit_candidate_qualification_info');
Route::delete('/candidate-qualification-info/{qualificationinfo}', 'App\Http\Controllers\CandidateQualificationController@destroy')->name('candidate-qualification-info.destroy')->middleware('checkpermission:delete_candidate_qualification_info');
Route::get('/candidate-qualification-info/{qualificationinfo}/edit', 'App\Http\Controllers\CandidateQualificationController@edit')->name('candidate-qualification-info.edit')->middleware('checkpermission:edit_candidate_qualification_info');
Route::get('/candidate-qualification-info/{id}/single', 'App\Http\Controllers\CandidateQualificationController@show')->name('candidate-qualification-info.show');
//End Candidate Qualification information

//Candidate police report information
Route::get('/candidate-police-report-info', 'App\Http\Controllers\CandidatePoliceReportController@index')->name('candidate-report-info.index');
Route::get('/candidate-police-report-info/create', 'App\Http\Controllers\CandidatePoliceReportController@create')->name('candidate-report-info.create')->middleware('checkpermission:create_candidate_police_report_info');
Route::post('/candidate-police-report-info/store', 'App\Http\Controllers\CandidatePoliceReportController@store')->name('candidate-report-info.store')->middleware('checkpermission:create_candidate_police_report_info');
Route::put('/candidate-police-report-info/{id}/', 'App\Http\Controllers\CandidatePoliceReportController@update')->name('candidate-report-info.update')->middleware('checkpermission:edit_candidate_police_report_info');
Route::delete('/candidate-police-report-info/{info}', 'App\Http\Controllers\CandidatePoliceReportController@destroy')->name('candidate-report-info.destroy')->middleware('checkpermission:delete_candidate_police_report_info');
Route::get('/candidate-police-report-info/{info}/edit', 'App\Http\Controllers\CandidatePoliceReportController@edit')->name('candidate-report-info.edit')->middleware('checkpermission:edit_candidate_police_report_info');
Route::get('/candidate-police-report-info/{id}/single', 'App\Http\Controllers\CandidatePoliceReportController@show')->name('candidate-report-info.show');
//End Candidate police report information

//Candidate police report information
Route::get('/candidate-pcc-report-info', 'App\Http\Controllers\CandidatePCCReportController@index')->name('candidate-pcc-info.index');
Route::get('/candidate-pcc-report-info/create', 'App\Http\Controllers\CandidatePCCReportController@create')->name('candidate-pcc-info.create')->middleware('checkpermission:create_candidate_pcc_report_info');
Route::post('/candidate-pcc-report-info/store', 'App\Http\Controllers\CandidatePCCReportController@store')->name('candidate-pcc-info.store')->middleware('checkpermission:create_candidate_pcc_report_info');
Route::put('/candidate-pcc-report-info/{id}/', 'App\Http\Controllers\CandidatePCCReportController@update')->name('candidate-pcc-info.update')->middleware('checkpermission:edit_candidate_pcc_report_info');
Route::delete('/candidate-pcc-report-info/{info}', 'App\Http\Controllers\CandidatePCCReportController@destroy')->name('candidate-pcc-info.destroy')->middleware('checkpermission:delete_candidate_pcc_report_info');
Route::get('/candidate-pcc-report-info/{info}/edit', 'App\Http\Controllers\CandidatePCCReportController@edit')->name('candidate-pcc-info.edit')->middleware('checkpermission:edit_candidate_pcc_report_info');
Route::get('/candidate-pcc-report-info/{id}/single', 'App\Http\Controllers\CandidatePCCReportController@show')->name('candidate-pcc-info.show');
//End Candidate police report information

//Candidate Language information
Route::get('/candidate-language-info', 'App\Http\Controllers\CandidateQualificationController@languageindex')->name('candidate-language-info.index');
Route::get('/candidate-language-info/create', 'App\Http\Controllers\CandidateQualificationController@languagecreate')->name('candidate-language-info.create')->middleware('checkpermission:create_candidate_language_info');
Route::post('/candidate-language-info/store', 'App\Http\Controllers\CandidateQualificationController@languagestore')->name('candidate-language-info.store')->middleware('checkpermission:create_candidate_language_info');
Route::put('/candidate-language-info/{id}/', 'App\Http\Controllers\CandidateQualificationController@languageupdate')->name('candidate-language-info.update')->middleware('checkpermission:edit_candidate_language_info');
Route::delete('/candidate-language-info/{languageinfo}', 'App\Http\Controllers\CandidateQualificationController@languagedestroy')->name('candidate-language-info.destroy')->middleware('checkpermission:delete_candidate_language_info');
Route::get('/candidate-language-info/{languageinfo}/edit', 'App\Http\Controllers\CandidateQualificationController@languageedit')->name('candidate-language-info.edit')->middleware('checkpermission:edit_candidate_language_info');
Route::get('/candidate-language-info/{id}/single', 'App\Http\Controllers\CandidateQualificationController@languageshow')->name('candidate-language-info.show');
//End Candidate Language information

//Candidate Document information
Route::get('/candidate-document-info', 'App\Http\Controllers\CandidateDocumentController@index')->name('candidate-document-info.index');
Route::get('/candidate-document-info/create', 'App\Http\Controllers\CandidateDocumentController@create')->name('candidate-document-info.create')->middleware('checkpermission:create_candidate_document_info');
Route::post('/candidate-document-info/store', 'App\Http\Controllers\CandidateDocumentController@store')->name('candidate-document-info.store')->middleware('checkpermission:create_candidate_document_info');
Route::put('/candidate-document-info/{id}/', 'App\Http\Controllers\CandidateDocumentController@update')->name('candidate-document-info.update')->middleware('checkpermission:edit_candidate_document_info');
Route::delete('/candidate-document-info/{documentinfo}', 'App\Http\Controllers\CandidateDocumentController@destroy')->name('candidate-document-info.destroy')->middleware('checkpermission:delete_candidate_document_info');
Route::get('/candidate-document-info/{documentinfo}/edit', 'App\Http\Controllers\CandidateDocumentController@edit')->name('candidate-document-info.edit')->middleware('checkpermission:edit_candidate_document_info');
Route::get('/candidate-document-info/{id}/single', 'App\Http\Controllers\CandidateDocumentController@show')->name('candidate-document-info.show');
//End Candidate Document information


//Candidate Demand job information
Route::get('/candidate-demand-job-info', 'App\Http\Controllers\CandidateDemandJobInfoController@index')->name('candidate-demand-job-info.index');
Route::get('/candidate-demand-job-info/create', 'App\Http\Controllers\CandidateDemandJobInfoController@create')->name('candidate-demand-job-info.create')->middleware('checkpermission:create_candidate_demand_job_info');
Route::post('/candidate-demand-job-info/store', 'App\Http\Controllers\CandidateDemandJobInfoController@store')->name('candidate-demand-job-info.store')->middleware('checkpermission:create_candidate_demand_job_info');
Route::put('/candidate-demand-job-info/{id}/', 'App\Http\Controllers\CandidateDemandJobInfoController@update')->name('candidate-demand-job-info.update')->middleware('checkpermission:edit_candidate_demand_job_info');
Route::delete('/candidate-demand-job-info/{demandjobinfo}', 'App\Http\Controllers\CandidateDemandJobInfoController@destroy')->name('candidate-demand-job-info.destroy')->middleware('checkpermission:delete_candidate_demand_job_info');
Route::get('/candidate-demand-job-info/{demandjobinfo}/edit', 'App\Http\Controllers\CandidateDemandJobInfoController@edit')->name('candidate-demand-job-info.edit')->middleware('checkpermission:edit_candidate_demand_job_info');
Route::get('/candidate-demand-job-info/{id}/single', 'App\Http\Controllers\CandidateDemandJobInfoController@show')->name('candidate-demand-job-info.show');
//End Candidate Demand job information

//Candidate Bank information
Route::get('/candidate-bank-info', 'App\Http\Controllers\CandidateDocumentController@bankindex')->name('candidate-bank-info.index');
Route::get('/candidate-bank-info/create', 'App\Http\Controllers\CandidateDocumentController@bankcreate')->name('candidate-bank-info.create')->middleware('checkpermission:create_candidate_bank_info');
Route::post('/candidate-bank-info/store', 'App\Http\Controllers\CandidateDocumentController@bankstore')->name('candidate-bank-info.store')->middleware('checkpermission:create_candidate_bank_info');
Route::put('/candidate-bank-info/{id}/', 'App\Http\Controllers\CandidateDocumentController@bankupdate')->name('candidate-bank-info.update')->middleware('checkpermission:edit_candidate_bank_info');
Route::delete('/candidate-bank-info/{bankinfo}', 'App\Http\Controllers\CandidateDocumentController@bankdestroy')->name('candidate-bank-info.destroy')->middleware('checkpermission:delete_candidate_bank_info');
Route::get('/candidate-bank-info/{bankinfo}/edit', 'App\Http\Controllers\CandidateDocumentController@bankedit')->name('candidate-bank-info.edit')->middleware('checkpermission:edit_candidate_bank_info');
Route::get('/candidate-bank-info/{id}/single', 'App\Http\Controllers\CandidateDocumentController@bankshow')->name('candidate-bank-info.show');
//End Candidate Bank information

//Candidate License information
Route::get('/candidate-license-info', 'App\Http\Controllers\CandidateLicenseController@index')->name('candidate-license-info.index');
Route::get('/candidate-license-info/create', 'App\Http\Controllers\CandidateLicenseController@create')->name('candidate-license-info.create')->middleware('checkpermission:create_candidate_license_info');
Route::post('/candidate-license-info/store', 'App\Http\Controllers\CandidateLicenseController@store')->name('candidate-license-info.store')->middleware('checkpermission:create_candidate_license_info');
Route::put('/candidate-license-info/{id}/', 'App\Http\Controllers\CandidateLicenseController@update')->name('candidate-license-info.update')->middleware('checkpermission:edit_candidate_license_info');
Route::delete('/candidate-license-info/{licenseinfo}', 'App\Http\Controllers\CandidateLicenseController@destroy')->name('candidate-license-info.destroy')->middleware('checkpermission:delete_candidate_license_info');
Route::get('/candidate-license-info/{licenseinfo}/edit', 'App\Http\Controllers\CandidateLicenseController@edit')->name('candidate-license-info.edit')->middleware('checkpermission:edit_candidate_license_info');
Route::get('/candidate-license-info/{id}/single', 'App\Http\Controllers\CandidateLicenseController@show')->name('candidate-license-info.show');
//End Candidate License information

//Sub Status
Route::get('/sub-status', 'App\Http\Controllers\SubStatusController@index')->name('sub-status.index');
Route::get('/sub-status/create', 'App\Http\Controllers\SubStatusController@create')->name('sub-status.create')->middleware('checkpermission:create_sub_status');
Route::post('/sub-status', 'App\Http\Controllers\SubStatusController@store')->name('sub-status.store')->middleware('checkpermission:create_sub_status');
Route::put('/sub-status/{id}', 'App\Http\Controllers\SubStatusController@update')->name('sub-status.update')->middleware('checkpermission:edit_sub_status');
Route::delete('/sub-status/{substatus}', 'App\Http\Controllers\SubStatusController@destroy')->name('sub-status.destroy')->middleware('checkpermission:trash_sub_status');
Route::get('/sub-status/{substatus}/edit', 'App\Http\Controllers\SubStatusController@edit')->name('sub-status.edit')->middleware('checkpermission:edit_sub_status');
Route::get('/sub-status-trash','App\Http\Controllers\SubStatusController@trashindex')->name('sub-status.trash');
Route::delete('/remove-sub-status-trash/{id}','App\Http\Controllers\SubStatusController@deletetrash')->name('sub-status.remove')->middleware('checkpermission:delete_sub_status');
Route::get('/restore-sub-status-trash/{id}','App\Http\Controllers\SubStatusController@restoretrash')->name('sub-status.restore')->middleware('checkpermission:restore_sub_status');
Route::get('/sub-status/{id}/single', 'App\Http\Controllers\SubStatusController@show')->name('sub-status.single');
//End Sub Status


//Journal Entry
Route::get('/journal-entry', 'App\Http\Controllers\JournalEntryController@index')->name('journal-entry.index');
Route::get('/journal-entry/{journalentry}/single-print', 'App\Http\Controllers\JournalEntryController@showprint')->name('journal-entry.print');
Route::get('/journal-entry/{journalentry}/single', 'App\Http\Controllers\JournalEntryController@show')->name('journal-entry.single');
Route::get('/journal-entry/create', 'App\Http\Controllers\JournalEntryController@create')->name('journal-entry.create')->middleware('checkpermission:create_journal_entry');
Route::post('/journal-entry', 'App\Http\Controllers\JournalEntryController@store')->name('journal-entry.store');
Route::put('/journal-entry/{journalentry}', 'App\Http\Controllers\JournalEntryController@update')->name('journal-entry.update');
Route::delete('/journal-entry/{journalentry}', 'App\Http\Controllers\JournalEntryController@destroy')->name('journal-entry.destroy')->middleware('checkpermission:trash_journal_entry');
Route::get('/journal-entry/{journalentry}/edit', 'App\Http\Controllers\JournalEntryController@edit')->name('journal-entry.edit')->middleware('checkpermission:edit_journal_entry');
Route::get('/journal-entry-trash','App\Http\Controllers\JournalEntryController@trashindex')->name('journal-entry.trash');
Route::delete('/remove-journal-entry-trash/{id}','App\Http\Controllers\JournalEntryController@deletetrash')->name('journal-entry.remove')->middleware('checkpermission:delete_journal_entry');
Route::get('/restore-journal-entry-trash/{id}','App\Http\Controllers\JournalEntryController@restoretrash')->name('journal-entry.restore')->middleware('checkpermission:restore_journal_entry');
//End Journal Entry


//Payment Voucher
Route::get('/payment-voucher', 'App\Http\Controllers\PaymentVoucherController@index')->name('payment-voucher.index');
Route::get('/payment-voucher/{paymentvoucher}/single', 'App\Http\Controllers\PaymentVoucherController@show')->name('payment-voucher.single');
Route::get('/payment-voucher/{paymentvoucher}/single-print', 'App\Http\Controllers\PaymentVoucherController@showprint')->name('payment-voucher.print');
Route::get('/payment-voucher/create', 'App\Http\Controllers\PaymentVoucherController@create')->name('payment-voucher.create')->middleware('checkpermission:create_payment_voucher');
Route::post('/payment-voucher', 'App\Http\Controllers\PaymentVoucherController@store')->name('payment-voucher.store');
Route::put('/payment-voucher/{refnum}', 'App\Http\Controllers\PaymentVoucherController@update')->name('payment-voucher.update');
Route::delete('/payment-voucher/{refnum}', 'App\Http\Controllers\PaymentVoucherController@destroy')->name('payment-voucher.destroy')->middleware('checkpermission:trash_payment_voucher');
Route::get('/payment-voucher/{refnum}/edit', 'App\Http\Controllers\PaymentVoucherController@edit')->name('payment-voucher.edit')->middleware('checkpermission:edit_payment_voucher');
Route::get('/payment-voucher-trash','App\Http\Controllers\PaymentVoucherController@trashindex')->name('payment-voucher.trash');
Route::delete('/remove-payment-voucher-trash/{id}','App\Http\Controllers\PaymentVoucherController@deletetrash')->name('payment-voucher.remove')->middleware('checkpermission:delete_payment_voucher');
Route::get('/restore-payment-voucher-trash/{id}','App\Http\Controllers\PaymentVoucherController@restoretrash')->name('payment-voucher.restore')->middleware('checkpermission:restore_payment_voucher');
//End Payment Voucher


//Payment Voucher
Route::get('/receipt-voucher', 'App\Http\Controllers\ReceiptVoucherController@index')->name('receipt-voucher.index');
Route::get('/receipt-voucher/{receiptvoucher}/single', 'App\Http\Controllers\ReceiptVoucherController@show')->name('receipt-voucher.single');
Route::get('/receipt-voucher/{receiptvoucher}/single-print', 'App\Http\Controllers\ReceiptVoucherController@showprint')->name('receipt-voucher.print');
Route::get('/receipt-voucher/create', 'App\Http\Controllers\ReceiptVoucherController@create')->name('receipt-voucher.create')->middleware('checkpermission:create_receipt_voucher');
Route::get('/receipt-voucher/{receiptvoucher}/single-print', 'App\Http\Controllers\ReceiptVoucherController@showprint')->name('receipt-voucher.print');
Route::post('/receipt-voucher', 'App\Http\Controllers\ReceiptVoucherController@store')->name('receipt-voucher.store');
Route::put('/receipt-voucher/{refnum}', 'App\Http\Controllers\ReceiptVoucherController@update')->name('receipt-voucher.update');
Route::delete('/receipt-voucher/{refnum}', 'App\Http\Controllers\ReceiptVoucherController@destroy')->name('receipt-voucher.destroy')->middleware('checkpermission:trash_receipt_voucher');
Route::get('/receipt-voucher/{refnum}/edit', 'App\Http\Controllers\ReceiptVoucherController@edit')->name('receipt-voucher.edit')->middleware('checkpermission:edit_receipt_voucher');
Route::get('/receipt-voucher-trash','App\Http\Controllers\ReceiptVoucherController@trashindex')->name('receipt-voucher.trash');
Route::delete('/remove-receipt-voucher-trash/{id}','App\Http\Controllers\ReceiptVoucherController@deletetrash')->name('receipt-voucher.remove')->middleware('checkpermission:delete_receipt_voucher');
Route::get('/restore-receipt-voucher-trash/{id}','App\Http\Controllers\ReceiptVoucherController@restoretrash')->name('receipt-voucher.restore')->middleware('checkpermission:restore_receipt_voucher');
//End Payment Voucher

//Payment Voucher
Route::get('/contra-voucher', 'App\Http\Controllers\ContraVoucherController@index')->name('contra-voucher.index');
Route::get('/contra-voucher/{contravoucher}/single', 'App\Http\Controllers\ContraVoucherController@show')->name('contra-voucher.single');
Route::get('/contra-voucher/{contravoucher}/single-print', 'App\Http\Controllers\ContraVoucherController@showprint')->name('contra-voucher.print');
Route::get('/contra-voucher/create', 'App\Http\Controllers\ContraVoucherController@create')->name('contra-voucher.create')->middleware('checkpermission:create_contra_voucher');
Route::post('/contra-voucher', 'App\Http\Controllers\ContraVoucherController@store')->name('contra-voucher.store');
Route::put('/contra-voucher/{refnum}', 'App\Http\Controllers\ContraVoucherController@update')->name('contra-voucher.update');
Route::delete('/contra-voucher/{refnum}', 'App\Http\Controllers\ContraVoucherController@destroy')->name('contra-voucher.destroy')->middleware('checkpermission:trash_contra_voucher');
Route::get('/contra-voucher/{refnum}/edit', 'App\Http\Controllers\ContraVoucherController@edit')->name('contra-voucher.edit')->middleware('checkpermission:edit_contra_voucher');
Route::get('/contra-voucher-trash','App\Http\Controllers\ContraVoucherController@trashindex')->name('contra-voucher.trash');
Route::delete('/remove-contra-voucher-trash/{id}','App\Http\Controllers\ContraVoucherController@deletetrash')->name('contra-voucher.remove')->middleware('checkpermission:delete_contra_voucher');
Route::get('/restore-contra-voucher-trash/{id}','App\Http\Controllers\ContraVoucherController@restoretrash')->name('contra-voucher.restore')->middleware('checkpermission:restore_contra_voucher');
//End Payment Voucher

//ajax requests
Route::post('/get-credit-confirmation', 'App\Http\Controllers\PaymentVoucherController@creditcheck')->name('credit.check');
Route::post('/get-debit-confirmation', 'App\Http\Controllers\ReceiptVoucherController@debitcheck')->name('debit.check');
Route::post('/contra-bank-check', 'App\Http\Controllers\ContraVoucherController@bankcheck')->name('bank.check');
Route::post('/return-primary-attributes', 'App\Http\Controllers\SecondaryGroupController@getPrimaryAttributes')->name('primary.attributes');

//Health clinic
Route::get('/health-clinic', 'App\Http\Controllers\HealthClinicController@index')->name('health-clinic.index');
Route::get('/health-clinic/create', 'App\Http\Controllers\HealthClinicController@create')->name('health-clinic.create')->middleware('checkpermission:create_health_clinic');
Route::post('/health-clinic/store', 'App\Http\Controllers\HealthClinicController@store')->name('health-clinic.store')->middleware('checkpermission:create_health_clinic');
Route::put('/health-clinic/{id}/', 'App\Http\Controllers\HealthClinicController@update')->name('health-clinic.update')->middleware('checkpermission:edit_health_clinic');
Route::delete('/health-clinic/{healthclinic}', 'App\Http\Controllers\HealthClinicController@destroy')->name('health-clinic.destroy')->middleware('checkpermission:trash_health_clinic');
Route::get('/health-clinic/{healthclinic}/edit', 'App\Http\Controllers\HealthClinicController@edit')->name('health-clinic.edit')->middleware('checkpermission:edit_health_clinic');
Route::get('/health-clinic/{id}/single', 'App\Http\Controllers\HealthClinicController@show')->name('health-clinic.show');
Route::get('/health-clinic-trash','App\Http\Controllers\HealthClinicController@trashindex')->name('health-clinic.trash');
Route::delete('/remove-health-clinic-trash/{id}','App\Http\Controllers\HealthClinicController@deletetrash')->name('health-clinic.remove')->middleware('checkpermission:delete_health_clinic');
Route::get('/restore-health-clinic-trash/{id}','App\Http\Controllers\HealthClinicController@restoretrash')->name('health-clinic.restore')->middleware('checkpermission:restore_health_clinic');
Route::patch('/health-clinic-status/{id}/update', 'App\Http\Controllers\HealthClinicController@statusupdate')->name('health-clinic.status.update');
//Health clinic

//Advertising Agent
Route::get('/advertising-agent', 'App\Http\Controllers\AdvertisingAgentController@index')->name('advertising-agent.index');
Route::get('/advertising-agent/create', 'App\Http\Controllers\AdvertisingAgentController@create')->name('advertising-agent.create')->middleware('checkpermission:create_advertising_agent');
Route::post('/advertising-agent/store', 'App\Http\Controllers\AdvertisingAgentController@store')->name('advertising-agent.store')->middleware('checkpermission:create_advertising_agent');
Route::put('/advertising-agent/{id}/', 'App\Http\Controllers\AdvertisingAgentController@update')->name('advertising-agent.update')->middleware('checkpermission:edit_advertising_agent');
Route::delete('/advertising-agent/{advertisingagent}', 'App\Http\Controllers\AdvertisingAgentController@destroy')->name('advertising-agent.destroy')->middleware('checkpermission:trash_advertising_agent');
Route::get('/advertising-agent/{advertisingagent}/edit', 'App\Http\Controllers\AdvertisingAgentController@edit')->name('advertising-agent.edit')->middleware('checkpermission:edit_advertising_agent');
Route::get('/advertising-agent/{id}/single', 'App\Http\Controllers\AdvertisingAgentController@show')->name('advertising-agent.show');
Route::get('/advertising-agent-trash','App\Http\Controllers\AdvertisingAgentController@trashindex')->name('advertising-agent.trash');
Route::delete('/remove-advertising-agent-trash/{id}','App\Http\Controllers\AdvertisingAgentController@deletetrash')->name('advertising-agent.remove')->middleware('checkpermission:delete_advertising_agent');
Route::get('/restore-advertising-agent-trash/{id}','App\Http\Controllers\AdvertisingAgentController@restoretrash')->name('advertising-agent.restore')->middleware('checkpermission:restore_advertising_agent');
Route::patch('/advertising-agent-status/{id}/update', 'App\Http\Controllers\AdvertisingAgentController@statusupdate')->name('advertising-agent.status.update');
//Advertising Agent

//Ticketing Agent
Route::get('/ticketing-agent', 'App\Http\Controllers\TicketingAgentController@index')->name('ticketing-agent.index');
Route::get('/ticketing-agent/create', 'App\Http\Controllers\TicketingAgentController@create')->name('ticketing-agent.create')->middleware('checkpermission:create_ticketing_agent');
Route::post('/ticketing-agent/store', 'App\Http\Controllers\TicketingAgentController@store')->name('ticketing-agent.store')->middleware('checkpermission:create_ticketing_agent');
Route::put('/ticketing-agent/{id}/', 'App\Http\Controllers\TicketingAgentController@update')->name('ticketing-agent.update')->middleware('checkpermission:edit_ticketing_agent');
Route::delete('/ticketing-agent/{ticketingagent}', 'App\Http\Controllers\TicketingAgentController@destroy')->name('ticketing-agent.destroy')->middleware('checkpermission:trash_ticketing_agent');
Route::get('/ticketing-agent/{ticketingagent}/edit', 'App\Http\Controllers\TicketingAgentController@edit')->name('ticketing-agent.edit')->middleware('checkpermission:edit_ticketing_agent');
Route::get('/ticketing-agent/{id}/single', 'App\Http\Controllers\TicketingAgentController@show')->name('ticketing-agent.show');
Route::get('/ticketing-agent-trash','App\Http\Controllers\TicketingAgentController@trashindex')->name('ticketing-agent.trash');
Route::delete('/remove-ticketing-agent-trash/{id}','App\Http\Controllers\TicketingAgentController@deletetrash')->name('ticketing-agent.remove')->middleware('checkpermission:delete_ticketing_agent');
Route::get('/restore-ticketing-agent-trash/{id}','App\Http\Controllers\TicketingAgentController@restoretrash')->name('ticketing-agent.restore')->middleware('checkpermission:restore_ticketing_agent');
Route::patch('/ticketing-agent-status/{id}/update', 'App\Http\Controllers\TicketingAgentController@statusupdate')->name('ticketing-agent.status.update');
//Ticketing Agent

//Airline Details
Route::get('/airline-details', 'App\Http\Controllers\AirlineDetailController@index')->name('airline-details.index');
Route::get('/airline-details/create', 'App\Http\Controllers\AirlineDetailController@create')->name('airline-details.create')->middleware('checkpermission:create_airline_details');
Route::post('/airline-details/store', 'App\Http\Controllers\AirlineDetailController@store')->name('airline-details.store')->middleware('checkpermission:create_airline_details');
Route::put('/airline-details/{id}/', 'App\Http\Controllers\AirlineDetailController@update')->name('airline-details.update')->middleware('checkpermission:edit_airline_details');
Route::delete('/airline-details/{airlinedetails}', 'App\Http\Controllers\AirlineDetailController@destroy')->name('airline-details.destroy')->middleware('checkpermission:trash_airline_details');
Route::get('/airline-details/{airlinedetails}/edit', 'App\Http\Controllers\AirlineDetailController@edit')->name('airline-details.edit')->middleware('checkpermission:edit_airline_details');
Route::get('/airline-details/{id}/single', 'App\Http\Controllers\AirlineDetailController@show')->name('airline-details.show');
Route::get('/airline-details-trash','App\Http\Controllers\AirlineDetailController@trashindex')->name('airline-details.trash');
Route::delete('/remove-airline-details-trash/{id}','App\Http\Controllers\AirlineDetailController@deletetrash')->name('airline-details.remove')->middleware('checkpermission:delete_airline_details');
Route::get('/restore-airline-details-trash/{id}','App\Http\Controllers\AirlineDetailController@restoretrash')->name('airline-details.restore')->middleware('checkpermission:restore_airline_details');
//Airline Details

//Insurance Agent
Route::get('/insurance-agent', 'App\Http\Controllers\InsuranceAgentController@index')->name('insurance-agent.index');
Route::get('/insurance-agent/create', 'App\Http\Controllers\InsuranceAgentController@create')->name('insurance-agent.create')->middleware('checkpermission:create_insurance_agent');
Route::post('/insurance-agent', 'App\Http\Controllers\InsuranceAgentController@store')->name('insurance-agent.store')->middleware('checkpermission:create_insurance_agent');
Route::put('/insurance-agent/{id}', 'App\Http\Controllers\InsuranceAgentController@update')->name('insurance-agent.update')->middleware('checkpermission:edit_insurance_agent');
Route::delete('/insurance-agent/{insuranceagent}', 'App\Http\Controllers\InsuranceAgentController@destroy')->name('insurance-agent.destroy')->middleware('checkpermission:trash_insurance_agent');
Route::get('/insurance-agent/{insuranceagent}/edit', 'App\Http\Controllers\InsuranceAgentController@edit')->name('insurance-agent.edit')->middleware('checkpermission:edit_insurance_agent');
Route::get('/insurance-agent-trash','App\Http\Controllers\InsuranceAgentController@trashindex')->name('insurance-agent.trash');
Route::delete('/remove-insurance-agent-trash/{id}','App\Http\Controllers\InsuranceAgentController@deletetrash')->name('insurance-agent.remove')->middleware('checkpermission:delete_insurance_agent');
Route::get('/restore-insurance-agent-trash/{id}','App\Http\Controllers\InsuranceAgentController@restoretrash')->name('insurance-agent.restore')->middleware('checkpermission:restore_insurance_agent');
Route::get('/insurance-agent/{id}/single', 'App\Http\Controllers\InsuranceAgentController@show')->name('insurance-agent.single');
Route::patch('/insurance-agent-status/{id}/update', 'App\Http\Controllers\InsuranceAgentController@statusupdate')->name('insurance-agent.status.update');
//End Insurance Agent

//Branch Office
Route::get('/branch-office', 'App\Http\Controllers\BranchOfficeController@index')->name('branch-office.index');
Route::get('/branch-office/create', 'App\Http\Controllers\BranchOfficeController@create')->name('branch-office.create')->middleware('checkpermission:create_branch_office');
Route::post('/branch-office', 'App\Http\Controllers\BranchOfficeController@store')->name('branch-office.store')->middleware('checkpermission:create_branch_office');
Route::put('/branch-office/{id}', 'App\Http\Controllers\BranchOfficeController@update')->name('branch-office.update')->middleware('checkpermission:edit_branch_office');
Route::delete('/branch-office/{branchoffice}', 'App\Http\Controllers\BranchOfficeController@destroy')->name('branch-office.destroy')->middleware('checkpermission:trash_branch_office');
Route::get('/branch-office/{branchoffice}/edit', 'App\Http\Controllers\BranchOfficeController@edit')->name('branch-office.edit')->middleware('checkpermission:edit_branch_office');
Route::get('/branch-office-trash','App\Http\Controllers\BranchOfficeController@trashindex')->name('branch-office.trash');
Route::delete('/remove-branch-office-trash/{id}','App\Http\Controllers\BranchOfficeController@deletetrash')->name('branch-office.remove')->middleware('checkpermission:delete_branch_office');
Route::get('/restore-branch-office-trash/{id}','App\Http\Controllers\BranchOfficeController@restoretrash')->name('branch-office.restore')->middleware('checkpermission:restore_branch_office');
Route::get('/branch-office/{id}/single', 'App\Http\Controllers\BranchOfficeController@show')->name('branch-office.single');
Route::patch('/branch-office-status/{id}/update', 'App\Http\Controllers\BranchOfficeController@statusupdate')->name('branch-office.status.update');

//End Branch Office

//Visitor
Route::get('/visitor', 'App\Http\Controllers\VisitorController@index')->name('visitor.index');
Route::get('/visitor/create', 'App\Http\Controllers\VisitorController@create')->name('visitor.create')->middleware('checkpermission:create_visitor');
Route::post('/visitor', 'App\Http\Controllers\VisitorController@store')->name('visitor.store')->middleware('checkpermission:create_visitor');
Route::put('/visitor/{id}', 'App\Http\Controllers\VisitorController@update')->name('visitor.update')->middleware('checkpermission:edit_visitor');
Route::delete('/visitor/{visitor}', 'App\Http\Controllers\VisitorController@destroy')->name('visitor.destroy')->middleware('checkpermission:trash_visitor');
Route::get('/visitor/{visitor}/edit', 'App\Http\Controllers\VisitorController@edit')->name('visitor.edit')->middleware('checkpermission:edit_visitor');
Route::get('/visitor-trash','App\Http\Controllers\VisitorController@trashindex')->name('visitor.trash');
Route::delete('/remove-visitor-trash/{id}','App\Http\Controllers\VisitorController@deletetrash')->name('visitor.remove')->middleware('checkpermission:delete_visitor');
Route::get('/restore-visitor-trash/{id}','App\Http\Controllers\VisitorController@restoretrash')->name('visitor.restore')->middleware('checkpermission:restore_visitor');
Route::get('/visitor/{id}/single', 'App\Http\Controllers\VisitorController@show')->name('visitor.single');
//End Visitor

//Counsellor
Route::get('/counsellor', 'App\Http\Controllers\CounsellorController@index')->name('counsellor.index');
Route::get('/counsellor/create', 'App\Http\Controllers\CounsellorController@create')->name('counsellor.create')->middleware('checkpermission:create_counsellor');
Route::post('/counsellor', 'App\Http\Controllers\CounsellorController@store')->name('counsellor.store')->middleware('checkpermission:create_counsellor');
Route::put('/counsellor/{id}', 'App\Http\Controllers\CounsellorController@update')->name('counsellor.update')->middleware('checkpermission:edit_counsellor');
Route::delete('/counsellor/{counsellor}', 'App\Http\Controllers\CounsellorController@destroy')->name('counsellor.destroy')->middleware('checkpermission:trash_counsellor');
Route::get('/counsellor/{counsellor}/edit', 'App\Http\Controllers\CounsellorController@edit')->name('counsellor.edit')->middleware('checkpermission:edit_counsellor');
Route::get('/counsellor-trash','App\Http\Controllers\CounsellorController@trashindex')->name('counsellor.trash');
Route::delete('/remove-counsellor-trash/{id}','App\Http\Controllers\CounsellorController@deletetrash')->name('counsellor.remove')->middleware('checkpermission:delete_counsellor');
Route::get('/restore-counsellor-trash/{id}','App\Http\Controllers\CounsellorController@restoretrash')->name('counsellor.restore')->middleware('checkpermission:restore_counsellor');
Route::get('/counsellor/{id}/single', 'App\Http\Controllers\CounsellorController@show')->name('counsellor.single');

//End Counsellor

//Visitor
Route::get('/complain-manager', 'App\Http\Controllers\ComplainManagerController@index')->name('complain-manager.index');
Route::get('/complain-manager/create', 'App\Http\Controllers\ComplainManagerController@create')->name('complain-manager.create')->middleware('checkpermission:create_complain_manager');
Route::post('/complain-manager', 'App\Http\Controllers\ComplainManagerController@store')->name('complain-manager.store')->middleware('checkpermission:create_complain_manager');
Route::put('/complain-manager/{id}', 'App\Http\Controllers\ComplainManagerController@update')->name('complain-manager.update')->middleware('checkpermission:edit_complain_manager');
Route::delete('/complain-manager/{complainmanager}', 'App\Http\Controllers\ComplainManagerController@destroy')->name('complain-manager.destroy')->middleware('checkpermission:trash_complain_manager');
Route::get('/complain-manager/{complainmanager}/edit', 'App\Http\Controllers\ComplainManagerController@edit')->name('complain-manager.edit')->middleware('checkpermission:edit_complain_manager');
Route::get('/complain-manager-trash','App\Http\Controllers\ComplainManagerController@trashindex')->name('complain-manager.trash');
Route::delete('/remove-complain-manager-trash/{id}','App\Http\Controllers\ComplainManagerController@deletetrash')->name('complain-manager.remove')->middleware('checkpermission:delete_complain_manager');
Route::get('/restore-complain-manager-trash/{id}','App\Http\Controllers\ComplainManagerController@restoretrash')->name('complain-manager.restore')->middleware('checkpermission:restore_complain_manager');
Route::get('/complain-manager/{id}/single', 'App\Http\Controllers\ComplainManagerController@show')->name('complain-manager.show');
//End Visitor


//deduction
Route::post('/deduction', 'App\Http\Controllers\DeductionController@store')->name('deduction.store')->middleware('checkpermission:create_deduction');
Route::put('/deduction/{id}', 'App\Http\Controllers\DeductionController@update')->name('deduction.update')->middleware('checkpermission:edit_deduction');
Route::delete('/deduction/{deduction}', 'App\Http\Controllers\DeductionController@destroy')->name('deduction.destroy')->middleware('checkpermission:trash_deduction');
Route::get('/deduction/{deduction}/edit', 'App\Http\Controllers\DeductionController@edit')->name('deduction.edit')->middleware('checkpermission:edit_deduction');
Route::delete('/remove-deduction-trash/{id}','App\Http\Controllers\DeductionController@deletetrash')->name('deduction.remove')->middleware('checkpermission:delete_deduction');
Route::get('/restore-deduction-trash/{id}','App\Http\Controllers\DeductionController@restoretrash')->name('deduction.restore')->middleware('checkpermission:restore_deduction');

//bonus
Route::post('/bonus', 'App\Http\Controllers\BonusController@store')->name('bonus.store')->middleware('checkpermission:create_bonus');
Route::put('/bonus/{id}', 'App\Http\Controllers\BonusController@update')->name('bonus.update')->middleware('checkpermission:edit_bonus');
Route::delete('/bonus/{deduction}', 'App\Http\Controllers\BonusController@destroy')->name('bonus.destroy')->middleware('checkpermission:trash_bonus');
Route::get('/bonus/{bonus}/edit', 'App\Http\Controllers\BonusController@edit')->name('bonus.edit')->middleware('checkpermission:edit_bonus');
Route::delete('/remove-bonus-trash/{id}','App\Http\Controllers\BonusController@deletetrash')->name('bonus.remove')->middleware('checkpermission:delete_bonus');
Route::get('/restore-bonus-trash/{id}','App\Http\Controllers\BonusController@restoretrash')->name('bonus.restore')->middleware('checkpermission:restore_bonus');


//increment
Route::post('/increment', 'App\Http\Controllers\IncrementController@store')->name('increment.store')->middleware('checkpermission:create_increment');
Route::put('/increment/{id}', 'App\Http\Controllers\IncrementController@update')->name('increment.update')->middleware('checkpermission:edit_increment');
Route::delete('/increment/{increment}', 'App\Http\Controllers\IncrementController@destroy')->name('increment.destroy')->middleware('checkpermission:trash_increment');
Route::get('/increment/{increment}/edit', 'App\Http\Controllers\IncrementController@edit')->name('increment.edit')->middleware('checkpermission:edit_increment');
Route::delete('/remove-increment-trash/{id}','App\Http\Controllers\IncrementController@deletetrash')->name('increment.remove')->middleware('checkpermission:delete_increment');
Route::get('/restore-increment-trash/{id}','App\Http\Controllers\IncrementController@restoretrash')->name('increment.restore')->middleware('checkpermission:restore_increment');



//Employee payroll
Route::get('/employee-payroll', 'App\Http\Controllers\PayrollInformationController@index')->name('employee-payroll.index');
Route::get('/employee-payroll/create', 'App\Http\Controllers\PayrollInformationController@create')->name('employee-payroll.create')->middleware('checkpermission:create_employee_payroll');
Route::post('/employee-payroll', 'App\Http\Controllers\PayrollInformationController@store')->name('employee-payroll.store')->middleware('checkpermission:create_employee_payroll');
Route::put('/employee-payroll/{id}', 'App\Http\Controllers\PayrollInformationController@update')->name('employee-payroll.update')->middleware('checkpermission:edit_employee_payroll');
Route::delete('/employee-payroll/{employeepayroll}', 'App\Http\Controllers\PayrollInformationController@destroy')->name('employee-payroll.destroy')->middleware('checkpermission:trash_employee_payroll');
Route::get('/employee-payroll/{employeepayroll}/edit', 'App\Http\Controllers\PayrollInformationController@edit')->name('employee-payroll.edit')->middleware('checkpermission:edit_employee_payroll');
Route::get('/employee-payroll-trash','App\Http\Controllers\PayrollInformationController@trashindex')->name('employee-payroll.trash');
Route::delete('/remove-employee-payroll-trash/{id}','App\Http\Controllers\PayrollInformationController@deletetrash')->name('employee-payroll.remove')->middleware('checkpermission:delete_employee_payroll');
Route::get('/restore-employee-payroll-trash/{id}','App\Http\Controllers\PayrollInformationController@restoretrash')->name('employee-payroll.restore')->middleware('checkpermission:restore_employee_payroll');
Route::get('/employee-payroll/{id}/single', 'App\Http\Controllers\PayrollInformationController@show')->name('employee-payroll.show');

//Employee make payment
Route::get('/employee-payment', 'App\Http\Controllers\SalaryPaymentController@index')->name('employee-payment.index');
Route::get('/employee-payment/create', 'App\Http\Controllers\SalaryPaymentController@create')->name('employee-payment.create')->middleware('checkpermission:create_employee_payment');
Route::post('/employee-payment', 'App\Http\Controllers\SalaryPaymentController@store')->name('employee-payment.store')->middleware('checkpermission:create_employee_payment');
Route::put('/employee-payment/{id}', 'App\Http\Controllers\SalaryPaymentController@update')->name('employee-payment.update')->middleware('checkpermission:edit_employee_payment');
Route::delete('/employee-payment/{employeepayment}', 'App\Http\Controllers\SalaryPaymentController@destroy')->name('employee-payment.destroy')->middleware('checkpermission:trash_employee_payment');
Route::get('/employee-payment/{employeepayment}/edit', 'App\Http\Controllers\SalaryPaymentController@edit')->name('employee-payment.edit')->middleware('checkpermission:edit_employee_payment');
Route::get('/employee-payment-trash','App\Http\Controllers\SalaryPaymentController@trashindex')->name('employee-payment.trash');
Route::delete('/remove-employee-payment-trash/{id}','App\Http\Controllers\SalaryPaymentController@deletetrash')->name('employee-payment.remove')->middleware('checkpermission:delete_employee_payment');
Route::get('/restore-employee-payment-trash/{id}','App\Http\Controllers\SalaryPaymentController@restoretrash')->name('employee-payment.restore')->middleware('checkpermission:restore_employee_payment');
Route::get('/employee-payment/{id}/single', 'App\Http\Controllers\SalaryPaymentController@show')->name('employee-payment.show');
Route::post('/load-make-payment/', 'App\Http\Controllers\SalaryPaymentController@loadMakePayment')->name('employee-payment.loadmakepayment');

//Payroll Items
Route::get('/employee-payroll-details-trash/{id}/','App\Http\Controllers\PayrollInformationController@alltrashindex')->name('payroll.trash');
Route::get('/employee-payroll-details/{id}/', 'App\Http\Controllers\PayrollInformationController@addalldetails')->name('employee-payroll.addalldetails');

//End employee payroll


//End Payroll Items


//Department
Route::get('/department', 'App\Http\Controllers\DepartmentController@index')->name('department.index');
Route::get('/department/create', 'App\Http\Controllers\DepartmentController@create')->name('department.create')->middleware('checkpermission:create_department');
Route::post('/department', 'App\Http\Controllers\DepartmentController@store')->name('department.store')->middleware('checkpermission:create_department');
Route::put('/department/{id}', 'App\Http\Controllers\DepartmentController@update')->name('department.update')->middleware('checkpermission:edit_department');
Route::delete('/department/{department}', 'App\Http\Controllers\DepartmentController@destroy')->name('department.destroy')->middleware('checkpermission:trash_department');
Route::get('/department/{department}/edit', 'App\Http\Controllers\DepartmentController@edit')->name('department.edit')->middleware('checkpermission:edit_department');
Route::get('/department-trash','App\Http\Controllers\DepartmentController@trashindex')->name('department.trash');
Route::delete('/remove-department-trash/{id}','App\Http\Controllers\DepartmentController@deletetrash')->name('department.remove')->middleware('checkpermission:delete_department');
Route::get('/restore-department-trash/{id}','App\Http\Controllers\DepartmentController@restoretrash')->name('department.restore')->middleware('checkpermission:restore_department');
Route::get('/department/{id}/single', 'App\Http\Controllers\DepartmentController@show')->name('department.single');
Route::patch('/department-status/{id}/update', 'App\Http\Controllers\DepartmentController@statusupdate')->name('department.status.update');

//End Department

//Designation
Route::get('/designation', 'App\Http\Controllers\DesignationController@index')->name('designation.index');
Route::get('/designation/create', 'App\Http\Controllers\DesignationController@create')->name('designation.create')->middleware('checkpermission:create_designation');
Route::post('/designation', 'App\Http\Controllers\DesignationController@store')->name('designation.store')->middleware('checkpermission:create_designation');
Route::put('/designation/{id}', 'App\Http\Controllers\DesignationController@update')->name('designation.update')->middleware('checkpermission:edit_designation');
Route::delete('/designation/{designation}', 'App\Http\Controllers\DesignationController@destroy')->name('designation.destroy')->middleware('checkpermission:trash_designation');
Route::get('/designation/{designation}/edit', 'App\Http\Controllers\DesignationController@edit')->name('designation.edit')->middleware('checkpermission:edit_designation');
Route::get('/designation-trash','App\Http\Controllers\DesignationController@trashindex')->name('designation.trash');
Route::delete('/remove-designation-trash/{id}','App\Http\Controllers\DesignationController@deletetrash')->name('designation.remove')->middleware('checkpermission:delete_designation');
Route::get('/restore-designation-trash/{id}','App\Http\Controllers\DesignationController@restoretrash')->name('designation.restore')->middleware('checkpermission:restore_designation');
Route::get('/designation/{id}/single', 'App\Http\Controllers\DesignationController@show')->name('designation.single');
Route::patch('/designation-status/{id}/update', 'App\Http\Controllers\DesignationController@statusupdate')->name('designation.status.update');

//End Designation


//Ledger Account
Route::get('/ledger', 'App\Http\Controllers\LedgerAccountController@index')->name('ledger.index')->middleware('checkpermission:filter_ledger');
Route::post('/ledger/type', 'App\Http\Controllers\LedgerAccountController@ledgerType')->name('ledger.detail');
//End Ledger Account

//Profit and Loss Account
Route::get('/profit-loss-account', 'App\Http\Controllers\ProfitLossAccountController@index')->name('profitloss.index')->middleware('checkpermission:filter_profit_and_loss');
Route::post('/profit-loss-account/type', 'App\Http\Controllers\ProfitLossAccountController@filterType')->name('profitloss.detail');
//End Profit and Loss Account

//Balance Sheet
Route::get('/balance-sheet', 'App\Http\Controllers\BalanceSheetController@index')->name('balancesheet.index')->middleware('checkpermission:filter_balance_sheet');
Route::post('/balance-sheet/type', 'App\Http\Controllers\BalanceSheetController@filterType')->name('balancesheet.detail');
//End Balance Sheet

//Trial Balance
Route::get('/trial-balance', 'App\Http\Controllers\TrialBalanceController@index')->name('trialbalance.index')->middleware('checkpermission:filter_trial_balance');
Route::post('/trial-balance/type', 'App\Http\Controllers\TrialBalanceController@filterType')->name('trialbalance.detail');
//End Trial Balance



//Settings
Route::get('/settings', 'App\Http\Controllers\CompanySettingController@index')->name('company-setting.index')->middleware('checkpermission:company_setting');
Route::post('/settings', 'App\Http\Controllers\CompanySettingController@store')->name('company-setting.store');
Route::put('/settings/{settings}', 'App\Http\Controllers\CompanySettingController@update')->name('company-setting.update');
Route::get('/theme-settings', 'App\Http\Controllers\ThemeSettingController@index')->name('theme-setting.index')->middleware('checkpermission:theme_setting');
Route::post('/theme-settings', 'App\Http\Controllers\ThemeSettingController@store')->name('theme-setting.store');
Route::put('/theme-settings/{themesettings}', 'App\Http\Controllers\ThemeSettingController@update')->name('theme-setting.update');

Route::get('/country-settings', 'App\Http\Controllers\CountrySettingController@index')->name('country-setting.index');
Route::post('/country-settings', 'App\Http\Controllers\CountrySettingController@store')->name('country-setting.store')->middleware('checkpermission:country_setting');
Route::put('/country-settings/{countrysettings}', 'App\Http\Controllers\CountrySettingController@update')->name('country-setting.update')->middleware('checkpermission:country_setting');
Route::delete('/country-settings/{CountrySettingController}', 'App\Http\Controllers\CountrySettingController@destroy')->name('country-setting.destroy')->middleware('checkpermission:country_setting');
Route::get('/country-settings/{CountrySettingController}/edit', 'App\Http\Controllers\CountrySettingController@edit')->name('country-setting.edit')->middleware('checkpermission:country_setting');
Route::get('/country-settings-trash','App\Http\Controllers\CountrySettingController@trashindex')->name('country-setting.trash');
Route::delete('/remove-country-settings-trash/{id}','App\Http\Controllers\CountrySettingController@deletetrash')->name('country-setting.remove')->middleware('checkpermission:country_setting');
Route::get('/restore-country-settings-trash/{id}','App\Http\Controllers\CountrySettingController@restoretrash')->name('country-setting.restore')->middleware('checkpermission:country_setting');


Route::get('/application-settings', 'App\Http\Controllers\CompanySettingController@appindex')->name('app-setting.index');
Route::post('/application-settings/store', 'App\Http\Controllers\CompanySettingController@appstore')->name('app-setting.store');

//End Settings

