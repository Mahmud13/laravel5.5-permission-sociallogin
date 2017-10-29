<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">New User Type</h4>
</div>
{!! Form::open(array('id'=>'create-form','route' => 'roles.store','method'=>'POST')) !!}
<div class="modal-body">
    <div id='form-errors'>
    </div>
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
                <small>You can add permissions later from Role Permission Table</small>
                <select name="permissions[]" class="form-control permissions" multiple="multiple">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="create-form-submit" type="submit" class="btn btn-primary">Create</button>
</div>
{!! Form::close() !!}

<script>
    $(function () {
        $("select.permissions").select2({'width': '100%'});
    });
</script>
