<div class="col-lg-10 col-md-9 fixed-top ms-auto topnavbars">
     <div class="row">
          <nav class="navbar navbar-expand navbar-light bg-white shadow">
               <!-- search -->
               <form id="quicksearchform" class="me-auto" action="" method="">
                    <div class="input-group">
                    <input type="text" name="quicksearch" id="quicksearch" class="form-control border-0 shadow-none" placeholder="Search Something..."/>
                    <div class="input-group-append">
                         <button type="submit" id="quicksearch-btn" class="btn btn-primary "><i class="fas fa-search"></i></button>
                    </div>
                    </div>
               </form>
               <!-- search -->

               <!-- notify & userlogout-->
               <ul class="navbar-nav me-5 pe-5">
                    <!-- notify -->

                    {{-- <li class="nav-item me-2">
                         <a href="{{ route('carts.index') }}" class="nav-link">
                              <i class="fas fa-shopping-cart"></i>
                              @if(Auth::user()->carts()->exists())
                              <sup class="badge bg-danger">{{ Auth::user()->carts()->count() }}</sup>
                              @endif
                         </a>
                    </li> --}}

                    <li class="nav-item dropdowns me-3">
                    <a href="javascript:void(0);" id="noticenter" class="nav-link dropbtn">
                         <i class="fas fa-bell"></i>
                         {{-- <sup class="badge bg-danger">{{ $userdata->unreadNotifications->count() }}</sup> --}}
                         {{-- <sup class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</sup> --}}
                    </a>

                    {{-- <div class="dropdown-contents mydropdowns">

                         @if($userdata->unreadNotifications->count() > 0)
                              <a href="{{ route('leaves.markasread') }}" class="small text-muted text-center">Mark all as read</a>

                              @foreach($userdata->unreadNotifications as $notification)
                              <a href="{{ route($notification->type === 'App\Notifications\AnnouncementNotify'?'announcements.show':'leaves.show',$notification->data['id']) }}" class="d-flex">
                                   <div class="me-3">
                                        @if($notification->type === "App\Notifications\AnnouncementNotify")
                                        <img src="{{ $notification->data['img'] }}" class="rounded-circle" width="30" alt="{{ $notification->data['id'] }}">
                                        @else
                                        <i class="fas fa-bell fa-xs text-primary"></i>
                                        @endif
                                   </div>
                                   <div class="small">
                                        <ul class="list-unstyled">
                                        @if($notification->type == "App\Notifications\AnnouncementNotify")
                                             <li>{{ Str::limit($notification->data["title"],20) }}</li>
                                             <li>{{ $notification->created_at->format("d M Y h:i:s A") }}</li>
                                        @else
                                             <li>{{ $notification->data["studentid"] }}</li>
                                             <li>{{ Str::limit($notification->data["title"],20) }}</li>
                                             <li>{{ $notification->created_at->format("d M Y h:i:s A") }}</li>
                                        </ul>
                                        @endif
                                   </div>
                              </a>
                              @endforeach

                              <a href="javascript:void(0);" class="small text-muted text-center">Show All Notification</a>
                         @else
                              <a href="javascript:void(0);" class="small text-muted text-center">No New Notification</a>
                         @endif


                    </div> --}}
                    </li>
                    <!-- notify -->



                    <!-- user logout -->
                    <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
                         <span class="text-muted small me-2">{{ $userdata["name"] }}</span>
                         {{-- @if($userdata->lead['converted'])
                              <img src="{{ asset($userdata->student['image']) }}" class="rounded-circle" width="25" alt="{{ $userdata->name }}">
                         @endif --}}
                    </a>
                    <div class="dropdown-menu">
                         <a href="jascript:void(0);" class="dropdown-item"><i class="fas fa-user fa-sm text-muted me-2"></i>Profile</a>
                         <a href="jascript:void(0);" class="dropdown-item"><i class="fas fa-cogs fa-sm text-muted me-2"></i>Settings</a>
                         <a href="jascript:void(0);" class="dropdown-item"><i class="fas fa-list fa-sm text-muted me-2"></i>Activity Log</a>
                         <div class="dropdown-divider"></div>
                         <!-- Authentication -->
                        <!-- <form action="{{ route('logout')}}" method="POST" > -->
                            <!-- @csrf -->
                              <!-- <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out fa-sm text-muted me-2"></i>Logout</a> -->
                              <!-- <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); this.parentElement.submit();"><i class="fas fa-sign-out fa-sm text-muted me-2"></i>Logout</a> -->
                         <!-- </form> -->

                         <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="fas fa-sign-out fa-sm text-muted me-2"></i>Logout</a>
                         <form id="logoutform" action="{{ route('logout') }}" method="POST" >@csrf</form>


                    </div>
                    </li>
                    <!-- user logout -->
               </ul>
               <!-- notify & userlogout -->

               <button type="button" class="close-btns" data-bs-toggle="collapse" data-bs-target="#nav">
                    <i class="fas fa-times"></i>
               </button>
          </nav>
     </div>

</div>
