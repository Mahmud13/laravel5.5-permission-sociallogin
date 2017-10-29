@extends('layouts.dashboard')
@section('page-title', 'Users')
@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

<link href="{{ asset("css/select2.min.css") }}" rel="stylesheet" type="text/css" />
<style>
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
        border-top: 0;
        background-color: #bdc3c7

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
</style>
@endpush
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table id="users-table" class="table table-bordered">
    <thead>
        <tr>
            <th width='20px'>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th width='40px'>Action</th>
        </tr>
    </thead>
</table>
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
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script>
$(function () {
    $('#users-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: "{{route('users.data')}}",
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'created', name:'users.created_at'},
            {data: 'updated',name : 'users.updated_at'},
            {data: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
<script>
$("#users-table").on('click', '.edit-button', function (e) {
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
        console.log(postData);
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

                $("#form-success").html('<div class="alert alert-success"><p>Admin ' + successMsg + ' Successfully');
                table.draw(false);
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
