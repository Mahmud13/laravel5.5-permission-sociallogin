@can('user-edit')
<a href="{{route('users.edit',['id'=>$user->id])}}" class="btn btn-success edit-button">
    <span class="glyphicon glyphicon-edit"></span>
</a>
@endcan
@can('user-delete')
{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
<button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Are you sure to delete this')">
    <span class="glyphicon glyphicon-remove "></span>
</button>
{!! Form::close() !!}
@endcan
