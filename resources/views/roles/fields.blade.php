
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Name:</strong>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Guard Name:</strong>
        {!! Form::hidden('guard_name', 'admin', array('placeholder' => 'Display Name','class' => 'form-control')) !!}
    </div>
</div>


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
