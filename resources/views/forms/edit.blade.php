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
                    <form id="updateform" action="{{ route("forms.update",$form['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="csform-header">
                            {{-- <h2 class="mb-2">Customer Satisfaction Survey</h2> --}}
                            <input
                            type="text"
                            class="form-control underline-only maintitle-input mb-2"
                            name="title"
                            value="{{ old('title', $form['title']) }}"
                            />
                            <input
                            type="text"
                            class="form-control underline-only"
                            name="description"
                            value="{{ old('description', $form['description']) }}"
                            placeholder="Form description"
                            />
                        </div>

                        <div class="required-text">
                        * Indicates required question
                        </div>


                        <div class="section-container">
                            <a href="javascript:void(0) " id="addsection-btn" class="toolboxitems addsection-btn d-none" title="Add Section">
                                <i class="section-divider">
                                    <div class="divider-lines"></div>
                                    <div class="divider-lines"></div>
                                </i>
                            </a>



                            @php
                                $oldSections = old('sections', []);
                                // dd($oldSections);
                            @endphp

                            {{-- @foreach ($oldSections as $sectionIndex => $section)
                                <div class="section" data-section-index="{{ $sectionIndex }}" data-question-count="{{ count($section['questions'] ?? []) }}">
                                    <div class="d-flex justify-content-between mt-2">
                                        <h6 class="section-header m-0">Section {{ $sectionIndex + 1 }}</h6>
                                    </div>

                                    <div class="section-card">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input
                                                    type="text"
                                                    id="section"
                                                    name="sections[{{ $sectionIndex }}][title]"
                                                    class="form-control underline-only title-input question"
                                                    value="{{ $section['title'] ?? '' }}"
                                                    placeholder="Section"
                                                />
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <input
                                                    type="text"
                                                    name="sections[{{ $sectionIndex }}][description]"
                                                    class="form-control underline-only option-input options"
                                                    value="{{ $section['description'] ?? '' }}"
                                                    placeholder="Section description"
                                                />
                                            </div>


                                        </div>
                                         <div class="toolboxs">
                                                <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                                <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                                    <i class="section-divider">
                                                        <div class="divider-lines"></div>
                                                        <div class="divider-lines"></div>
                                                    </i>
                                                </a>
                                        </div>
                                    </div>

                                    <div class="question-container">
                                        @foreach ($section['questions'] ?? [] as $questionIndex => $question)
                                            <div class="csform-card mb-4" data-question-index="{{ $questionIndex }}" data-option-count="{{ count($question['options'] ?? []) }}">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            id="question"
                                                            name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][name]"
                                                            class="form-control underline-only title-input question"
                                                            value="{{ $question['name'] ?? '' }}"
                                                            placeholder="Question"
                                                        />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][type]" class="form-select question_type">
                                                            <option value="text" {{ ($question['type'] ?? '') == 'text' ? 'selected' : '' }}>Short Answer</option>
                                                            <option value="textarea" {{ ($question['type'] ?? '') == 'textarea' ? 'selected' : '' }}>Paragraph</option>
                                                            <option value="radio" {{ ($question['type'] ?? '') == 'radio' ? 'selected' : '' }}>Multiple Choice</option>
                                                            <option value="checkbox" {{ ($question['type'] ?? '') == 'checkbox' ? 'selected' : '' }}>Checkboxes</option>
                                                            <option value="selectbox" {{ ($question['type'] ?? '') == 'selectbox' ? 'selected' : '' }}>Dropdown</option>
                                                            <option value="rating" {{ ($question['type'] ?? '') == 'rating' ? 'selected' : '' }}>Rating</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12 mt-2 option-container">
                                                        @php
                                                                $iconClass = 'far fa-circle'; // default icon
                                                                $addOptionClass = '';
                                                                $optiontext = '';

                                                                switch ($question['type']) {
                                                                    case 'checkbox':
                                                                        $iconClass = 'far fa-square';
                                                                        $addOptionClass = 'checkboxs';
                                                                        break;
                                                                    case 'selectbox':
                                                                        $iconClass = 'fas fa-chevron-down';
                                                                        $addOptionClass = 'selectboxs';
                                                                        break;
                                                                    case 'text':
                                                                        $optiontext = "<small class='answer-text'>Short answer text</small>";
                                                                        break;
                                                                    case 'textarea':
                                                                        $optiontext = "<small class='answer-text'>Long answer text</small>";
                                                                        break;
                                                                    case 'radio':
                                                                        // Keep default
                                                                        break;
                                                                }
                                                            @endphp

                                                            @if (!empty($question['options']))
                                                                @if($question['type'] != 'rating')
                                                                    @foreach ($question['options'] as $optionIndex =>$option)
                                                                        <div class="d-flex align-items-center mb-2">
                                                                            <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                            <input
                                                                                type="text"
                                                                                id="options"
                                                                                name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][name]"
                                                                                class="form-control underline-only option-input options"
                                                                                value="{{ $option['name'] ?? '' }}"
                                                                                placeholder="Option"
                                                                            />
                                                                            <input type="hidden" name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][value]" value="{{ $option['value'] ?? '' }}"/>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                        <a class="add-option {{ $addOptionClass }}" href="javascript:void(0)">Add Option</a>
                                                                        <span>or</span>
                                                                        <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                                                    </div>
                                                                @elseif ($question['type'] == 'rating')
                                                                    <div class="d-flex justify-content-around align-items-center mb-2">
                                                                            @foreach ($question['options'] as $optionIndex =>$option)
                                                                            <div class="text-center">
                                                                                <div class="form-group">
                                                                                        <label>{{$optionIndex + 1}}</label>
                                                                                        <input
                                                                                            type="hidden"
                                                                                            id="options"
                                                                                            name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][name]"
                                                                                            class="form-control underline-only option-input options"
                                                                                            placeholder="Option"
                                                                                            value = "{{$optionIndex + 1}}"
                                                                                        />
                                                                                        <input type="hidden" name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][value]" value="{{$optionIndex + 1}}" />
                                                                                </div>
                                                                                <i class="far fa-star text-secondary fa-sm"></i>
                                                                            </div>
                                                                            @endforeach
                                                                    </div>
                                                                @endif

                                                            @else
                                                                {!! $optiontext !!}
                                                            @endif

                                                    </div>
                                                </div>

                                                <div class="toolboxs">
                                                    <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems remove-btns"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-copy"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                                        <i class="section-divider">
                                                            <div class="divider-lines"></div>
                                                            <div class="divider-lines"></div>
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach --}}


                            @foreach ($form['sections'] as $sectionIndex => $section)
                                <div class="section" data-section-index="{{ $sectionIndex }}" data-question-count="{{ count($section['questions'] ?? []) }}">
                                    <div class="d-flex justify-content-between mt-2">
                                        <h6 class="section-header m-0">Section {{ $sectionIndex + 1 }}</h6>
                                    </div>

                                    <div class="section-card">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input
                                                    type="text"
                                                    id="section"
                                                    name="sections[{{ $sectionIndex }}][title]"
                                                    class="form-control underline-only title-input question"
                                                    value="{{ $section['title'] ?? '' }}"
                                                    placeholder="Section"
                                                />
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <input
                                                    type="text"
                                                    name="sections[{{ $sectionIndex }}][description]"
                                                    class="form-control underline-only option-input options"
                                                    value="{{ $section['description'] ?? '' }}"
                                                    placeholder="Section description"
                                                />
                                            </div>


                                        </div>
                                         <div class="toolboxs">
                                                <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                                <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                                    <i class="section-divider">
                                                        <div class="divider-lines"></div>
                                                        <div class="divider-lines"></div>
                                                    </i>
                                                </a>
                                        </div>
                                    </div>

                                    <div class="question-container">
                                        @foreach ($section['questions'] ?? [] as $questionIndex => $question)
                                            <div class="csform-card mb-4" data-question-index="{{ $questionIndex }}" data-option-count="{{ count($question['options'] ?? []) }}">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input
                                                            type="text"
                                                            id="question"
                                                            name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][name]"
                                                            class="form-control underline-only title-input question"
                                                            value="{{ $question['name'] ?? '' }}"
                                                            placeholder="Question"
                                                        />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][type]" class="form-select question_type">
                                                            <option value="text" {{ ($question['type'] ?? '') == 'text' ? 'selected' : '' }}>Short Answer</option>
                                                            <option value="textarea" {{ ($question['type'] ?? '') == 'textarea' ? 'selected' : '' }}>Paragraph</option>
                                                            <option value="radio" {{ ($question['type'] ?? '') == 'radio' ? 'selected' : '' }}>Multiple Choice</option>
                                                            <option value="checkbox" {{ ($question['type'] ?? '') == 'checkbox' ? 'selected' : '' }}>Checkboxes</option>
                                                            <option value="selectbox" {{ ($question['type'] ?? '') == 'selectbox' ? 'selected' : '' }}>Dropdown</option>
                                                            <option value="rating" {{ ($question['type'] ?? '') == 'rating' ? 'selected' : '' }}>Rating</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12 mt-2 option-container">
                                                        @php
                                                                $iconClass = 'far fa-circle'; // default icon
                                                                $addOptionClass = '';
                                                                $optiontext = '';

                                                                switch ($question['type']) {
                                                                    case 'checkbox':
                                                                        $iconClass = 'far fa-square';
                                                                        $addOptionClass = 'checkboxs';
                                                                        break;
                                                                    case 'selectbox':
                                                                        $iconClass = 'fas fa-chevron-down';
                                                                        $addOptionClass = 'selectboxs';
                                                                        break;
                                                                    case 'text':
                                                                        $optiontext = "<small class='answer-text'>Short answer text</small>";
                                                                        break;
                                                                    case 'textarea':
                                                                        $optiontext = "<small class='answer-text'>Long answer text</small>";
                                                                        break;
                                                                    case 'radio':
                                                                        // Keep default
                                                                        break;
                                                                }
                                                            @endphp

                                                            @if (!empty($question['options']))
                                                                @if($question['type'] != 'rating')
                                                                    @foreach ($question['options'] as $optionIndex =>$option)
                                                                        <div class="d-flex align-items-center mb-2">
                                                                            <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                            <input
                                                                                type="text"
                                                                                id="options"
                                                                                name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][name]"
                                                                                class="form-control underline-only option-input options"
                                                                                value="{{ $option['name'] ?? '' }}"
                                                                                placeholder="Option"
                                                                            />
                                                                            <input type="hidden" name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][value]" value="{{ $option['value'] ?? '' }}"/>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                        <a class="add-option {{ $addOptionClass }}" href="javascript:void(0)">Add Option</a>
                                                                        <span>or</span>
                                                                        <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                                                    </div>
                                                                @elseif ($question['type'] == 'rating')
                                                                    <div class="d-flex justify-content-around align-items-center mb-2">
                                                                            @foreach ($question['options'] as $optionIndex =>$option)
                                                                            <div class="text-center">
                                                                                <div class="form-group">
                                                                                        <label>{{$optionIndex + 1}}</label>
                                                                                        <input
                                                                                            type="hidden"
                                                                                            id="options"
                                                                                            name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][name]"
                                                                                            class="form-control underline-only option-input options"
                                                                                            placeholder="Option"
                                                                                            value = "{{$optionIndex + 1}}"
                                                                                        />
                                                                                        <input type="hidden" name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{$optionIndex}}][value]" value="{{$optionIndex + 1}}" />
                                                                                </div>
                                                                                <i class="far fa-star text-secondary fa-sm"></i>
                                                                            </div>
                                                                            @endforeach
                                                                    </div>
                                                                @endif

                                                            @else
                                                                {!! $optiontext !!}
                                                            @endif

                                                    </div>
                                                </div>

                                                <div class="toolboxs">
                                                    <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems remove-btns"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-copy"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                                        <i class="section-divider">
                                                            <div class="divider-lines"></div>
                                                            <div class="divider-lines"></div>
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div>
                            <a href="{{ route('forms.index') }}" class="btn btn-sm btn-secondary">Back</a>
                            <button type="button" id="update-btn" class="btn btn-sm btn-primary ">Updadte</button>
                        </div>

                    </form>
                </div>
          </div>
     </div>
     <!-- End Page Content Area -->


         <!-- START MODAL AREA -->
          <!-- start edit modal -->
               <div id="importmodal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h6 class="modal-title">Import Modal</h6>
                                   <button type="" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <div class="modal-body">
                                   <form id="formaction" action="" method="POST">
                                        <div class="row align-items-end">
                                                <input type="hidden" id="questionIndex" value="">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="tablename">Tables</label>
                                                    <select name="tablename" id="tablename" class="form-control form-control-sm rounded tablename">
                                                        @foreach($optionimporttables as $optionimporttable)
                                                                <option value="{{$optionimporttable}}">{{$optionimporttable}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                              {{-- <div class="col-md-6 form-group mb-3">
                                                  <label for="editpermission_id">Permission</label>
                                                  <select name="editpermission_id" id="editpermission_id" class="form-control form-control-sm rounded-0 permission_id">
                                                       @foreach($permissions as $permission)
                                                            <option value="{{$permission['id']}}">{{$permission['name']}}</option>
                                                       @endforeach
                                                  </select>
                                             </div> --}}

                                             <div class="col-md-12 text-sm-end text-start mb-3">
                                                  <button type="button" id="importoption_btn" class="btn btn-primary btn-sm rounded-0">Import</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>

                              <div class="modal-footer">

                              </div>
                         </div>
                    </div>
               </div>
          <!-- end edit modal -->
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

               var previewimages = function(input,output){

                    // console.log(input.files);

                    if(input.files){
                         var totalfiles = input.files.length;
                         // console.log(totalfiles);
                         if(totalfiles > 0){
                              $('.gallery').addClass('removetxt');
                         }else{
                              $('.gallery').removeClass('removetxt');
                         }
                         for(var i = 0 ; i < totalfiles ; i++){
                              var filereader = new FileReader();


                              filereader.onload = function(e){
                                   $(output).html("");
                                   $($.parseHTML('<img>')).attr('src',e.target.result).appendTo(output);
                              }

                              filereader.readAsDataURL(input.files[i]);

                         }
                    }

               };

               $('#image').change(function(){
                    previewimages(this,'.gallery');
               });

               // text editor for content
               $('#content').summernote({
                    placeholder: 'Say Something....',
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                         ['style', ['style']],
                         ['font', ['bold', 'underline', 'clear']],
                         ['color', ['color']],
                         ['para', ['ul', 'ol', 'paragraph']],
                         ['insert', ['link']],
                    ]
               });










               {{-- Start Add Section Btn --}}
               @php
                    $sectioncount = count(old('sections', []));
               @endphp
               let sectionIndex = {{ $sectioncount }};
                $(document).on("click", ".addsection-btn", function () {
                    const getsectioncontainer = $(this).closest(".section-container");

                    const html = `
                        <div class="section" data-section-index="${sectionIndex}" data-question-count="1">
                            <div class="d-flex justify-content-between mt-2">
                                <h6 class="section-header m-0">Section ${sectionIndex + 1}</h6>
                            </div>
                            <div class="section-card">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input
                                            type="text"
                                            id="section"
                                            name="sections[${sectionIndex}][title]"
                                            class="form-control underline-only title-input question"
                                            placeholder="Section"
                                        />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <input
                                            type="text"
                                            name="sections[${sectionIndex}][description]"
                                            class="form-control underline-only option-input options"
                                            placeholder="Section description"
                                        />
                                    </div>
                                </div>
                                <div class="toolboxs">
                                    <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                    <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                        <i class="section-divider">
                                            <div class="divider-lines"></div>
                                            <div class="divider-lines"></div>
                                        </i>
                                    </a>
                                </div>
                            </div>

                            <div class="question-container">
                                <div class="csform-card mb-4" data-question-index="0" data-option-count="1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                id="question"
                                                name="sections[${sectionIndex}][questions][0][name]"
                                                class="form-control underline-only title-input question"
                                                placeholder="Question"
                                            />
                                        </div>
                                        <div class="col-md-4">
                                            <select name="sections[${sectionIndex}][questions][0][type]" id="question_type" class="form-select question_type">
                                                <option value="text">Short Answer</option>
                                                <option value="textarea">Paragraph</option>
                                                <option value="radio" selected>Multiple Choice</option>
                                                <option value="checkbox">Checkboxes</option>
                                                <option value="selectbox">Dropdown</option>
                                                <option value="rating">Rating</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2 option-container">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="far fa-circle text-secondary fa-sm"></i>
                                                <input
                                                    type="text"
                                                    id="options"
                                                    name="sections[${sectionIndex}][questions][0][options][0][name]"
                                                    class="form-control underline-only option-input options"
                                                    placeholder="Option"
                                                />
                                                <input type="hidden" name="sections[${sectionIndex}][questions][0][options][0][value]" value="" />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-circle text-secondary fa-sm"></i>
                                                <a class="add-option" href="javascript:void(0)">Add Option</a>
                                                <span>or</span>
                                                <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="toolboxs">
                                        <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                        <a href="javascript:void(0)" class="toolboxitems remove-btns"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                        <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-copy"></i></a>
                                        <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                            <i class="section-divider">
                                                <div class="divider-lines"></div>
                                                <div class="divider-lines"></div>
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    getsectioncontainer.append(html);
                    sectionIndex++;
                });

                let sectioncount = $('.section').length;
                console.log(sectioncount);
                if (sectioncount > 0) {
                    console.log("There are " + sectioncount + " sections.");
                } else {
                    console.log("No sections found.");
                    $('#addsection-btn').click();
                }
               {{-- End Add Section Btn --}}

                {{-- Start Question  --}}
               $(document).on('click',".csform-card,.section-card",function(){
                    $(".csform-card").removeClass('active');
                    $(".section-card").removeClass('active');

                    $(this).addClass('active');
               });
               {{-- End Question --}}



                {{-- Start Add Btn --}}
               $(document).on("click", ".add-btn", function () {
                    const section = $(this).closest(".section");
                    const sectionIndex = section.data("section-index");
                    let questionIndex = section.data("question-count");

                    const html = `
                        <div class="csform-card mb-4" data-question-index="${questionIndex}" data-option-count="1">
                            <div class="row">
                                <div class="col-md-8">
                                    <input
                                        type="text"
                                        id="question"
                                        name="sections[${sectionIndex}][questions][${questionIndex}][name]"
                                        class="form-control underline-only title-input question"
                                        placeholder="Question"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <select name="sections[${sectionIndex}][questions][${questionIndex}][type]" id="question_type" class="form-select question_type">
                                        <option value="text">Short Answer</option>
                                        <option value="textarea">Paragraph</option>
                                        <option value="radio" selected>Multiple Choice</option>
                                        <option value="checkbox">Checkboxes</option>
                                        <option value="selectbox">Dropdown</option>
                                        <option value="rating">Rating</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2 option-container">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-circle text-secondary fa-sm"></i>
                                        <input
                                            type="text"
                                            id="options"
                                            name="sections[${sectionIndex}][questions][${questionIndex}][options][0][name]"
                                            class="form-control underline-only option-input options"
                                            placeholder="Option"
                                        />
                                        <input type="hidden" name="sections[${sectionIndex}][questions][0][options][0][value]" value="" />
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-circle text-secondary fa-sm"></i>
                                        <a class="add-option" href="javascript:void(0)">Add Option</a>
                                        <span>or</span>
                                        <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                    </div>

                                </div>
                            </div>

                            <div class="toolboxs">
                                <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                <a href="javascript:void(0)" class="toolboxitems remove-btns"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-copy"></i></a>
                                <a href="javascript:void(0)" class="toolboxitems addsection-btn" title="Add Section">
                                    <i class="section-divider">
                                        <div class="divider-lines"></div>
                                        <div class="divider-lines"></div>
                                    </i>
                                </a>
                            </div>
                        </div>
                    `;

                    section.find(".question-container").append(html);
                    section.data("question-count", questionIndex + 1);
                });

               {{-- End Add Btn --}}



               {{-- Start Question Type --}}
               // Start Question Type
                $(document).on('change', ".question_type", function () {
                    const questionType = $(this).val();
                    const question = $(this).closest('.csform-card');
                    const section = $(this).closest('.section');
                    const optionContainer = question.find('.option-container');

                    const sectionIndex = section.data("section-index");
                    const questionIndex = question.data("question-index");

                   let optionIndex = 0;

                    let html = "";

                    switch (questionType) {
                        case "text":
                            html = `<small class="answer-text">Short answer text</small>`;
                            break;

                        case "textarea":
                            html = `<small class="answer-text">Long answer text</small>`;
                            break;

                        case "radio":
                            html = `
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-circle text-secondary fa-sm"></i>
                                    <input
                                        type="text"
                                        id="options"
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][0][name]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                    <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][0][value]" value="" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-circle text-secondary fa-sm"></i>
                                    <a class="add-option" href="javascript:void(0)">Add Option</a>
                                    <span>or</span>
                                    <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                </div>
                            `;
                            break;

                        case "checkbox":
                            html = `
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-square text-secondary fa-sm"></i>
                                    <input
                                        type="text"
                                        id="options"
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][0][name]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                    <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][0][value]" value="" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-square text-secondary fa-sm"></i>
                                    <a class="add-option checkboxs" href="javascript:void(0)">Add Option</a>
                                    <span>or</span>
                                    <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                </div>
                            `;
                            break;

                        case "selectbox":
                            html = `
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                                    <input
                                        type="text"
                                        id="options"
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][0][name]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                    <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][0][value]" value="" />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                                    <a class="add-option selectboxs" href="javascript:void(0)">Add Option</a>
                                    <span>or</span>
                                    <a href="#importmodal" data-bs-toggle='modal' class="importmodalbtn">Import Questions</a>
                                </div>
                            `;
                            break;
                        case "rating":

                            let ratings = '';
                            for (let i = 0; i < 5; i++) {
                                ratings += `
                                    <div class="text-center">
                                        <div class="form-group">
                                                <label>${i+1}</label>
                                                <input
                                                    type="hidden"
                                                    id="options"
                                                    name="sections[${sectionIndex}][questions][${questionIndex}][options][${i}][name]"
                                                    class="form-control underline-only option-input options"
                                                    placeholder="Option"
                                                    value = "${i+1}"
                                                />
                                                <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][${i}][value]" value="${i+1}" />
                                        </div>
                                        <i class="far fa-star text-secondary fa-sm"></i>
                                    </div>
                                `;
                            }

                            html = `
                                <div class="d-flex justify-content-around align-items-center mb-2">
                                    ${ratings}
                                </div>
                            `;
                            break;
                    }

                    optionContainer.html(html);
                    {{-- question.data("option-count", optionIndex); --}}

                });

               {{-- End Question Type  --}}



                {{-- Start Add Option --}}
                $(document).on("click", ".add-option", function(){
                    addoption.call(this);
                });

                function addoption(){
                    const section = $(this).closest(".section");
                    const question = $(this).closest(".csform-card");
                    const optionContainer = $(this).closest(".option-container");

                    const sectionIndex = section.data("section-index");
                    const questionIndex = question.data("question-index");
                    let optionIndex = question.data("option-count");


                    let iconClass = "far fa-circle"; // default: radio

                    if ($(this).hasClass("checkboxs")) {
                        iconClass = "far fa-square";
                    } else if ($(this).hasClass("selectboxs")) {
                        iconClass = "fas fa-chevron-down";
                    }

                    const html = `
                        <div class="d-flex align-items-center mb-2">
                            <i class="${iconClass} text-secondary fa-sm"></i>
                            <input
                                type="text"
                                id="options"
                                name="sections[${sectionIndex}][questions][${questionIndex}][options][${optionIndex}][name]"
                                class="form-control underline-only option-input options"
                                placeholder="Option"
                            />
                            <input type="hidden" name="sections[${sectionIndex}][questions][0][options][${optionIndex}][value]" value=""/>
                        </div>
                    `;

                    optionContainer.children().last().before(html);
                    question.data("option-count", optionIndex + 1);
                }
               {{-- End Add Option --}}


               {{-- Start Import Modal Btn --}}

                let targetQuestion;
                function importoption(tablename){
                    const section = $(this).closest(".section");
                    const question = $(this).closest(".csform-card");
                    const optionContainer = $(this).closest(".option-container");

                    const sectionIndex = section.data("section-index");
                    const questionIndex = question.data("question-index");
                    let optioncount = question.data("option-count");


                    let iconClass = "far fa-circle"; // default: radio

                    if ($(this).hasClass("checkboxs")) {
                        iconClass = "far fa-square";
                    } else if ($(this).hasClass("selectboxs")) {
                        iconClass = "fas fa-chevron-down";
                    }

                    var html = '';
                    $.ajax({
                         url:`/${tablename}`,
                         type:"GET",
                         dataType:"json",
                         data:{
                            retailbranch:true,
                            retailcategory:true
                        },
                         success:function(response){
                            console.log(response.data);
                            let resdata = response.data;

                            if(tablename == 'branches'){
                                resdata.forEach((branch,optionIndex) => {
                                    html += `
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="${iconClass} text-secondary fa-sm"></i>
                                        <input
                                            type="text"
                                            id="options"
                                            name="sections[${sectionIndex}][questions][${questionIndex}][options][${optionIndex}][name]"
                                            class="form-control underline-only option-input options"
                                            placeholder="Option"
                                            value = "${branch.branch_name}"
                                        />
                                        <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][${optionIndex}][value]" value="${branch.branch_id}"/>
                                    </div>
                                    `;
                                });
                            }else if(tablename == 'categories'){
                                resdata.forEach((category,optionIndex) => {

                                    html += `
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="${iconClass} text-secondary fa-sm"></i>
                                            <input
                                                type="text"
                                                id="options"
                                                name="sections[${sectionIndex}][questions][${questionIndex}][options][${optionIndex}][name]"
                                                class="form-control underline-only option-input options"
                                                placeholder="Option"
                                                value = "${category.name}"
                                            />
                                            <input type="hidden" name="sections[${sectionIndex}][questions][${questionIndex}][options][${optionIndex}][value]" value="${category.id}"/>
                                        </div>
                                    `;
                                });
                            }


                            optionContainer.children().remove();
                            optionContainer.html(html);

                            question.attr("data-option-count", resdata.length);

                         }
                    });
                    {{--  --}}

                }
                $(document).on('click',".importmodalbtn",function(){
                    targetQuestion = this;
                });
                {{-- End Import Modal Btn --}}

                {{-- Start Import Option Btn --}}
                $("#importoption_btn").click(function(){
                    const tablename = $("#tablename").val();
                    importoption.call(targetQuestion, tablename);
                });
                {{-- End Import Option Btn --}}



                {{-- Start Remove Btn --}}
                $(document).on("click",".remove-btns",function(){
                       const question = $(this).closest(".csform-card");
                       question.remove();
                });
                {{-- End Remove Btn --}}


                {{-- Start Update Btn --}}

                $('#update-btn').click(function(){

                    Swal.fire({
                         title: "Are you sure?",
                         text: `You form data will be updated.`,
                         icon: "warning",
                         showCancelButton: true,
                         confirmButtonColor: "#3085d6",
                         cancelButtonColor: "#d33",
                         confirmButtonText: "Yes, update it!"
                    }).then((result) => {
                         if (result.isConfirmed) {
                            $('#updateform').submit();
                         }
                    });

                });
                {{-- End Updadte Btn --}}
          });
     </script>
@endsection
