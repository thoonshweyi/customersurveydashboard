@extends("layouts.adminindex")

@section("content")

     <!-- Start Page Content Area -->
     <div id="contentarea" class="container-fluid">
          <div class="col-md-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


{{--
                <div class="row" style="position: sticky;  top: 0;
                                        background-color: green;
                                        border: 2px solid #4CAF50;">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div> --}}

                <div class="form-tools">
                    <a target="_blank" href="{{ route("forms.show",$form['id']) }}" class="toolboxitems add-btn text-info" title="Preview"><i class="fas fa-eye"></i></a>
                    <a href="#responderlinksmodal" data-bs-toggle="modal" class="toolboxitems add-btn text-secondary" title="Responder Links"><i class="fas fa-link"></i></a>
                </div>

                <div class="container csform-container mt-0">


                        {{-- <div class="form-tab">
                            <a href="javascript:void(0);">Questions</a>
                            <a href="javascript:void(0);">Responses</a>
                        </div> --}}




                       <div class="csform-header">
                            <h2 class="mb-2">{{ $form["title"] }}</h2>
                            <p class="mb-0">{{ $form["description"] }}</p>
                        </div>

                        <div class="required-text">
                        * Indicates required question
                        </div>


                        <div class="section-container">

                            @foreach ($form["sections"] as $sectionIndex => $section)
                                <div class="section" data-section-index="{{ $sectionIndex }}" data-question-count="{{ count($section['questions'] ?? []) }}">

                                    <div class="d-flex justify-content-between mt-2">
                                            <h6 class="section-header m-0">{{ $section["title"] }}</h6>
                                    </div>

                                    <div class="section-card">
                                        <div class="row">
                                            <p class="text-muted">{{ $section["description"] }}</p>
                                        </div>
                                    </div>

                                    <div class="question-container">
                                        @foreach ($section['questions'] ?? [] as $questionIndex => $question)
                                                <div class="csform-card mb-4">
                                                    <label class="form-label">{{ $question["name"] }} <span class="text-danger">*</span></label>


                                                    @php
                                                          $questionanswers = collect();
                                                    @endphp
                                                    @if($question["type"] == 'text' || $question["type"] == 'textarea')
                                                        @foreach($questionanswers as $questionanswer )
                                                            <p>{{ $questionanswer["text"] }}</p>
                                                        @endforeach
                                                    @endif


                                                    @if($question['type'] == 'checkbox' || $question['type'] == 'radio' )
                                                        @foreach ($question['options'] as $optionIndex =>$option)
                                                            <div key={{ $option['id'] }} class="form-check">
                                                                <input
                                                                    class="form-check-input"
                                                                    type={{ $question['type'] }}
                                                                    id={{ $question['id'] . "-" . $option['id'] }}
                                                                    name={{ $question['id'] }}
                                                                    value={{ $option['id'] }}
                                                                    {{ in_array($option['id'], $questionanswers->pluck("option_id")->toArray()) ? "checked" : '' }}
                                                                    readonly
                                                                    onclick="return false;"
                                                                />
                                                                <label for={{ $question['id'] . "-" . $option['id'] }} class="form-check-label">
                                                                    {{ $option['name'] }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                    @if($question['type'] == 'rating' )
                                                        <div class="d-flex justify-content-around align-items-center mb-2">
                                                            @foreach($questionanswers as $questionanswer )
                                                                @foreach ($question['options'] as $optionIndex =>$option)
                                                                    @php
                                                                        $selected = $questionanswer['option']['value'];
                                                                        $starValue = $option['value'];
                                                                    @endphp
                                                                    <div class="text-center">
                                                                        <div class="form-group">
                                                                            <label>{{ $option['name'] }}</label>
                                                                        </div>
                                                                        <i class="{{ $selected >= $starValue ? "fas" : "far"  }} fa-star text-warning"></i>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif


                                                @if($question['type'] == 'selectbox')
                                                    @foreach($questionanswers as $questionanswer )
                                                        <select
                                                            class="form-select"
                                                            name={{ $question['id'] }}
                                                            value={{ $questionanswer['option_id'] ?? "" }}
                                                            disabled
                                                        >
                                                            @foreach ($question['options'] as $optionIndex =>$option)
                                                                <option key={{ $option['id'] }} value={{ $option['id'] }} {{ $questionanswer['option_id'] == $option['id'] ? "selected" : "" }}>
                                                                    {{ $option['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endforeach
                                                @endif


                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick=" window.history.back();">Back</a>
                        </div>

                </div>
          </div>
     </div>
     <!-- End Page Content Area -->


    <!-- START MODAL AREA -->
        <!-- start edit responderlinksmodal -->
            <div id="responderlinksmodal" class="modal fade">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Responder Link Modal</h6>
                                <button type="" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <form id="formaction" action="" method="POST">
                                    <div class="row align-items-end">
                                        <div class="d-flex justify-content-between aligh-items-center">
                                            <div>
                                                <label for="">Collect Branch</label>
                                                <p><small>Branch info will be saved with each submission.</small></p>
                                            </div>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input responderslinks-btn" {{  $form["collect_branch"] === 3 ? 'checked' : ''}} data-id="{{ $form['id'] }}" onclick="return false;"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <table id="mytable" class="table table-sm table-hover border">

                                        <thead>
                                            <th>No</th>
                                            <th>Branch</th>
                                            <th>Link</th>
                                            <th>QR</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                            @foreach($responderlinks as $idx=>$responderlink)
                                            <tr>

                                                <td>{{++$idx}}</td>
                                                <td>{{ $responderlink->branch?->branch_name }}</td>
                                                <td><a target="_blank" href="{{ $responderlink->url }}">{{ $responderlink->url }}</a></td>
                                                <td><img src="{{ asset($responderlink->image) }}" alt=""></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="clipboard-btn" title="Copy Link" data-url="{{ $responderlink->url }}"><i class="far fa-clipboard"></i></a>
                                                    <a href="{{ asset($responderlink->image) }}" download="{{ $responderlink->branch?->branch_name }}"><i class="fas fa-download"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                </table>

                            </div>

                            <div class="modal-footer">

                            </div>
                        </div>
                </div>
            </div>
        <!-- end edit responderlinksmodal -->
     <!-- END MODAL AREA -->
@endsection

@section("css")
     {{-- summernote css1 js1 --}}
     <link href="{{ asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.css') }}" rel="stylesheet" type="text/css"/>

     <style type="text/css">
          .gallery{
               width: 100%;
               /* height: 100%; */
               background-color: #eee;
               color: #aaa;

               display:flex;
               justify-content:center;
               align-items:center;

               text-align: center;
               padding: 10px;
          }
          .gallery img{
               width: 100px;
               height: 100px;
               border: 2px dashed #aaa;
               border-radius: 10px;
               object-fit: cover;

               padding: 5px;
               margin: 0 5px;
          }
          .removetxt span{
               display: none;
          }
     </style>


@endsection

@section("scripts")
     {{-- summernote css1 js1 --}}
     <script src="{{ asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.js') }}" type="text/javascript"></script>
     <script type="text/javascript">
          $(document).ready(function(){
                const id = {{ $form['id'] }}
                $.ajax({
                    url: `/api/formsreport/${id}`,
                    method: 'GET',
                    success:function(data){
                        console.log(data)


                            data.questions.forEach(question => {
                                const labels = question.options.map(opt => question.type == 'rating' ? opt.name+"stars" : opt.name);
                                const values = question.options.map(opt => opt.count);



                                {{-- chartele.height = 250; --}}
                                {{-- new Chart(document.getElementById(`chart-${question.id}`), {
                                    type: question.type === 'rating' ? 'bar' : 'doughnut',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: question.name,
                                            data: values,
                                            backgroundColor: ['#66b3ff', '#99ff99', '#ffcc99', '#ff9999', '#c2c2f0']
                                        }]
                                    },
                                    options: { responsive: true }
                                }); --}}



                                if(!(question.type == 'text' || question.type == 'textarea')){

                                    var ctx = document.getElementById(`chart-${question.id}`);
                                    ctx.style.display = 'block'
                                    ctx.width = 250;
                                    ctx.height = 250;
                                    {{-- console.log(ctx); --}}
                                    if(question.type == 'rating'){
                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    {{-- label: question.name, --}}
                                                    data:  values,
                                                    backgroundColor: ['#66b3ff', '#99ff99', '#ffcc99', '#ff9999', '#c2c2f0'],
                                                    borderWidth:1
                                                }]
                                            },
                                            options: {
                                                responsive:true,
                                                scales: {
                                                    y:{
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    }
                                    else if(question.type == 'checkbox'){
                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    {{-- label: question.name, --}}
                                                    data:  values,
                                                    backgroundColor: ['#66b3ff', '#99ff99', '#ffcc99', '#ff9999', '#c2c2f0'],
                                                    borderWidth:1
                                                }]
                                            },
                                            options: {
                                                responsive:true,
                                                scales: {
                                                    y:{
                                                        beginAtZero: true
                                                    }
                                                },
                                                indexAxis: 'y'
                                            }
                                        });
                                    }
                                    else{

                                        new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    data:  values,
                                                    backgroundColor: ['#66b3ff', '#99ff99', '#ffcc99', '#ff9999', '#c2c2f0'],
                                                    borderWidth:1
                                                }]
                                            },
                                            options: {
                                                responsive:false
                                            }
                                        });
                                    }
                                }
                            });


                        {{-- $('#activebranchcount').text(data.activebranches); --}}

                    },
                    error: function(){
                        {{-- $('#activebranchcount').text("Error loading data"); --}}
                    }
                });
          });



     </script>
@endsection
