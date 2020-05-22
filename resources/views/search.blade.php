
@extends('layouts.frontend.app')

@section('title')
{{ $query }}
@endsection

@push('css')
    <link href="{{ asset('assets/Frontend/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Frontend/css/category/responsive.css') }}" rel="stylesheet">
       <style>
        .favorite_post{
            color:#0275d8;
        }

        .slider{
            height: 40%;
            width: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $posts->count() }} results found for <u>{{ $query }}</u> </b></h1>
</div>

<section class="blog-area section">
    <div class="container">
        <div class="row">
            @if ($posts->count() > 0)
                
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'. $post->image) }}" alt="Blog Image"></div>
                        <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="Profile Image"></a>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a>
                            </h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                        <a href="#" onclick="favoritePost()"><i class="ion-heart"></i> 
                                            {{ $post->favorite_to_users->count() }}
                                        </a>
                                    @else
                                        <a href="javascript::void(0)"
                                            onclick="document.getElementById('fav-form-{{ $post->id }}').submit();"
                                            class="{{ !Auth::user()->favorite_posts->where('pivot.post_id' , $post->id)->count() == 0 ? 'favorite_post' : '' }}"
                                            >
                                            <i class="ion-heart"></i> 
                                            {{ $post->favorite_to_users->count() }}
                                        </a>
                                        <form id="fav-form-{{ $post->id }}" action="{{ route('post.favorite', $post->id) }}" 
                                            method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="single-post post-style-1">
                        <div class="blog-info">
                            <h4 class="title">
                                <strong>Sorry, No posts found. :(</strong>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('assets/Frontend/js/scripts.js') }}/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    setTimeout(function() {
        $( "#alert-message" ).fadeOut( "slow");
    },3500);

    function favoritePost(id){

        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Ooops...',
            text: "To add to Favorite list. You need to login first",
        })
    }
</script>
@endpush