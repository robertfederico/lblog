@extends('layouts.backend.app')

@section('title', 'Show Post Details  ')
    
@push('css')
  @endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <a href="{{ route('author.post.index') }}" class="btn btn-danger waves-effect">Back</a>

        @if ($post->is_approved == false)
            <button type="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i><span> Approve</span>
            </button>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i><span> Approved</span>
            </button>
        @endif
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
@endpush