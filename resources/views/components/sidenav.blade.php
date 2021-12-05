<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/instapp-logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">InstApp</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item" id="home">
        <a class="nav-link" href="{{ route('home') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            @include('icons.box-3d')
          </div>
          <span class="nav-link-text ms-1">HOME</span>
        </a>
      </li>
      <li class="nav-item" id="post">
        <a class="nav-link" data-bs-toggle="collapse" href="#dashboardsExamples" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
            @include('icons.shop')
          </div>
          <span class="nav-link-text ms-1">Post</span>
        </a>
        <div class="collapse" id="dashboardsExamples">
          <ul class="nav ms-4 ps-3">
            <li class="nav-item">
              <a class="nav-link " href="{{route('post.create.get')}}">
                <span class="sidenav-mini-icon"> New </span>
                <span class="sidenav-normal"> New </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('post.view.my')}}">
                <span class="sidenav-mini-icon"> My </span>
                <span class="sidenav-normal"> My Post </span>
              </a>
            </li>

          </ul>
        </div>
      </li>

      <li class="nav-item" id="chat">
        <a class="nav-link" href="/chat">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-dark" aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Chat</span>
        </a>
      </li>

      @if(Auth::guard('web')->check())
      <li class="nav-item">
        @php
        $profile = '';
        @endphp
        @if ($active == "profile")
        @php
        $profile = 'active';
        @endphp
        @endif
        <a class="nav-link {{$profile}}" href="{{ route('profile') }}">
          @if(Auth::user()->avatar)
          <img src="{{ asset('storage') . '/' . Auth::user()->avatar }}" class="avatar avatar-sm me-3" alt="user1">
          @else
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-dark" aria-hidden="true"></i>
          </div>
          @endif
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>
      <li class="nav-item" id="saved">
        <a class="nav-link" href="{{ route('saved.view') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-save text-dark" aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Saved</span>
        </a>
      </li>
      <li class="nav-item">
        <span class="nav-link-text ms-1">
          <form role="nav-link" method="POST" action="{{ route('logout') }}" class="dropdown-item">
            @csrf
            <span class="nav-link-text ms-1">
              <i class="ni ni-user-run"></i>
              <input class="nav-link-text ms-1 text-sm" type="submit" name="send" value="Log out" style="border:none; background:none;">
            </span>
          </form>
        </span>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link " href="{{ route('login') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-dark" aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Login</span>
        </a>
      </li>
      @endif

    </ul>
  </div>
</aside>