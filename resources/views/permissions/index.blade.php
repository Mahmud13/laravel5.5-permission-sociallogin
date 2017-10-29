@extends('layouts.dashboard')
@section('page-title', 'Permissions')
@section('css')

<link href="{{ asset("css/select2.min.css") }}" rel="stylesheet" type="text/css" />
<style>
    .table-bordered>tbody>tr>th,
    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>td {
        border: 2px solid Gainsboro;
    }
    .edit-button,
    .delete-button{
        padding: 3px 6px 3px 6px;
    }
    .action-column {
        width:80px;
        min-width:80px;
        max-width:80px;
    }
    th{
        text-align:center;
    }


</style>
@endsection
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div id='form-success'></div>

<div class="row">
    <div class="col-md-12">
        <h1>
            <a id="create-button" class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{{route('permissions.create')}}">
                <span class="fa fa-plus"></span>&nbsp&nbsp Add New
            </a>
        </h1>
    </div>
</div>
@if($permissions->count())
<div class="table-responsive" style="background-color:white">
    <table class="table table-bordered" style="background-color:white;">
        <thead>
            <tr style="background-color: gray; color: white">
                <th>Category</th>
                <th>Name</th>
                <th>Guard Name</th>
                <th class="action-column" >Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->category}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->guard_name}}</td>
                <td>
                    <a href="{{route('permissions.edit',['id'=>$permission->id])}}" class="btn btn-success edit-button">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>

                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Are you sure to delete this')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    {!! Form::close() !!}

                </td>
            </tr>

            @endforeach

        <tbody>
    </table>
</div>
@else
<div>There are no records to show. Click the button above to add new records.</div>
@endif
<!-- Modal -->
<div id="modal-form" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script>

$("#form-success").html(window.sessionStorage.getItem("success"));
window.sessionStorage.removeItem("success");
    $("#create-button").click(function (e) {
        e.preventDefault();
        $.get("{{route('permissions.create')}}")
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
                window.sessionStorage.setItem("success",'<div class="alert alert-success"><p>Notification ' + successMsg + ' Successfully');
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
@endpush
