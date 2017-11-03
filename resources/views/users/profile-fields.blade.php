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
        <label>Location:</label>
        {!! Form::select('country_id', $countries) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Time Zone:</label>
        {!! Form::select('time_zone_id', $time_zones) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Age:</label>
        {!! Form::text('age', $time_zones) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Occupation:</label>
        {!! Form::select('occupation_id', $occupations) !!}
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Profile Picture:</strong>
        {!! Form::file('photo', ['id' => 'profile-picture-input']) !!}
    </div>
</div>

<img id="profile-picture-preview" src="{{ route('users.getPhoto', ['id' => $user->id ]) }}" />
