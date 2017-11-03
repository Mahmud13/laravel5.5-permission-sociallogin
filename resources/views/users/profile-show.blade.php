@extends('layouts.dashboard')
@section('page-title', 'Users')
@push('styles')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ route('users.getPhoto', ['id' => $user->id ]) }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Name</label>
            </div>
            <div class="col-md-8">
                {{ $user->name }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Email</label>
            </div>
            <div class="col-md-8">
                {{ $user->email }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Location</label>
            </div>
            <div class="col-md-8">
                {{ $user->location }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Time Zone</label>
            </div>
            <div class="col-md-8">
                {{ $user->time_zone }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Age</label>
            </div>
            <div class="col-md-8">
                {{ $user->age }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Occupation</label>
            </div>
            <div class="col-md-8">
                {{ $user->occupation }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('users.profileEdit', ['id' => $user->id ])}}" class="btn btn-default edit-button">Edit</a>
    </div>
</div>
<!-- Modal -->
<div id="modal-form" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script>
$(".edit-button").click(function (e) {
    e.preventDefault();
    $.get($(this).attr('href'))
    .done(function (data) {
        $(".modal-content").html(data);
        $("#modal-form").modal('show');
    });
});
$(document).on('change','#profile-picture-input', function(){
    console.log("hello");
  var input = this;
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#profile-picture-preview').attr("src", e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
});
</script>
@endpush
