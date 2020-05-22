@extends('layouts.backend.app')

@section('title', 'Show Post Details  ')
    
@push('css')
  @endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">Back</a>

        @if ($post->is_approved == false)
            <button type="button" class="btn btn-success waves-effect pull-right"
               onclick="onApprove({{ $post->id }})" >
                <i class="material-icons">done</i><span> Approve</span>
            </button>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i><span> Approved</span>
            </button>
        @endif

        <form id="approval-form" action="{{ route('admin.post.approve', $post->id) }}" 
            method="POST" style="display: none;">
            @csrf
            @method('PUT')
        </form>

        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-uppercase"> {{ $post->title }}</h2>
                        <small>
                            Posted By 
                            <strong>
                                <a href="#">{{ $post->user->name }}</a>
                            </strong>
                            on {{ $post->created_at->toFormattedDateString() }}
                        </small>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2 class="text-uppercase"> Categories</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $postCategory)
                            <span class="label bg-cyan">{{ $postCategory->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card"> 
                    <div class="header bg-green">
                        <h2 class="text-uppercase"> Tags</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $postTag)
                            <span class="label bg-green">{{ $postTag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2 class="text-uppercase"> Featured Image</h2>
                    </div>
                    <div class="body">
                            <img src="{{Storage::disk('public')->url('post/' . $post->image)}}" 
                                class="img-responsive thumbnail" alt="post image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

    function onApprove(id){

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You want to approve this post.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('approval-form').submit();
        } 
        })
    }
</script>
@endpush