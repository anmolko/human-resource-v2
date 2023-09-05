<link rel="stylesheet" href="{{asset('/backend/assets/five.css')}}" />

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
        <div class="cv-base" id="pdf-container">
            <div class="front">
                <header>
                <div class="head-top"></div>
                    <div class="head-bottom">
                        <div class="margin">
                            @if(count($candidate_personal->documentInfo) == 0)
                                    <div class="image-left" style="background-image: url('{{asset('/images/profiles/others.png')}}')"></div>

                                @else
                                    <div class="image-left" style="background-image: url('{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}')"></div>

                                @endif
                            <div class="words-right">
                                <h3 title="" class="cv-name">{{$name}}</h3>
                                <p> Passport No: {{@$candidate_personal->passport_no}}</p>
                            </div>
                        </div>
                       
                    </div>
                </header>
                <section>
                    <div class="margin">
                        <aside>
                            @if(@$candidate_personal->cvInfo->profile)

                            <div id="aside01" class="aside-parts">
                                <h3>about me</h3>
                                <ul id="scrolls">
                                    <li>
                                        <p>{{@$candidate_personal->cvInfo->profile}}</p>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            @if(count($candidate_personal->qualificationInfo)>0)

                            <div id="aside02" class="aside-parts">
                                <h3>education</h3>
                                <ul id="scrolls">
                                    @foreach($candidate_personal->qualificationInfo as $q)

                                    <li id="education01">
                                        <h3>{{date('M Y',strtotime(@$q->completed_on))}}, {{ucwords(str_replace('-',' ',$q->academic_level))}}</h3>
                                        <p>{{ucwords($q->school_college_name)}}</p>
                                        <p>{{ucwords($q->address)}}</p>
                                    </li>
                                    @endforeach

                                   
                                </ul>
                            </div>
                            @endif

                            @if(@$candidate_personal->cvInfo->skill)

                            <div id="aside02" class="aside-parts skill-container">
                                <h3>Skills</h3>
                                <div class=" skill-list">
                                    {!! @$candidate_personal->cvInfo->skill !!}
                                </div>
                            </div>
                            @endif

                        </aside>
                        <article>
                            <div id="article01" class="article-parts">
                                <h3>Personal Kills</h3>
                                <div id="scrolls" class="groups">
                                <div class="item">
                                    <div class="contactIcon">DOB: </div>
                                    <div class="contactInfo personal-detail"> {{@$candidate_personal->date_of_birth}}</div>
                                </div>
                                <div class="item personal-list">
                                    <div class="contactIcon">Permanent Address: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->permanent_address}}</div>
                                </div>
                                <div class="item">
                                    <div class="contactIcon">Father's Name: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->father_name}}</div>
                                </div>
                                <div class="item">
                                    <div class="contactIcon">Gender: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->gender}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Marital Status: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->martial_status}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Religion: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->religion}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Nationality: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->nationality}}</div>
                                </div>

                                @if(@$languages)
                                <div class="item">
                                    <div class="contactIcon">Language: </div>
                                    <div class="contactInfo personal-detail">{{implode(", ", $languages)}}</div>
                                </div>
                                @endif
                                  
                                    
                                </div>
                            </div>
                            @if(count($candidate_personal->professionalInfo)>0)

                            <div id="article02" class="article-parts">
                                <h3>work experience</h3>
                                <ul id="scrolls">
                                    @foreach($candidate_personal->professionalInfo as $p)

                                    <li id="experience01">
                                        <h3>{{date('Y',strtotime(@$p->from))}} - {{date('Y',strtotime(@$p->to))}}, @foreach($countries as $value=>$c)
                                                                      @if($value == $p->country)
                                                                          {{$c}}
                                                                      @endif
                                                                  @endforeach</h3>
                                        <p>{{ucwords($p->company_name)}}</p>
                                        <p>{{ucwords($p->category_of_job)}}</p>
                                    </li>
                                    @endforeach
                                    
                                   
                                </ul>
                            </div>
                            @endif

                            @if(@$candidate_personal->cvInfo->duty)

                            <div id="article02" class="article-parts">
                                <h3>Duties</h3>
                                <div class=" skill-list duty">
                                {!! @$candidate_personal->cvInfo->duty !!}
                                </div>
                            </div>
                            @endif

                        </article>


                     

                    </div>


                </section>
                @if(@$candidate_personal->cvInfo->declaration)

                    <div id="aside01" class="declaration">
                        <h3>Declaration</h3>
                           
                                <p>{!! @$candidate_personal->cvInfo->declaration !!}</p>
                    </div>
                @endif
                <div class="loop"></div>
                <footer>
</footer>
            </div>
        </div>
       </div>
    </div>