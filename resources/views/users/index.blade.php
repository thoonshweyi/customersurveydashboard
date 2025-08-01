@extends('layouts.adminindex')

@section('content')
<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between">
          <div>
            <h4 class="">{{__('user.users')}}</h4>
          </div>
        </div>
      </div>
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
      <div class="col-lg-12 mb-4">
        <div class="row align-items-end">

            <div class="form-row col-md-2">
                <label>{{__('user.branch')}} </label>
                <select id="branch_id" class="form-control ">
                    <option value="">All Branch</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->branch_id }}" {{ $branch->branch_id == old('document_branch') ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-row col-md-2">
            <label>{{__('user.name')}} </label>
            <input type="input" class="form-control" id="user_name" value="">
            </div>
            <div class="form-row col-md-2">
            <label>{{__('user.emp_id')}} </label>
            <input type="input" class="form-control" id="user_employee_id" value="">
            </div>
            <div class="form-row col-md-2">
            <label>{{__('user.email')}}</label>
            <input type="input" class="form-control" id="user_email" value="">
            </div>

            <div class="form-row col-md-2">
            <label>{{__('user.role')}}</label>
            <select id="user_role" class="form-control ">
                <option value="">All Role</option>
            </select>
            </div>

            <div class="col">
                <button id="user_search" class="btn btn-primary main_button mr-2">{{__('button.search')}}</button>
                <button id="user_add" class="btn btn-secondary main_button" onclick=location.href="{{ route('users.create') }}">{{__('button.add_new')}}</button>
            </div>

            </div>
        </div>

    </div>
  </div>
  <div class="col-lg-12">
    <div class="table-responsive rounded mb-3">
      <table class="table mb-0 tbl-server-info" id="user_list" style="table-layout: fixed">
        <thead class="bg-white text-uppercase">
          <tr class="ligth ligth-data">
            <th>{{__('user.branch')}}</th>
            <th>{{__('user.name')}}</th>
            <th>{{__('user.emp_id')}}</th>
            <th>{{__('user.email')}}</th>
            <th>{{__('user.role')}}</th>
            <th>{{__('user.action')}}</th>
          </tr>
        </thead>
        <tbody class="ligth-body">
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection

@section("css")
 <link rel="stylesheet" href="{{ asset('assets/libs/datatable/jquery.dataTables.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/libs/datatable/rowReorder.dataTables.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.dataTables.min.css') }}">
@endsection
@section('scripts')
<script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}" ></script>
 <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.rowReorder.min.js') }}" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    $('#user_list').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "lengthChange": false,
      "autoWidth": true,
      "responsive": true,
      "order": [
        [1, 'des']
      ],
      'ajax': {
        'url': "/users",
        'type': 'GET',
        'data': function(d) {
          d.user_name = $('#user_name').val();
          d.user_employee_id = $('#user_employee_id').val();
          d.user_email = $('#user_email').val();
          d.user_role = $('#user_role').val();
          d.branch_id = $('#branch_id').val();
        }
      },
      columns: [{
          data: 'branch_name',
          name: 'branch_name',
          // data: 'name',
          // name: 'name',
          orderable: true
        },{
          data: 'name',
          name: 'name',
          orderable: true
        },
        {
          data: 'employee_id',
          name: 'employee_id',
          orderable: true
        },
        {
          data: 'email',
          name: 'email',
          orderable: true
        },
        {
          data: 'role',
          name: 'role',
          orderable: true,
          render: function(data, type, row) {
            return data;
          }
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          render: function(data, type, row) {
            return `<div class="d-flex align-items-center list-action g-2">
                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Detail" data-original-title="Detail"
                            href="/users/${row.id}"><i class="fas fa-eye"></i></a>
                        <a class="badge bg-primary mr-2" data-toggle="tooltip" data-placement="top" title="Detail" data-original-title="Detail"
                            href="/users/${row.id}/edit"><i class="fas fa-edit"></i></a>
                    </div>`
          }
        }
      ],
      "columnDefs": [{
        "searchable": false,
        "orderable": false,
        "targets": 0,
      }],
    })

    $('#user_search').on('click', function(e) {
      $('#user_list').DataTable().draw(true);
    })
  });
</script>
@stop
