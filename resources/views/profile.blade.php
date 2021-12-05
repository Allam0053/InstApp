@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
'active' => "profile",
'form' => ""
])
@endsection

@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
  {{Session::get('success')}}
</div>
@elseif(Session::has('forbidden'))
<div class="alert alert-danger">
  {{Session::get('forbidden')}}
</div>
@elseif(Session::has('message'))
<div class="alert alert-warning">
  {{Session::get('message')}}
</div>
@endif

<div class="container-fluid">
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden mb-2">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ asset('storage') . '/' . Auth::user()->avatar }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ Auth::user()->name }}#{{ Auth::user()->id }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            Join the party {{ Auth::user()->created_at }}
          </p>
        </div>
      </div>

    </div>
  </div>


  <div class="row d-flex justify-content-center py-4">
    <div class="col-12 col-xl-6">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-8 d-flex align-items-center">
              <h6 class="mb-0">Profile Information</h6>
            </div>
            <div class="col-md-4 text-end">
              <button type="button" class="btn bg-gradient-primary text-center p-auto" id="btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editProfile">
                <i class="fas fa-user-edit text-secondary text-sm text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span class="sr-only">Edit Profile</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <p class="text-sm">
            {{ Auth::user()->bio }}
          </p>
          <hr class="horizontal gray-light my-1">
          <ul class="list-group">
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{ Auth::user()->mobile }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{ Auth::user()->city }}</li>

          </ul>
        </div>
      </div>
    </div>
  </div>

  @if(Auth::check())
  <!-- Modal Edit Profile -->
  <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}" id="profile-form">
          @method('put')
          <div class="modal-body">
            @csrf
            {{-- <input type="hidden" value="{{ Auth::guard('web')->user()->id }}" name="id"> --}}
            <div class="mb-3">
              <input type="text" class="form-control form-control-lg mb-1" placeholder="Name" aria-label="Name" id="input-name" value="{{old('name') ? old('name') : Auth::user()->name }}" autofocus name="name">
              <input type="text" class="form-control form-control-lg mb-1" placeholder="Bio" aria-label="Bio" id="input-bio" value="{{old('bio') ? old('bio') : Auth::user()->bio }}" autofocus name="bio">
              <input type="text" class="form-control form-control-lg mb-1" placeholder="Mobile" aria-label="Mobile" id="input-mobile" value="{{old('mobile') ? old('mobile') : Auth::user()->mobile }}" autofocus name="mobile">
              <input type="text" class="form-control form-control-lg mb-1" placeholder="City" aria-label="City" id="input-city" value="{{old('city') ? old('city') : Auth::user()->city }}" autofocus name="city">
              <input type="file" class="form-control form-control-lg mb-1" placeholder="City" aria-label="City" id="input-avatar" value="{{old('avatar') ? old('avatar') : Auth::user()->avatar }}" autofocus name="avatar">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif

  <div class="row pt-4">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Postingan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">id</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Foto</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Caption</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td>
                    <h6 class="mb-0 text-sm">{{ $post->id }}</h6>
                  </td>
                  <td>
                    <img src="{{ $post->foto }}" class="avatar avatar-sm me-3" alt="user1">
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $post->caption }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('post.view', ['id' => $post->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      <span class="badge badge-sm bg-gradient-success">Show</span>
                    </a>
                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      <span class="badge badge-sm bg-gradient-warning">Edit</span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection