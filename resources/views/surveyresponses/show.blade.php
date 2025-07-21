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

                <div class="container csform-container mt-0">
                       <div class="csform-header">
                            <h2 class="mb-2">{{ $form->title }}</h2>
                            <p class="mb-0">{{ $form->description }}</p>
                        </div>

                        <div class="required-text">
                        * Indicates required question
                        </div>


                        <div class="section-container">

                            @foreach ($form['sections'] as $sectionIndex => $section)
                                <div class="section" data-section-index="{{ $sectionIndex }}" data-question-count="{{ count($section['questions'] ?? []) }}">

                                    <div class="d-flex justify-content-between mt-2">
                                            <h6 class="section-header m-0">{{ $section->title }}</h6>
                                    </div>

                                    <div class="section-card">
                                        <div class="row">
                                            <p class="text-muted">{{ $section->description }}</p>
                                        </div>
                                    </div>

                                    <div class="question-container">
                                        @foreach ($section['questions'] ?? [] as $questionIndex => $question)
                                                <div class="csform-card mb-4">
                                                    <label class="form-label">{{ $question->name }} <span class="text-danger">*</span></label>


                                                    @php
                                                        $questionanswers = $surveyresponse->questionanswers($question->id);
                                                    @endphp
                                                    @if($question->type == 'text' || $question->type == 'textarea')
                                                        @foreach($surveyresponse->questionanswers($question->id) as $questionanswer )
                                                            <p>{{ $questionanswer->text }}</p>
                                                        @endforeach
                                                    @endif

                                                    @if($question->type == 'checkbox' || $question->type == 'radio' )
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
                                                    @endif

                                                    @if($question->type == 'rating' )
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
                                                                            {{-- style={{ fontSize: "1.5rem", cursor: "pointer" }} --}}
                                                                            ></i>
                                                                        </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif


                                                    @if($question->type == 'selectbox')
                                                        @foreach($questionanswers as $questionanswer )
                                                            {{-- {{ dd($questionanswer->option_id) }} --}}
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


          });
     </script>
@endsection
