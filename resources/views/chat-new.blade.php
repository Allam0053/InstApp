@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
'active' => "dashboard",
'form' => ""
])
@endsection

@section('content')
<div class="container col-12 col-lg-8">

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

  <form enctype="multipart/form-data" action="{{ route('chat.create.post') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ Auth::guard('web')->user()->id }}">
    <hr class="my-4" />
    <h6 class="heading-small text-muted mb-4">New Chat</h6>
    <div class="pl-lg-4">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label class="form-control-label" for="input-username">Member (input id)</label>
            <input type="text" id="input-username" class="form-control" name="member">
          </div>
        </div>
      </div>
    </div>
    <div class="pl-pg-12">
      <div class="form-group">
        <div class="row" style="justify-content: center;">
          <button class="btn btn-success" type="submit">Buat Chat</button>
        </div>
      </div>
      <div>
  </form>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>User table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $user->id }}</p>
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