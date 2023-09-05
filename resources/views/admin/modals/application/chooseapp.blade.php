<div id="choose_application" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Application Format</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateapplicationchoice','novalidate'=>'']) !!}

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4 content">
                            <section>
                                <div class="group-one group">
                                    <input name="radio" class="input-radios" type="radio" id="one" value="app">
                                    <label for="one" class="one notation" style="background: url({{asset('images/app1.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 1</span></label>
                                </div>
                                <div class="group-two group">
                                    <input name="radio" class="input-radios" type="radio" id="two" value="app2">
                                    <label for="two" class="two notation" style=" background: url({{asset('images/app2.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 2</span></label>
                                </div>
                            </section>
                        </div><!--content-->
                        <div class="col-md-12 mt-4 col-md-offset-4 content">
                            <section>
                                <div class="group-one group">
                                    <input name="radio" class="input-radios" type="radio" id="index3" value="app3">
                                    <label for="index3" class="one notation" style="background: url({{asset('images/app3.png')}}) no-repeat 0px 0px;"><span class="spanned">Dynamic Application sample 3</span></label>
                                </div>
                                <div class="group-two group">
                                    <input name="radio" class="input-radios" type="radio" value="app4" id="four">
                                    <label for="four" class="two notation" style=" background: url({{asset('images/app4.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 4</span></label>
                                </div>
                            </section>
                        </div><!--content-->
                    </div><!--row-->
                </div><!--container-->

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Choose</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
