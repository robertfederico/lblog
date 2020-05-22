
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="{{ route('main') }}"><img src="{{ asset('assets/images/easylogo.png') }}" alt="Logo Image"></a>
						<p class="copyright">Blog @ 2020. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
						<ul class="icons">
							<li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							@foreach ($categories as $category)
							<li>
								<a 
									href="{{ route('category.post', $category->slug) }}">{{ $category->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">
						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="alert d-none" id="successMsg"></div>
						<div class="input-area">
							<form id="subsciber-form" action="">
								<input class="email-input" type="email" id="email" name="email" placeholder="Enter your email">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>