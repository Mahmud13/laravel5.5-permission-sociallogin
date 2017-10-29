@extends('layouts.dashboard')
@section('page-title', 'User Types')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div id='form-success'></div>
@can('role-create')
<div class="row">
    <div class="col-md-12">
        <h1 class="pull-right">
            <a id="create-button" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{route('roles.create')}}">Add New</a>
        </h1>
    </div>
</div>
@endcan
<div class="table-responsive" style="background-color:white">
    <table class="table table-bordered" style="background-color:white;">
        <thead>
            <tr style="background-color: gray; color: white">
                <th>User Type</th>
                <th>Permission(s)</th>
                @canany('role-update|role-delete')
                <th width="280px">Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)

            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->permissions->implode('name', ', ')}}</td>
                @canany('role-update|role-delete')
                <td>
                    <a href="{{route('roles.edit',['id'=>$role->id])}}" class="btn btn-success edit-button">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Are you sure to delete this')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    {!! Form::close() !!}
                    @endcan

                </td>
                @endcanany

            </tr>

            @endforeach


        <tbody>
    </table>
</div>
<div id="modal-form" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
$("#form-success").html(window.sessionStorage.getItem("success"));
window.sessionStorage.removeItem("success");
    $("#create-button").click(function (e) {
        e.preventDefault();
        $.get("{{route('roles.create')}}")
                .done(function (data) {
                    $(".modal-content").html(data);
                    $("#modal-form").modal('show');
                });
    });
    $(".edit-button").click(function (e) {
        e.preventDefault();
        $.get($(this).attr('href'))
                .done(function (data) {
                    $(".modal-content").html(data);
                    $("#modal-form").modal('show');
                });
    });
</script>
<script src="{{asset("js/select2.min.js") }}"></script>
<script>
    $(function () {
        $("select.permissions").select2({'width': '100%'});
    });
</script>

<script>
    $(document).on('submit', "#create-form", function (e) {
        e.preventDefault();
        submitForm(this);
    });
    $(document).on('submit', "#edit-form", function (e) {
        e.preventDefault();
        submitForm(this);
    });
    function submitForm(selector) {
        var postData = new FormData(selector);
        var formURL = $(selector).attr('action');
        var successMsg = "";
        if ($(selector).attr('id') == "create-form") {
            successMsg = "created";
        } else {
            successMsg = "updated";
        }
        $.post({
            url: formURL,
            data: postData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                $('#modal-form').modal('hide');
                window.sessionStorage.setItem("success",'<div class="alert alert-success"><p>Role ' + successMsg + ' Successfully');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                if (jqXHR.status === 422) {
                    errors = jqXHR.responseJSON;
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    errorsHtml += "</ul></div>";
                    $("#form-errors").html(errorsHtml);
                } else {
                    console.log(jqXHR.responseText);
                }
            }
        });
    }
</script>
@endsection
