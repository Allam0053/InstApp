@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
  'active' => "dashboard",
  'form' => ""
])
@endsection

@section('content')
<div class="container d-flex justify-content-center">
  <div class="col-8 d-flex flex-column justify-content-center">

      <div class="col-12 py-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">{{ $post->user->name }}</h6>
              </div>
              <div class="col-md-4 text-end">
                <a href="javascript:;">
                  <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span class="sr-only">Edit Profile</span>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <div class="col-12 d-flex justify-content-center">
              <img class="" src="{{ $post->foto }}" alt="">        
            </div>
            <p class="text-sm">
              {{ $post->caption }}
            </p>
            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
              <?php $counter = 0; ?>
              @foreach ($post->comment as $comment)
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{ $comment->user }}</strong> &nbsp; {{ $comment->isi }}</li>
                <?php if ($counter++ == 5) break; ?>
              @endforeach
            </ul>
            <div class="row d-flex justify-content-center">
              @if(Auth::check())
              <form class="form col-12" method="post" action="#">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                <input type="hidden" name="question_id" value="{{ $post->id }}">
                <div class="row d-flex justify-content-end">
                  <input type="text" name="answer" class="form-control col-12" placeholder="Comment..." required>
                  <button type="submit" class="btn btn-primary col-2" style="margin-top: 10px;">Submit</button>
                </div>
              </form>
              @else
              <p class="alert alert-warning">Mohon <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#staticBackdroplogin">log in</button> untuk tambah jawaban</p>
              <!-- Modal login -->
              <div class="modal fade" id="staticBackdroplogin" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Login Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!--login-->
                      <form class="form" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" name="email" placeholder="username" required>
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Log In</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>


  </div>
</div>
@endsection