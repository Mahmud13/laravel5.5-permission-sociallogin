<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">New Permission</h4>
</div>
{!! Form::open(array('id'=>'create-form','route' => 'permissions.store','method'=>'POST')) !!}
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
        @include('permissions.fileds')
    </div>
</div>
<div class="modal-footer">
    <button id="create-form-submit" type="submit" class="btn btn-primary">Create</button>
</div>
{!! Form::close() !!}
