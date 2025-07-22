<!-- Start Footer Section -->
<footer id="footer" class="footers">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-8 ms-auto">
                        <div class="row border-top pt-3">
                            <div class="col-lg-6 text-center">
                                <div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item me-2">
                                            <a href="#" class="text-dark">Pro1 Global Co.,Ltd</a>
                                        </li>
                                        <li class="list-inline-item me-2">
                                            <a href="#" class="text-dark">About</a>
                                        </li>
                                        <li class="list-inline-item me-2">
                                            <a href="#" class="text-dark">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center">
                                <p>&copy; <span id="getyear"></span> Copyright, All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Setion -->


        <!-- Start Right Navbar -->
        <div class="right-panels">
            <form action="" method="">
                <input type="text" name="usersearch" id="usersearch" class="form-control form-control-sm rounded-0 mb-2" placeholder="Search...."/>
            </form>
            <ul id="onoffusers" class="list-group list-group-flush">
                {{-- @foreach($onlineusers as $onlineuser)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">{{ $onlineuser->name }}</div>
                            <div class="small">{{  \Carbon\Carbon::parse($onlineuser->last_active)->format("m-d-Y h:m:s a") }}</div>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-circle fa-xs"></i>
                        </div>
                    </li>
                @endforeach --}}
            </ul>


        </div>
        <!-- End Right Navbar -->

        <!-- START MODAL AREA -->
            <!-- Start Quicksearch Modal -->
            <div id="quicksearchmodal" class="modal fade">
                <div class="modal-dialog modal-dialog-center">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h6 class="modal-title">Result</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <!-- <li><a href=""></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Quicksearch Modal -->
        <!-- END MODAL AREA -->


        <!-- bootstrap css1 js1 -->
        <script src="{{ asset('./assets/libs/bootstrap5/bootstrap.bundle.min.js') }}" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- jquery js1 -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" type="text/javascript"></script> -->
         <script src="{{asset('./assets/libs/jquery-3.6.0/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
        <!-- jqueryui css1 js1 -->
        <script src="{{asset('./assets/libs/jquery-ui-1.13.2.custom/jquery-ui.min.js')}}"></script>
        <!-- axoios js1 -->
        {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
        <!-- Google Chart -->
        {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
        <!-- Chartjs js1 -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Raphael must be included before justgage -->
        <!-- https://github.com/toorshia/justgage -->
        {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script> --}}

        <!-- toastr css1 js1 -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script> --}}

        {{-- select css1 js1 --}}
        <script src="{{ asset('assets/libs/select2/select2.min.js') }}" type="text/javascript"></script>

        {{-- sweetalert2 css1 js1 --}}
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>


        <script>
                {{-- toastr.options = {
                    "progressBar":true,
                    "closeButton":true
                }; --}}
        </script>

            @if(Session::has("success"))
                <script>toastr.success('{{ session()->get("success") }}', 'Successful')</script>
            @endif

            @if(session()->has("info"))
                <script>toastr.info('{{ session()->get("info") }}', 'Information')</script>
            @endif

            @if(session()->has("error"))
                <script>toastr.error('{{ session()->get("error") }}', 'Inconceivable')</script>
            @endif

            {{-- @if($errors)
                @foreach($errors->all() as $error)
                    <script>toastr.error('{{$error}}', 'Warning!',{timeOut:3000})</script>
                @endforeach
            @endif --}}



        <!-- custom js js1 -->
        <script src="{{ asset('assets/dist/js/app.js') }}" type="text/javascript"></script>

         {{-- @vite(["public/assets/dist/js/app.js"])  --}}

        <!-- Extra js -->
        @yield('scripts')

        <script type="text/javascript">

            {{-- // Start Quick Search
            $("#quicksearch-btn").on("click",function(e){
                e.preventDefault();
                quicksearch();
            });

            async function quicksearch(){
                // console.log("hay");

                const getsearch = $("#quicksearch").val();
                // console.log(getsearch);

                await $.post("{{ route('students.quicksearch') }}",
                {
                    _token:$("meta[name='csrf-token']").attr("content"),
                    keyword: getsearch
                }
                ,function(response){
                    // console.log(response);
                    showresulttodom(response);
                });
            }
            function showresulttodom(response){
                console.log(response);
                let newlis="";
                $("#quicksearchmodal").modal("show"); // toggle

                if(response.datas.length <= 0){
                    newlis += `<li class='list-group-item'>No Data</li>`;
                }else{
                    for(let x=0; x<response.datas.length; x++){
                        newlis += `<li class='list-group-item'><a href="{{ URL::to('students/${response.datas[x].id}') }}">${response.datas[x].regnumber} / ${response.datas[x].firstname} ${response.datas[x].lastname}</a></li>`;
                    }
                }
                $("#quicksearchmodal .modal-body ul.list-group").html(newlis);

                // clear form
                // $("#quicksearchform")[0].reset();
                $("#quicksearchform").trigger("reset")
            }
            // End Quick Search


            // Start Onoffuser Search
            var getusersearch = document.getElementById('usersearch');

            var getonoffusers = document.getElementById('onoffusers');
            var getonoffuserlis = getonoffusers.getElementsByTagName('li');
            // console.log(getonoffusers);
            // console.log(getonoffuserlis);//HTMLCollection

            // Event Listener
            getusersearch.addEventListener('keyup',filter);

            function filter(){
                // console.log(this.value);


                var inputfilter = this.value.toLowerCase();
                // console.log(inputfilter);

                for(var x = 0 ; x < getonoffuserlis.length ; x++){

                    var getlink = getonoffuserlis[x].getElementsByTagName('div')[1];
                    // console.log(getlink);

                    var getdivtext = getlink.textContent || getlink.innerText;

                    if(getdivtext.toLowerCase().indexOf(inputfilter) > -1){
                        getonoffuserlis[x].classList.remove("d-none")
                    }else{
                        getonoffuserlis[x].classList.add("d-none")
                    }
                }
            }
            // End Onoffuser Search --}}
        </script>
    </body>
</html>
