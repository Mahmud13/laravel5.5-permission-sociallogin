@extends('layouts.dashboard')
@section('page-title', 'Role Permission Table')
@section('style')
<style>
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
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('roles') !!}">List of Roles</a>
        </h1>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive" style="background-color:white">
            <table class="table table-bordered" style="background-color:white;">
                <thead>
                    <tr style="background-color: gray; color: white">
                        <th style="text-align:center" >Category</th>
                        <th style="text-align:center" >Permissions</th>
                        @foreach($roles as $role)
                        <th class="text-center">{{ $role->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php($curgrp = "")
                    @foreach($perm_groups as $group=>$permissions)
                    @foreach($permissions as $permission)
                    <tr>
                        @if($curgrp != $group)
                        <th scope="row" rowspan="{{$permissions->count()}}" style="vertical-align:middle">
                            {{ ucfirst($group) }}
                        </th>

                        @php($curgrp = $group)

                        @endif

                        <td>{{ $permission->name }} </td>

                        @foreach($roles as $role)
                        <td class="text-center role-permission">
                            <input type="hidden" name="role-id" value="{{ $role->id }}">
                            <input type="hidden" name="perm-id" value="{{ $permission->id }}">
                            @if ($role->permissions->contains($permission))
                            <input type="hidden" name="role-perm" value="1">
                            <span class="sign">
                                <i class="fa fa-check text-success" aria-hidden="true" style="font-size:150%;"></i>
                            </span>

                            @else
                            <input type="hidden" name="role-perm" value="0">
                            <span class="sign">
                                <i class="fa fa-times disabled" aria-hidden="true" style="font-size:150%; color:lightgray"></i>
                            </span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@can('role-edit')
<script>
    $('div.alert').delay(5000).slideUp(300);

    $('td.role-permission').click(function () {
        console.log('ASa');

        var td = $(this);
        var rolePerm = $(this).children("input[name='role-perm']").val();
        var roleId = $(this).children("input[name='role-id']").val();
        var permId = $(this).children("input[name='perm-id']").val();
        if (rolePerm == 0) {
            var sign = '<i class="fa fa-check text-success" aria-hidden="true" style="font-size:150%;"></i>';
            rolePerm = "1";
        } else {
            var sign = '<i class="fa fa-times disabled" aria-hidden="true" style="font-size:150%; color:lightGray"></i>';
            rolePerm = "0";
        }
        $.ajax({
            url: "{{ route('roles.table.update') }}",
            method: 'POST',
            beforeSend: ajaxLoadingStart,
            complete: ajaxLoadingStop,
            data: {
                _token: "{{ csrf_token() }}",
                role_id: roleId,
                perm_id: permId,
                role_perm: rolePerm
            },
            success: function (data) {
                $(td).children('span.sign').html(sign);
                $(td).children("input[name='role-perm']").val(rolePerm);
            }
        });
    });
</script>
@endcan
@endpush
