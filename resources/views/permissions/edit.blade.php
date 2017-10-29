<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Permission</h4>
</div>
{!! Form::model($permission,['id'=>'edit-form','method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
<div class="modal-body">
    <div id='form-errors'>
    </div>

    <div class="row">
        @include('permissions.fileds')
    </div>
</div>
<div class="modal-footer">
    <button id="edit-form-submit" type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}
