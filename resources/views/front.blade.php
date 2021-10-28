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

  @if(Session::has('success'))
  <div class="alert alert-success">
      {{Session::get('success')}}
  </div>
  @elseif(Session::has('forbidden'))
  <div class="alert alert-danger">
    {{Session::get('forbidden')}}
  </div>
  @endif

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
              <img class="col-12" src="{{ $post->foto }}" alt="" style="max-width: 500px;">        
            </div>
            <p class="text-sm">
              {{ $post->caption }}
            </p>
            <hr class="horizontal gray-light my-4">
            @if(Auth::check())
            <form method="post" action="{{ route('like') }}">
              @method('put')
              @csrf
              <input type="hidden" name="id_user" value="{{ Auth::guard('web')->user()->id }}">
              <input type="hidden" name="id_post" value="{{ $post->id }}">
              <button style="border: none; background: none;" type="submit"><i class="fas fa-thumbs-up fa-2x"></i>{{ $post->like ? $post->like->count() : 0 }}</button>
            </form>
            @endif
            <hr class="horizontal gray-light my-4">
            <ul class="list-group mb-4">
              <?php $counter = 0; ?>
              @foreach ($post->comment as $comment)
                <li class="border-0 ps-0 pt-0 text-sm row">
                  <div class="col-11 mt-2">
                    <strong class="text-dark">{{ $comment->user->name }}</strong> &nbsp; <div id="isi-{{ $comment->id }}">{{ $comment->isi }}</div> 
                  </div>
                  
                  @if(Auth::check())
                    @if($comment->user->id == Auth::guard('web')->user()->id)
                    <button type="button" class="btn bg-gradient-primary col-1 text-center p-auto" id="btn-edit-comment" data-bs-toggle="modal" data-bs-target="#editkomen" comment="{{ $comment->id }}">
                      <i class="fas fa-edit"></i>
                    </button>
                    @endif
                  @endif
                </li>
                <?php if ($counter++ == 5) break; ?>
              @endforeach
            </ul>
            <div class="row d-flex justify-content-center">
              @if(Auth::check())
              <form class="form col-12" method="post" action="{{ route('comment.create') }}">
                @csrf
                <input type="hidden" name="id_user" value="{{ Auth::guard('web')->user()->id }}">
                <input type="hidden" name="id_post" value="{{ $post->id }}">
                <div class="row d-flex justify-content-end">
                  <input type="text" name="isi" class="form-control col-12" placeholder="Comment..." required style="border: none;">
                  <button type="submit" class="btn btn-primary col-2" style="margin-top: 10px;">Submit</button>
                </div>
              </form>
              @else
                <a href="{{ route('login') }}" class="btn btn-primary col-12" style="margin-top: 10px;">Login</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-md-3 mx-auto">
      {{ $posts->links() }}
    </div>

  </div>
</div>

@if(Auth::check())
<!-- Modal -->
<div class="modal fade" id="editkomen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('comment.update') }}" id="comment-form">
        @method('put')
        <div class="modal-body">
            @csrf
            <input type="hidden" value="{{ Auth::guard('web')->user()->id }}" name="id_user">
            <input type="hidden" name="id_comment" id="input-id-comment">
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Comment..." aria-label="Comment" id="modal-comment" value="{{old('comment')}}" autofocus name="comment"
                    aria-describedby="email-addon">
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
@endsection


@section('script')
	<script>
		const edit_comment = document.querySelectorAll('#btn-edit-comment');
		edit_comment.forEach( btn => { //handler tombol komen
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('comment');
      console.log(id);
      const isi = document.getElementById('isi-' + id);
			const input = document.getElementById('modal-comment');
      const input_id = document.getElementById('input-id-comment');
			input.value = isi.innerText;
      input_id.value = id.toString();
			})
		});
	</script>
@endsection