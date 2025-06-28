@extends("layouts.adminindex")

@section("content")

     <!-- Start Page Content Area -->
     <div class="container-fluid">
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
                <div class="container csform-container mt-0">
                    <form action="{{ route("forms.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="csform-header">
                            {{-- <h2 class="mb-2">Customer Satisfaction Survey</h2> --}}
                            <input
                            type="text"
                            class="form-control underline-only maintitle-input mb-2"
                            name="title"
                            value="{{ old('title','Untitled form') }}"
                            />
                            <input
                            type="text"
                            class="form-control underline-only"
                            name="description"
                            value="{{ old('description','') }}"
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

                            @foreach ($oldSections as $sectionIndex => $section)
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
                                    </div>

                                    <div class="question-container">
                                        @foreach ($section['questions'] ?? [] as $questionIndex => $question)
                                            <div class="csform-card mb-4" data-question-index="{{ $questionIndex }}">
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
                                                                @foreach ($question['options'] as $option)
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                        <input
                                                                            type="text"
                                                                            id="options"
                                                                            name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][]"
                                                                            class="form-control underline-only option-input options"
                                                                            value="{{ $option }}"
                                                                            placeholder="Option"
                                                                        />
                                                                    </div>
                                                                @endforeach
                                                                <div class="d-flex align-items-center">
                                                                    <i class="{{ $iconClass }} text-secondary fa-sm"></i>
                                                                    <a class="add-option {{ $addOptionClass }}" href="javascript:void(0)">Add Option</a>
                                                                </div>
                                                            @else
                                                                {!! $optiontext !!}
                                                            @endif

                                                    </div>
                                                </div>

                                                <div class="toolboxs">
                                                    <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                                    <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
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
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
          </div>
     </div>
     <!-- End Page Content Area -->
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
                            </div>

                            <div class="question-container">
                                <div class="csform-card mb-4" data-question-index="0">
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
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2 option-container">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="far fa-circle text-secondary fa-sm"></i>
                                                <input
                                                    type="text"
                                                    id="options"
                                                    name="sections[${sectionIndex}][questions][0][options][]"
                                                    class="form-control underline-only option-input options"
                                                    placeholder="Option"
                                                />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-circle text-secondary fa-sm"></i>
                                                <a class="add-option" href="javascript:void(0)">Add Option</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="toolboxs">
                                        <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                        <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
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
                        <div class="csform-card mb-4" data-question-index="${questionIndex}">
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
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2 option-container">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-circle text-secondary fa-sm"></i>
                                        <input
                                            type="text"
                                            id="options"
                                            name="sections[${sectionIndex}][questions][${questionIndex}][options][]"
                                            class="form-control underline-only option-input options"
                                            placeholder="Option"
                                        />
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-circle text-secondary fa-sm"></i>
                                        <a class="add-option" href="javascript:void(0)">Add Option</a>
                                    </div>
                                </div>
                            </div>

                            <div class="toolboxs">
                                <a href="javascript:void(0)" class="toolboxitems add-btn"><i class="fas fa-plus-circle"></i></a>
                                <a href="javascript:void(0)" class="toolboxitems"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
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
                    const card = $(this).closest('.csform-card');
                    const section = $(this).closest('.section');
                    const optionContainer = card.find('.option-container');

                    const sectionIndex = section.data("section-index");
                    const questionIndex = card.data("question-index");

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
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-circle text-secondary fa-sm"></i>
                                    <a class="add-option" href="javascript:void(0)">Add Option</a>
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
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-square text-secondary fa-sm"></i>
                                    <a class="add-option checkboxs" href="javascript:void(0)">Add Option</a>
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
                                        name="sections[${sectionIndex}][questions][${questionIndex}][options][]"
                                        class="form-control underline-only option-input options"
                                        placeholder="Option"
                                    />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                                    <a class="add-option selectboxs" href="javascript:void(0)">Add Option</a>
                                </div>
                            `;
                            break;
                    }

                    optionContainer.html(html);
                });

               {{-- End Question Type  --}}



                {{-- Start Add Option --}}
                $(document).on("click", ".add-option", function () {
                    const optionContainer = $(this).closest(".option-container");
                    const card = $(this).closest(".csform-card");
                    const section = $(this).closest(".section");

                    const sectionIndex = section.data("section-index");
                    const questionIndex = card.data("question-index");

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
                                name="sections[${sectionIndex}][questions][${questionIndex}][options][]"
                                class="form-control underline-only option-input options"
                                placeholder="Option"
                            />
                        </div>
                    `;

                    optionContainer.children().last().before(html);
                });
               {{-- End Add Option --}}



          });
     </script>
@endsection
