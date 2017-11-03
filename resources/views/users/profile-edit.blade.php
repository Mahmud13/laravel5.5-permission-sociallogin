<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Profile</h4>
</div>
{!! Form::model($user,['id'=>'edit-form','method' => 'PATCH','route' => ['users.profileUpdate', $user->id], 'files' => true]) !!}
<div class="modal-body">
    <div id='form-errors'>
    </div>

    <div class="row">
        @include('users.profile-fields')
    </div>
</div>
<div class="modal-footer">
    <button id="edit-form-submit" type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}
