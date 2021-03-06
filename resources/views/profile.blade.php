
@extends('layouts.frontend.app')

@section('title', 'Profile')
 
@push('css')
    <link href="{{ asset('assets/Frontend/css/profile/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Frontend/css/profile/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_post{
            color:#0275d8;
        }
    </style>
@endpush

@section('content')
<section class="blog-area section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-md-6 col-sm-12">
                            <div class="card h-100">
                                <div class="single-post post-style-1">
                                    <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'. $post->image) }}" alt="Blog Image"></div>
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="Profile Image"></a>
                                    <div class="blog-info">
                                        <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>
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
                </div>
                {{ $posts->links() }}
            </div>

            <div class="col-lg-4 col-md-12 ">
                <div class="single-post info-area ">
                    <div class="about-area">
                        <h4 class="title text-uppercase"><b>Author Profile</b></h4>
                        <b>{{ $author->name }}</b>
                        <br>
                           <p align="justify"><em> &ldquo; - {{ $author->about }}</em> &rdquo;</p> 
                        <br>
                        <b>Author since: {{ $author->created_at->toDateString() }}</b>
                        <br>
                        <b>Total Posts: {{ $author->posts->count() }}</b>
                    </div>
                </div>
            </div>
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