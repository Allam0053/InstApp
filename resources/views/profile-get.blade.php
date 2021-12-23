@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
'active' => "profile",
'form' => ""
])
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden mb-2">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ asset('storage') . '/' . $user->avatar }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $user->name }}#{{ $user->id }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            Join the party {{ $user->created_at }}
          </p>
        </div>
      </div>
      <div class="col-auto my-auto">
        <!-- TODO -->
        <!-- Do not follow if already followed -->
        <!-- Or change to unfollow if already followed -->
        @if($isFollow)
        <form action="{{route('follow.create')}}" method="post">
          @csrf
          <input type="hidden" name="id_user" value="{{$user->id}}" />
          <input type="submit" name="follow" value="follow" />
        </form>
        @else
        <form action="{{route('follow.delete')}}" method="post">
          @csrf
          <input type="hidden" name="id_user" value="{{$user->id}}" />
          <input type="submit" name="unfollow" value="unfollow" />
        </form>
        @endif
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
              <a href="javascript:;">
                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span class="sr-only">Edit Profile</span>
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <p class="text-sm">
            {{ $user->bio }}
          </p>
          <hr class="horizontal gray-light my-4">
          <ul class="list-group">
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{ $user->mobile }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{ $user->city }}</li>

          </ul>
        </div>
      </div>
    </div>
  </div>

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