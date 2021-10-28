@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
  'active' => "dashboard",
  'form' => ""
])
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">

  <div class="row flex-row chat">
    <div class="col-lg-4">
      <div class="card bg-secondary">
        <form class="card-header mb-3 w-100">
          <div class="form-group w-100 mb-0">
            <div class="form-group input-group-alternative mb-0 input-group" placeholder="Search contact">
              <!----><!----><!---->
              <input aria-describedby="addon-right addon-left" placeholder="Search contact" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="ni ni-zoom-split-in"></i>
                </span>
              </div>
              <!---->
            </div>
          </div>
        </form>
        <div class="list-group list-group-chat list-group-flush">
          
          @if($user)
          @foreach($user->chat as $chat)
            @if($chat->id == $active)
              <a href="javascript:;" class="list-group-item active bg-gradient-primary">
                <div class="media">
                  <div class="media-body ml-2">
                    <div class="justify-content-between align-items-center">
                      <h6 class="mb-0 text-white"> 
                        @foreach($chat->user as $u)
                          {{ $u->name }},
                        @endforeach
                        <span class="badge badge-success"></span>
                      </h6>
                    </div>
                  </div>
                </div>
              </a>
              @continue
            @endif
            <a href="javascript:;" class="list-group-item">
              <div class="media">
                <img alt="Image" src="img/faces/team-2.jpg" class="avatar shadow">
                <div class="media-body ml-2">
                  <div class="justify-content-between align-items-center">
                    <h6 class="mb-0">Jane Doe</h6>
                    <div>
                      <small class="text-muted">1 hour ago</small>
                    </div>
                  </div>
                  <span class="text-muted text-small col-10 p-0 text-truncate d-block">Computer users and programmers</span>
                </div>
              </div>
            </a>
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card card-plain">
        <div class="card-body">

          @if($active_chat)
          @foreach($active_chat->chat_content as $chat_content)
            @if($chat_content->user->id == $user->id)
              <div class="row justify-content-end text-right mt-2">
                <div class="col-auto">
                  <div class="card bg-gradient-primary text-white">
                    <div class="card-body p-2">
                      <strong class="mb-1"> {{ $chat_content->user->name }} </strong>
                      <p class="mb-1"> {{ $chat_content->content }}
                      <br>
                      </p>
                      <div>
                        <small class="opacity-60"> {{ $chat_content->created_at }} </small><i class="ni ni-check-bold"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <div class="row justify-content-start mt-2">
                <div class="col-auto">
                  <div class="card">
                    <div class="card-body p-2">
                      <strong class="mb-1"> {{ $chat_content->user->name }} </strong>
                      <p class="mb-1"> {{ $chat_content->content }} </p>
                      <div>
                        <small class="opacity-60">
                          <i class="ni ni-check-bold"></i> {{ $chat_content->created_at }}
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
          @endif

        </div>

        <div class="card-footer d-block">
          @if($active_chat)
          <form class="form col-12" method="post" action="{{ route('chatcontent.create.post', ['active' => $active_chat->id]) }}">
              @csrf
              <input type="hidden" name="id_user" value="{{ Auth::guard('web')->user()->id }}">
              <input type="hidden" name="id_chat" value="{{ $active_chat ? $active_chat->id : ''}}">
              <div class="row d-flex justify-content-end">
                  <input type="text" name="content" class="form-control col-12" placeholder="Chat..." required
                      style="border: none;">
                  <button type="submit" class="btn btn-primary col-2" style="margin-top: 10px;">Submit</button>
              </div>
          </form>
          @endif
        </div>


      </div>
    </div>
  </div>





                    
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>
@endsection