@extends("layouts.adminindex")

@section("content")

     <!-- Start Page Content Area -->
     <div class="container-fluid">
          <div class="col-md-12">
                <div class="container csform-container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="csform-header">
                            {{-- <h2 class="mb-2">Customer Satisfaction Survey</h2> --}}
                            <input
                            type="text"
                            class="form-control underline-only maintitle-input mb-2"
                            name=""
                            value="Untitled form"
                            />
                            <input
                            type="text"
                            class="form-control underline-only"
                            name=""
                            value=""
                            placeholder="Form description"
                            />
                        </div>

                        <div class="required-text">
                        * Indicates required question
                        </div>


                        <div class="section-container">
                            <div class="d-flex justify-content-betweenmt-2">
                                <h6 class="section-header m-0">Section 1</h6>
                            </div>
                            <div class="section-card">
                                  <div class="row">
                                    <div class="col-md-8">
                                        <input
                                            type="text"
                                            id="section"
                                            name="section[]"
                                            class="form-control underline-only title-input question"
                                            value=""
                                            placeholder="Section"
                                        />
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <input
                                            type="text"
                                            class="form-control underline-only option-input"
                                            name=""
                                            value=""
                                            placeholder="Section description"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="csform-card mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input
                                            type="text"
                                            id="question"
                                            name="question[]"
                                            class="form-control underline-only title-input question"
                                            value=""
                                            placeholder="Question"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <select name="question_type" id="question_type" class="form-select question_type">
                                            <option value="text"><i class="fas fa-grip-lines"></i>Short Answer</option>
                                            <option value="textarea"> <i class="fas fa-align-center"></i> Paragraph</option>
                                            <option value="radio"><i class="fas fa-dot-circle"></i> Multiple Choice</option>
                                            <option value="checkbox"><i class="fas fa-check-square"></i> Checkboxes</option>
                                            <option value="selectbox"><i class="fas fa-chevron-circle-down"></i>Dropdown</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2 option-container">
                                        <small class="answer-text">Short answer text</small>
                                    </div>
                                </div>

                                <div class="toolboxs">
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-plus-circle"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-copy"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems">
                                        <i class="section-divider">
                                            <div class="divider-lines"></div>
                                            <div class="divider-lines"></div>
                                        </i>
                                    </a>
                                </div>
                            </div>

                            <div class="csform-card mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input
                                            type="text"
                                            id="question"
                                            name="question[]"
                                            class="form-control underline-only title-input question"
                                            value=""
                                            placeholder="Question"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <select name="question_type" id="question_type" class="form-select question_type">
                                            <option value="text"><i class="fas fa-grip-lines"></i>Short Answer</option>
                                            <option value="textarea"> <i class="fas fa-align-center"></i> Paragraph</option>
                                            <option value="radio" selected><i class="fas fa-dot-circle"></i> Multiple Choice</option>
                                            <option value="checkbox"><i class="fas fa-check-square"></i> Checkboxes</option>
                                            <option value="selectbox"><i class="fas fa-chevron-circle-down"></i>Dropdown</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2 option-container">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="far fa-circle text-secondary fa-sm"></i>
                                            <input
                                                type="text"
                                                id="options"
                                                name="options[]"
                                                class="form-control underline-only option-input options"
                                                value=""
                                                placeholder="Option"
                                            />
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-circle text-secondary fa-sm"></i>
                                            <a class="add-option">Add Option</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="toolboxs">
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-plus-circle"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems"><i class="fas fa-copy"></i></a>
                                    <a href="javascript:void(0) " class="toolboxitems">
                                        <i class="section-divider">
                                            <div class="divider-lines"></div>
                                            <div class="divider-lines"></div>
                                        </i>
                                    </a>
                                </div>
                            </div>
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



               {{-- Start Question Type --}}

               $(document).on('change',".question_type",function(){
                    const questiontype = $(this).val();
                    const getoptioncontainer = $(this).closest('.csform-card').find('.option-container');
                    {{-- console.log(getoptioncontainer); --}}
                    let html;
                    switch(questiontype){
                        case "text":
                            console.log(questiontype);
                            html = `
                            <small class="answer-text">Short answer text</small>
                            `
                            getoptioncontainer.html(html);
                            break;
                        case "textarea":
                            html = `
                            <small class="answer-text">Long answer text</small>
                            `
                            getoptioncontainer.html(html);
                            break;
                        case "radio":
                            html = `
                            <div class="d-flex align-items-center mb-2">
                                <i class="far fa-circle text-secondary fa-sm"></i>
                                <input
                                    type="text"
                                    id="options"
                                    name="options[]"
                                    class="form-control underline-only option-input options"
                                    value=""
                                    placeholder="Option"
                                />
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="far fa-circle text-secondary fa-sm"></i>
                                <a class="add-option">Add Option</a>
                            </div>
                            `;
                            getoptioncontainer.html(html);
                            break;
                        case "checkbox":
                                html = `
                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-square text-secondary fa-sm"></i>
                                    <input
                                        type="text"
                                        id="options"
                                        name="options[]"
                                        class="form-control underline-only option-input options"
                                        value=""
                                        placeholder="Option"
                                    />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-square text-secondary fa-sm"></i>
                                    <a class="add-option checkboxs">Add Option</a>
                                </div>
                                `;
                                getoptioncontainer.html(html);
                                break;
                        case "selectbox":
                                html = `
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                                    <input
                                        type="text"
                                        id="options"
                                        name="options[]"
                                        class="form-control underline-only option-input options"
                                        value=""
                                        placeholder="Option"
                                    />
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                                    <a class="add-option selectboxs">Add Option</a>
                                </div>
                                `;
                                getoptioncontainer.html(html);
                                break;
                        }
               });
               {{-- End Question Type  --}}


               {{-- Start Add Option --}}
               $(document).on("click",".add-option",function(){
                    console.log("Option Added");

                    const getoptioncontainer = $(this).closest('.option-container');
                    const checkboxs = $(this).hasClass('checkboxs');
                    let html = '';
                    if(checkboxs){
                        html = `
                        <div class="d-flex align-items-center mb-2">
                                <i class="far fa-square text-secondary fa-sm"></i>
                                <input
                                    type="text"
                                    id="options"
                                    name="options[]"
                                    class="form-control underline-only option-input options"
                                    value=""
                                    placeholder="Option"
                                />
                            </div>
                        `;
                    }else if($(this).hasClass('selectboxs')){
                        html = `
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-chevron-down text-secondary fa-sm"></i>
                            <input
                                type="text"
                                id="options"
                                name="options[]"
                                class="form-control underline-only option-input options"
                                value=""
                                placeholder="Option"
                            />
                        </div>
                        `;
                    }else{
                        html = `
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-circle text-secondary fa-sm"></i>
                            <input
                                type="text"
                                id="options"
                                name="options[]"
                                class="form-control underline-only option-input options"
                                value=""
                                placeholder="Option"
                            />
                        </div>
                    `;
                    }

                     getoptioncontainer.children().last().before(html);

               });
               {{-- End Add Option --}}

               {{-- Start Question  --}}
               $(document).on('click',".csform-card",function(){
                console.log("hay");
                    $(".csform-card").removeClass('active');

                    $(this).addClass('active');
               });
          });
     </script>
@endsection
