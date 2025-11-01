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


                <div class="form-tools stick" style="">
                    <div class="col-12">
                        <div class="row align-items-end">
                            <form id="reportform" action="" method="">
                                <div class="form-row col-md-4 mx-auto">
                                    <!-- <label>{{__('user.branch')}} </label> -->
                                    <select id="branch_ids" name="branch_ids[]" class="form-control " multiple>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}" {{ $branch->branch_id == old('document_branch') ? 'selected' : '' }} >
                                                {{ $branch->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="container csform-container mt-0">
                        
                       <div class="csform-header">
                            <h2 class="mb-2">{{ $form["title"] }}</h2>
                            {{-- <p class="mb-0">{{ $form->description }}</p> --}}
                        </div>

                        {{-- <div class="required-text">
                        * Indicates required question
                        </div> --}}


                        <div class="section-container">

                            @foreach ($form["sections"] as $sectionIndex => $section)
                                <div class="section" data-section-index="{{ $sectionIndex }}" data-question-count="{{ count($section['questions'] ?? []) }}">

                                    <div class="d-flex justify-content-between mt-2">
                                            <h6 class="section-header m-0">{{ $section["title"] }}</h6>
                                    </div>

                                    {{-- <div class="section-card">
                                        <div class="row">
                                            <p class="text-muted">{{ $section->description }}</p>
                                        </div>
                                    </div> --}}

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

                                                    @if(!in_array($question["type"], ['text','textarea']))
                                                        @if(in_array($question["type"],['rating']))
                                                        <div id="avgrating-{{$question["id"]}}" class="avgrating">
                                                            <div id="ratingchart-{{$question["id"]}}"  >
                                                                {{-- <h6 class="text-center fw-bold">Average rating ({{ number_format($question["average"],2) }})</h6>

                                                                <div  class="d-flex justify-content-around align-items-center mb-2">
                                                                    @foreach ($question['options'] as $optionIndex =>$option)
                                                                        @php
                                                                            // $selected = $questionanswer->option->value;
                                                                            // $starValue = $option->value;

                                                                            $selected = round($question["average"]);
                                                                            $starValue = $option["value"];
                                                                        @endphp
                                                                        <div class="text-center">
                                                                            <div class="form-group">
                                                                                    <label>{{ $option["name"] }}</label>
                                                                            </div>
                                                                            <i
                                                                            class="{{ $selected >= $starValue ? "fas" : "far"  }} fa-star text-warning"
                                                                            ></i>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                --}}
                                                            </div>

                                                        </div>
                                                        @endif
                                                        <div class="d-flex justify-self-center" style="width: 40%; justify-self: center"> <canvas id="chart-{{$question["id"]}}" style="display:none;" width="250"></canvas></div>

                                                    @endif

                                                    {{-- @if($question->type == 'checkbox' || $question->type == 'radio' )
                                                         @foreach ($question['options'] as $optionIndex =>$option)
                                                            <div key={{ $option->id }} class="form-check">
                                                                <input
                                                                    class="form-check-input"
                                                                    type={{$question->type}}
                                                                    id={{$question->id . "-" . $option->id}}
                                                                    name={{$question->id}}
                                                                    value={{$option->id}}
                                                                    {{ in_array($option->id, $questionanswers->pluck("option_id")->toArray()) ? "checked" : '' }}
                                                                    readonly
                                                                     onclick="return false;"
                                                                />
                                                                <label for={{$question->id . "-" . $option->id}} class="form-check-label">
                                                                {{$option->name}}
                                                                </label>
                                                            </div>
                                                         @endforeach
                                                    @endif --}}

                                                    {{-- @if($question->type == 'rating' )
                                                        <div class="d-flex justify-content-around align-items-center mb-2">
                                                            @foreach($questionanswers as $questionanswer )
                                                                @foreach ($question['options'] as $optionIndex =>$option)
                                                                        @php
                                                                            $selected = $questionanswer->option->value;
                                                                            $starValue = $option->value;
                                                                        @endphp
                                                                        <div  class="text-center">
                                                                            <div class="form-group">
                                                                                    <label>{{ $option->name }}</label>
                                                                            </div>
                                                                            <i
                                                                            class="{{ $selected >= $starValue ? "fas" : "far"  }} fa-star text-warning"
                                                                            ></i>
                                                                        </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    --}}

                                                    {{-- @if($question->type == 'selectbox')
                                                        @foreach($questionanswers as $questionanswer )
                                                            <select
                                                                class="form-select"
                                                                name={{$question->id}}
                                                                value={{ $questionanswer->option_id || ""}}
                                                                disabled
                                                            >
                                                                @foreach ($question['options'] as $optionIndex =>$option)
                                                                    <option key={opt.id} value={{$option->id}} {{ $questionanswer->option_id == $option->id ? "selected" : "" }}>
                                                                        {{$option->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endforeach
                                                    @endif --}}

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
                $('#branch_ids').select2({
                    width: '100%',
                    allowClear: true,
                    placeholder: "All Branches"
                });

                $('#branch_ids').change(function(){
                    console.log($(this).val())
                    let branch_ids = $(this).val();
                    getformreport(branch_ids);
                })

                var chartInstances = {};
                function getformreport(branch_ids){
                    const id = {{  request()->route('id') }}
                    $.ajax({
                        url: `/api/formsreport/${id}`,
                        method: 'GET',
                        data: $("#reportform").serialize(),
                        dataType:"json",
                        success:function(data){
                            console.log(data)


                                data.questions.forEach((question,idx) => {
                                    const labels = question.options.map(opt => question.type == 'rating' ? opt.name+"stars" : opt.name);
                                    const values = question.options.map(opt => opt.count);

                                    if(!(question.type == 'text' || question.type == 'textarea')){

                                        var ctx = document.getElementById(`chart-${question.id}`);
                                        ctx.style.display = 'block'
                                        ctx.width = 250;
                                        ctx.height = 250;
                                        {{-- console.log(ctx); --}}
                                        if (chartInstances[question.id]) {
                                            chartInstances[question.id].destroy();
                                        }

                                        if(question.type == 'rating'){
                                            chartInstances[question.id] = new Chart(ctx, {
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

                                            const selectedOptionId = question.average;
                                            const ratinghtml = `
                                                <h6 class="text-center fw-bold">Average rating (${selectedOptionId})</h6>
                                                <div class="d-flex justify-content-around align-items-center mb-2">
                                                    ${question.options
                                                    .map((opt, index) => {
                                                        let selectedOptionId = Math.round(question.average);
                                                        const starValue = opt["value"];

                                                        return `
                                                        <div key="${opt.id}" class="text-center">
                                                            <div class="form-group">
                                                            <label>${opt.name}</label>
                                                            </div>
                                                            <i class="${selectedOptionId >= starValue ? 'fas' : 'far'} fa-star text-warning"></i>
                                                        </div>
                                                        `;
                                                    })
                                                    .join('')}
                                                </div>
                                            `;
                                            $(`#ratingchart-${question.id}`).html(ratinghtml);
                                                                

                                        }
                                        else if(question.type == 'checkbox'){
                                            chartInstances[question.id] = new Chart(ctx, {
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

                                            chartInstances[question.id] = new Chart(ctx, {
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
                                                    responsive:true
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
                }
                getformreport();

          });



     </script>
@endsection
