@include("layouts.adminheader")
<div id="app">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-white p-4 rounded">
            <div class="text-center">
                <img src="{{ asset('assets/imgs/icons/customersurveyicon.png') }}" alt="customersurveyicon" width="100px" />
            </div>

            <h5>Sign In</h5>

            <form class="mt-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <input type="login" name="login" class="form-control @error('login') is-invalid @enderror" placeholder="Email or Employee ID" autofocus value="{{ old('login') }}"/>
                    @error('login')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}"/>
                    @error('password')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-flex">
                        <div class="form-check">
                            <input type="checkbox" name="" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember">Remember ME</label>
                        </div>
                        <div class="ms-auto">
                            {{-- <a href="{{ route('password.request') }}"><i class="fas fa-lock me-1"></i>Forgot Password ?</a> --}}
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Log In</button>
                </div>
            </form>

            <!-- social login -->
             <div class="row">
                <small class="text-center text-muted mt-3">Sign in with</small>
                <div class="col-12 mt-2 text-center">
                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Github"><i class="fab fa-github"></i></a>
                </div>
             </div>

             <!-- register -->
             <div class="row">
                <div class="col-12 mt-2 text-center">
                    <small>Don't have an account?  <a href="javascript:void(0);" class="text-primary ms-1">Sign Up</a></small>
                </div>
             </div>
        </div>
    </div>
</div>
@include("layouts.adminfooter")
