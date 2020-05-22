
@extends('layouts.frontend.app')

@section('title')
    {{ $post->title }}
@endsection
 
@push('css')
    <link href="{{ asset('assets/Frontend/css/single-post/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/Frontend/css/single-post/responsive.css') }}" rel="stylesheet">
       <style>
        .favorite_post{
            color:#0275d8;
        }

        .header-bg{
            height: 50%;
            width: 100%;
            background-image: url({{ Storage::disk('public')->url('post/'.$post->image) }});
            background-size: cover;
            object-fit:contain;
        }
    </style>
@endpush

@section('content')
	<div class="header-bg">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b> {{ $post->title }}</b></h1>
		</div>
	</div>
	<section class="post-area section">
		<div class="container">
            @if (session('successMsg'))
                <div class="alert alert-success mt-3 alert-message" role="alert" id="alert-message">
                    {{ session('successMsg') }}
                </div>  
            @endif
			<div class="row">
				<div class="col-lg-8 col-md-12 no-right-padding">
					<div class="main-post">
						<div class="blog-post-inner">
							<div class="post-info">
								<div class="left-area">
									<a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
										<img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="Profile Image">
									</a>
								</div>

								<div class="middle-area">
									<a class="name" href="{{ route('author.profile', $post->user->username) }}"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">on {{ $post->created_at->diffforHumans() }}</h6>
								</div>

							</div><!-- post-info -->
							<h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>
							<p class="para">
                                {!! html_entity_decode($post->body) !!}
                            </p>
							<ul class="tags">
                                @foreach ($post->tags as $tag)
								    <li><a href="{{ route('tag.post', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
							</ul>
						</div>

						<div class="post-icons-area">
							<ul class="post-icons">
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

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12 no-left-padding">
					<div class="single-post info-area">
						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p class="text-justify">{{ $post->user->about }}</p>
						</div>
						<div class="tag-area">

							<h4 class="title"><b>CATEGORIES</b></h4>
							<ul>
                                @foreach ($post->categories as $caregory)
								<li>
									<a 
										href="{{ route('category.post', $caregory->slug) }}">{{ $caregory->name }}
									</a>
								</li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>>

	<section class="recomended-area section">
		<div class="container">
			<div class="row">
                @foreach ($randomPosts as $randomPost)
                <div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">
                            <div class="blog-image">
                                <img src="{{ Storage::disk('public')->url('post/'. $randomPost->image) }}" alt="Blog Image">
                            </div>
							<a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
                                <img src="{{ Storage::disk('public')->url('profile/'. $randomPost->user->image) }}" alt="Profile Image">
                            </a>
							<div class="blog-info">
								<h4 class="title">
                                    <a href="{{ route('post.details', $randomPost->slug) }}"><b>{{ $randomPost->title }}</b></a></h4>
								<ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="#" onclick="favoritePost()"><i class="ion-heart"></i> 
                                                {{ $randomPost->favorite_to_users->count() }}
                                            </a>
                                        @else
                                            <a href="javascript::void(0)"
                                                onclick="document.getElementById('fav-form-{{ $randomPost->id }}').submit();"
                                                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id' , $randomPost->id)->count() == 0 ? 'favorite_post' : '' }}"
                                                >
                                                <i class="ion-heart"></i> 
                                                {{ $randomPost->favorite_to_users->count() }}
                                            </a>
                                            <form id="fav-form-{{ $randomPost->id }}" action="{{ route('post.favorite', $randomPost->id) }}" 
                                                method="post" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>{{ $randomPost->comments->count() }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $randomPost->view_count }}</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
                @endforeach
			</div>
		</div>
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">
				<div class="col-lg-8 col-md-12">
					@if(session('success_Msg'))
						<div class="alert alert-success alert-message" role="alert">
							{{ session('success_Msg') }}
						</div>
					@endif
					@error('comment')
						<div class="alert alert-danger" role="alert"> 
							{{ $message }}
						</div>
					@enderror
					<div class="comment-form">
						@guest
							<p class="text-danger">Only authenticated users can post a comment. </p>
							<a class="btn btn-primary waves-effect" href="{{ route('login') }}">Login</a>
						@else
						<form method="post" action="{{ route('comment.store', $post->id) }}">
							@csrf
							<div class="row">
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment">
									</textarea >
								</div>
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div>
							</div>
						</form>
						@endguest
					</div>

					<h4><b>COMMENTS ({{ $post->comments->count() }}) </b></h4>

					@if($post->comments->count() > 0)


					@foreach($post->comments as $comment)
					<div class="commnets-area">
						<div class="comment">
							<div class="post-info">
								<div class="left-area">
									<a class="avatar" href="#">
										<img src="{{ Storage::disk('public')->url('profile/'. $comment->user->image) }}" alt="Profile Image">
									</a>
								</div>
								<div class="middle-area">
									<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
									<h6 class="date">on {{ $comment->created_at->diffforHumans() }}</h6>
								</div>
							</div>
							<p>{{ $comment->comment }}</p>
						</div>
					</div>
					@endforeach

					<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>
					
					@else
						<div class="commnets-area">
							<p class="text-info">No Comments Yet.</p>
						</div>
					@endif

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
        $( ".alert-message" ).fadeOut( "slow");
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