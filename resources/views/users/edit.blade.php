@extends('layouts.adminindex')

@section('content')
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <h4>{{ __('user.edit_new_user') }}</h4>
                </div>
            </div>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ __('There were some problems with your input.') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.name') }}:</strong>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.emp_id') }}:</strong>
                                <input type="text" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" class="form-control" placeholder="Employee ID">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.branch') }}:</strong>
                                <select class="form-control" id="branch_name" name="branch_id[]" multiple required>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->branch_id }}" {{ in_array($branch->branch_id, $userBranches) ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.phone') }}:</strong>
                                <input type="text" name="ph_no" value="{{ old('ph_no', $user->ph_no) }}" class="form-control" placeholder="Phone No">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.email') }}:</strong>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.password') }}:</strong>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.confirm_password') }}:</strong>
                                <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('user.role') }}:</strong>
                                <select id="roles" name="roles[]" class="form-control">
                                    @foreach ($roles as $key => $role)
                                        <option value="{{ $key }}" {{ in_array($key, $userRole) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('button.update') }}</button>
                            <a class="btn btn-light" href="{{ route('users.index') }}">{{ __('button.back') }}</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('#branch_name').select2({
        width: '100%',
        allowClear: true,
    });

    $('#roles').select2({
        width: '100%',
        allowClear: true,
    });

    $(document).ready(function () {
        {{-- var url = window.location.origin;
        $('#branch_name').click(function () {
            var id = $(this).val();
            $('#dept_id').find('option').remove();

            $.ajax({
                url: url + '/users/branch/' + id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var len = response.data ? response.data.length : 0;
                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response.data[i].id;
                            var name = response.data[i].name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $("#dept_id").append(option);
                        }
                    }
                }
            });
        }); --}}
    });
</script>
@endsection
