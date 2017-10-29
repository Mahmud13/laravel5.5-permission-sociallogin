<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit User Type</h4>
</div>
{!! Form::model($role, ['id'=>'edit-form','method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="modal-body">
    <div id='form-errors'>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User Type:</strong>
                {!! Form::text('name', null, array('placeholder' => 'User Type','class' => 'form-control')) !!}
            </div>
        </div>
        {!! Form::hidden('guard_name', 'admin', array('placeholder' => 'Display Name','class' => 'form-control')) !!}


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Permission(s):</label>
                <select name="permissions[]" class="form-control permissions" multiple="multiple">
                    @foreach($permissions as $permission)
                    <option  value="{{$permission->name}}" {{ $role->permissions->contains($permission) ? "selected" : "" }}>{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="edit-form-submit" type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}

<script>
    $(function () {
        $("select.permissions").select2({'width': '100%'});
    });
</script>
