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

    @foreach($posts as $post)
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
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-md-3 mx-auto">
      {{ $posts->links() }}
    </div>

  </div>
</div>
@endsection