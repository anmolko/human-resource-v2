<link rel="stylesheet" href="{{asset('/backend/assets/nine.css')}}" />

    <div class="row align-items-center report-groups">
        <div class="col">
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-white" id="generate-pdf">PDF</button>
                <button class="btn btn-white" onclick="printerDiv('drag')"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </div>

    <div class="row" id="drag">
      <div class="col-md-12">
            <div class="cv-main-container" id="pdf-container">
                

            <div class="container px-3 px-lg-5">
			<article class="resume-wrapper mx-auto theme-bg-light p-5 mb-5 my-5 shadow-lg">
				
				<div class="resume-header">
					<div class="row align-items-center">
						<div class="resume-title col-12 col-md-6 col-lg-8 col-xl-9">
							<h2 class="resume-name mb-0 text-uppercase cv-name">{{$name}}</h2>
							<div class="resume-tagline mb-3 mb-md-0">Passport No: {{@$candidate_personal->passport_no}}</div>
						</div><!--//resume-title-->
						<div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-3">
							<ul class="list-unstyled mb-0">
								<li class="mb-2"><a class="resume-link" href="tel:{{ucwords(@$candidate_personal->mobile_no)}}">{{ucwords(@$candidate_personal->mobile_no)}}</a></li>
								<li class="mb-2"><a class="resume-link" href="mailto:{{@$candidate_personal->email_address}}">{{@$candidate_personal->email_address}}</a></li>
								<li class="mb-0">{{ucwords(@$candidate_personal->permanent_address)}}</li>
							</ul>
						</div><!--//resume-contact-->
					</div><!--//row-->
					
				</div><!--//resume-header-->
				<hr>
				<div class="resume-intro py-3">
					<div class="row align-items-center">
						<div class="col-12 col-md-3 col-xl-2 text-center">
                            @if(count($candidate_personal->documentInfo) == 0)
                                <img class="resume-profile-image mb-3 mb-md-0 me-md-5  ms-md-0 rounded mx-auto" src="{{asset('/images/profiles/others.png')}}" />
                            @else
                                <img class="resume-profile-image mb-3 mb-md-0 me-md-5  ms-md-0 rounded mx-auto" src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}"  />
                            @endif
						</div>
						
						<div class="col text-start">
                            @if(@$candidate_personal->cvInfo->profile)
                            <p class="mb-0">{{@$candidate_personal->cvInfo->profile}}</p>
                            @endif
						</div><!--//col-->
					</div>
				</div><!--//resume-intro-->
				<hr>
				<div class="resume-body">
					<div class="row">
						<div class="resume-main col-12 col-lg-8 col-xl-9   pe-0   pe-lg-5">
                            @if(count($candidate_personal->professionalInfo)>0)

							<section class="work-section py-3">

								<h3 class="text-uppercase resume-section-heading mb-4">Work Experiences</h3>
                                @foreach($candidate_personal->professionalInfo as $p)
                                    <div class="item mb-3">
                                        <div class="item-heading row align-items-center mb-2">
                                            <h4 class="item-title col-12 col-md-6 col-lg-8 mb-2 mb-md-0">{{ucwords($p->category_of_job)}}</h4>
                                            <div class="item-meta col-12 col-md-6 col-lg-4 text-muted text-start text-md-end">@foreach($countries as $value=>$c)
                                                                        @if($value == $p->country)
                                                                            {{$c}}
                                                                        @endif
                                                                    @endforeach | {{date('Y',strtotime(@$p->from))}} - {{date('Y',strtotime(@$p->to))}}</div>
                                            
                                        </div>
                                        <div class="item-content">
                                            <p>{{ucwords($p->company_name)}}</p>
                                            
                                        </div>
                                    </div><!--//item-->
                                @endforeach
							</section><!--//work-section-->
                            @endif

                            @if(count($candidate_personal->qualificationInfo)>0)
							
							<section class="project-section py-3">
								<h3 class="text-uppercase resume-section-heading mb-4">Education</h3>
                                @foreach($candidate_personal->qualificationInfo as $q)

								<div class="item mb-3">
									<div class="item-heading row align-items-center mb-2">
										<h4 class="item-title col-12 col-md-6 col-lg-8 mb-2 mb-md-0">{{ucwords(str_replace('-',' ',$q->academic_level))}}</h4>
										<div class="item-meta col-12 col-md-6 col-lg-4 text-muted text-start text-md-end">{{date('Y',strtotime(@$q->completed_on))}} | {{$q->address}}</div>
										
									</div>
									<div class="item-content">
										<p class="resume-degree-org text-muted">{{ucwords($q->school_college_name)}} </p>
										
									</div>
								</div><!--//item-->
                                @endforeach
								
							</section><!--//project-section-->	
                            @endif

                            @if(@$candidate_personal->cvInfo->duty)

							<section class="project-section py-3">
								<h3 class="text-uppercase resume-section-heading mb-4">Duty</h3>

                                <div class="sectionContent skill-list">
                                    {!! @$candidate_personal->cvInfo->duty !!}
                                    </div>
								
							</section><!--//project-section-->	
                            @endif

						</div><!--//resume-main-->
						<aside class="resume-aside col-12 col-lg-4 col-xl-3 px-lg-4 pb-lg-4">
							
							<section class="skills-section py-3">
									@if(@$candidate_personal->cvInfo->skill)

									<h3 class="text-uppercase resume-section-heading mb-4">Skills</h3>
								    <div class="item">
                                            <div class="sectionContent skill-list">
                                            {!! @$candidate_personal->cvInfo->skill !!}
                                            </div>
									</div><!--//item-->
                                    @endif
									
								
                                    @if(count($candidate_personal->languageInfo)>0)
									<section class="skills-section py-3">
										<h3 class="text-uppercase resume-section-heading mb-4">Languages</h3>
										<ul class="list-unstyled resume-lang-list">
                                            @foreach($candidate_personal->languageInfo as $lang)

											<li class="mb-2">{{ucwords(@$lang->language)}}</li>
                                            @endforeach
											
										</ul>
									</section><!--//certificates-section-->
                                    @endif

									
									
								</aside><!--//resume-aside-->
							</div><!--//row-->
						</div><!--//resume-body-->
						<hr>
						<div class="resume-footer text-center">
                        @if(@$candidate_personal->cvInfo->declaration)
                            <h2 class="declaration">Declaration</h2>
                            <p>{{@$candidate_personal->cvInfo->declaration}}</p>
                            @endif
						</div><!--//resume-footer-->
					</article>
					
				</div><!--//container-->

                

            </div>
       </div>
    </div>