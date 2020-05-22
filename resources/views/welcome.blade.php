
@extends('layouts.frontend.app')

@section('title', 'Main')
 
@push('css')
    <link href="{{ asset('assets/Frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Frontend/css/home/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_post{
            color:#0275d8;
        }
    </style>
@endpush
    
@section('content')
<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach ($categories as $category)
            <div class="swiper-slide">
                <a class="slider-category" href="{{ route('category.post', $category->slug) }}">
                    <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/' . $category->image) }}" alt="Blog Image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>{{ $category->name }}</b></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
          
        </div>
    </div>
</div>

<section class="blog-area section">
    <div class="container">
        @if (session('successMsg'))
            <div class="alert alert-success mt-3" role="alert" id="alert-message">
                {{ session('successMsg') }}
            </div>  
        @endif
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'. $post->image) }}" alt="Blog Image"></div>
                        <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="Profile Image"></a>

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
        <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>
    </div>
</section>

@push('js')
    <script src="{{ asset('assets/Frontend/js/swiper.js') }}/"></script>
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
@endsection