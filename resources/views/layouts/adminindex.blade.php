@include("layouts.adminheader")

     <div id="app">
           <!-- Start Site Setting -->
           <div id="sitesettings" class="sitesettings">
               <div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i class="fas fa-cog ani-rotates"></i></a></div>
          </div>
          <!-- End Site Setting -->

          <!-- Start Left Side Bar -->
          @include("layouts.adminleftsidebar")
          <!-- End Left Side Bar -->

          <!-- Start Content Area -->
          <section>
               <div id="browsepath" class="container-fluid">
                    <div class="row">
                         <div class="col-lg-10 col-md-9 ms-auto pt-md-5 mt-mt-3">
                         <!-- Start Inner Content Area -->
                         <div class="row">
                              {{-- <h5>@yield("caption")</h5> --}}
                              {{--<h6>{{ucfirst(Request::path()) }}</h6> --}}

                              <nav>
                                   <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ \Request::root() }}"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ Str::title(preg_replace("/[[:punct:]]+[[:alnum:]]+/","",str_replace(Request::root()."/","",url()->previous()))) }}</a></li>
                                        <li class="breadcrumb-item active">{{ucfirst(Request::path()) }}</li>
                                   </ol>
                              </nav>

                              @yield("content")
                         </div>
                         <!-- End Inner Content Area -->
                         </div>
                    </div>
               </div>
          </section>
          <!-- End Content Area -->

     </div>

@include("layouts.adminfooter")


{{-- <p>{{ \Request::root() }}<p> --}}            {{-- http://127.0.0.1:8000 --}}
{{-- <p>{{ \Request::fullURL() }}<p> --}}          {{-- http://127.0.0.1:8000/edulinks?filter=4&search=16 --}}
{{-- <p>{{ \Request::url() }}<p> --}}              {{-- http://127.0.0.1:8000/edulinks (not including query) --}}
{{-- <p>{{ \Request::getRequestUri() }}<p> --}}    {{-- /edulinks?filter=4&search=16 ( include all url and query behind domain /host name ) --}}
{{-- <p>{{ \Request::getPathInfo() }}<p> --}}      {{-- /edulinks ( include all url behind domain /host name but not including query ) --}}
{{-- <p>{{ \Request::path() }}<p> --}}             {{-- posts/1/edit ( include all url behind domain /host name but not including query ) --}}


{{-- <p>{{ request()->root() }}<p> --}}             {{-- http://127.0.0.1:8000 --}}
{{-- <p>{{ request()->fullURL() }}<p> --}}          {{-- http://127.0.0.1:8000/edulinks?filter=4&search=16 --}}
{{-- <p>{{ request()->url() }}<p> --}}              {{-- http://127.0.0.1:8000/edulinks (not including query) --}}
{{-- <p>{{ request()->getRequestUri() }}<p> --}}    {{-- /edulinks?filter=4&search=16 ( include all url and query behind domain /host name ) --}}
{{-- <p>{{ request()->getPathInfo() }}<p> --}}      {{-- /edulinks ( include all url behind domain /host name but not including query ) --}}
{{-- <p>{{ request()->path() }}<p> --}}             {{-- posts/1/edit ( include all url behind domain /host name but not including query ) --}}

{{-- /////////////////////////////////////////////////////////////////// --}}

{{-- <p>{{ url()->full() }}<p> --}}                {{-- http://127.0.0.1:8000/edulinks?filter=4&search=16 --}}
{{-- <p>{{ url()->current() }}<p> --}}             {{-- http://127.0.0.1:8000/edulinks (not including query) --}}
{{-- <p>{{ url()->previous() }}<p> --}}            {{-- http://127.0.0.1:8000/edulinks?filter=4&search=16 (get full url but it is the last url request not current) --}}
