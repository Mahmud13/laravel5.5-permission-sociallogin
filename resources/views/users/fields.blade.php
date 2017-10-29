<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Name:</strong>
        {!! Form::text('name', $user->name, array('id' => 'name', 'placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Email:</strong>
        {!! Form::text('email', $user->email, array('id' => 'email', 'placeholder' => 'Email','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Password:</strong>
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Confirm Password:</strong>
        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Role(s):</label>
        <select id="roles" name="roles[]" class="form-control roles" multiple="multiple">
            @foreach($roles as $role)
            <option value="{{$role->name}}" {!! $user->roles->contains($role) ? 'selected="selected"' : '' !!}>{{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>