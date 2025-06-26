@extends('layouts.adminindex')

@section('content')
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="pull-left">
                            <h4>{{ __('user.add_new_user') }}</h4>
                        </div>
                    </div>

                    {{-- Error and success messages --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

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

                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.name') }}:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.emp_id') }}:</strong>
                                    <input type="text" name="employee_id" class="form-control" placeholder="" value="{{ old('employee_id') }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.branch') }}:</strong>
                                    <select class="form-control" id="branch_name" name="branch_id[]" multiple required>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.phone') }}:</strong>
                                    <input type="text" name="ph_no" class="form-control" placeholder="" value="{{ old('ph_no') }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.email') }}:</strong>
                                    <input type="email" name="email" class="form-control" placeholder="" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.password') }}:</strong>
                                    <input type="password" name="password" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.confirm_password') }}:</strong>
                                    <input type="password" name="confirm-password" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('user.role') }}:</strong>
                                    <select id="roles" name="roles[]" class="form-control">
                                        @foreach($roles as $key => $role)
                                            <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('button.submit') }}</button>
                                <a class="btn btn-light" href="{{ route('users.index') }}">{{ __('button.back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("css")
     <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/select2/select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('#branch_name').select2({
        width: '100%',
        allowClear: true,
    });

    $('#roles').select2({
        width: '100%',
        allowClear: true,
    });

</script>
@endsection
