@extends('layouts.dashboard')
@section('page-title', 'User - User Type Table')

@section('style')
<style>
    table {
        background-color:white;
    }
    .table-bordered>tbody>tr>th,
    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>td {
        border: 2px solid Gainsboro;
    }
</style>
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <h1 class="pull-left">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users') !!}">List of Users</a>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive" style="background-color:white">
            <table class="table table-bordered">
                <thead style="background-color:gray; color:white">
                <th class="text-center" >Users</th>
                @foreach($roles as $role)
                <th class="text-center">{{ $role->name }}</th>
                @endforeach
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }} </td>
                        @foreach($roles as $role)
                        <td class="text-center user-role">
                            <input type="hidden" name="user-id" value="{{ $user->id }}">
                            <input type="hidden" name="role-id" value="{{ $role->id }}">
                            @if ($user->roles->contains($role))
                            <input type="hidden" name="user-role" value="1">
                            <span class="sign">
                                <i class="fa fa-check text-success" aria-hidden="true" style="font-size:150%;"></i>
                            </span>
                            @else
                            <input type="hidden" name="user-role" value="0">
                            <span class="sign">
                                <i class="fa fa-times disabled" aria-hidden="true" style="font-size:150%; color:lightGray"></i>
                            </span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $('div.alert').delay(5000).slideUp(300);
    $('td.user-role').click(function () {
        var td = $(this);
        var userRole = $(this).children("input[name='user-role']").val();
        var userId = $(this).children("input[name='user-id']").val();
        var roleId = $(this).children("input[name='role-id']").val();
        if (userRole == 0) {
            var sign = '<i class="fa fa-check text-success" aria-hidden="true" style="font-size:150%;"></i>';
            userRole = "1";
        } else {
            var sign = '<i class="fa fa-times disabled" aria-hidden="true" style="font-size:150%; color:lightGray"></i>';
            userRole = "0";
        }
        $.ajax({
            url: "{{ route('users.roles.update') }}",
            method: 'POST',
            beforeSend: ajaxLoadingStart,
            complete: ajaxLoadingStop,
            data: {
                _token: "{{ csrf_token() }}",
                user_id: userId,
                role_id: roleId,
                user_role: userRole
            },
            success: function (data) {
                console.log(data);
                $(td).children('span.sign').html(sign);
                $(td).children("input[name='user-role']").val(userRole);
            }
        });
    });
</script>

@endpush
