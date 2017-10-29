

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit User</h4>
</div>
{!! Form::model($user,['id'=>'edit-form','method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="modal-body">
    <div id='form-errors'>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="row">
        @include('users.fields')
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}


<script src="{{asset("js/select2.min.js") }}"></script>
<script>
$("select.roles").select2({'width': '100%'});
</script>
