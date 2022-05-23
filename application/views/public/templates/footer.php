	<footer class="entire_footer_area">
		<div class="footer_top_area">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-sm-6 col-xs-12">
						<div class="footer_top_left">
							<a href=""><i class="fa fa-envelope"></i>signup newsletter</a>
							<input type="text" placeholder=""/>
							<input type="submit" value="submit"/>
						</div>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<div class="footer_top_right">
							<ul id="payment">
								<li><a href="">
									<img src="<?= base_url('assets/public/');?>images/pay1.png" alt="" />
								</a></li>
								<li><a href="">
									<img src="<?= base_url('assets/public/');?>images/pay2.png" alt="" />
								</a></li>
								<li><a href="">
									<img src="<?= base_url('assets/public/');?>images/pay3.png" alt="" />
								</a></li>
								<li><a href="">
									<img src="<?= base_url('assets/public/');?>images/pay4.png" alt="" />
								</a></li>
								<li><a href="">
									<img src="<?= base_url('assets/public/');?>images/pay5.png" alt="" />
								</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_area">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="single_widget">
							<h5>information</h5>
							<div class="wid_line"></div>
							<ul class="widget_nav">
								<li><a href="">New Products</a></li>
								<li><a href="">Top Seller</a></li>
								<li><a href="">Special</a></li>
								<li><a href="">Manufactures</a></li>
								<li><a href="">Suppliers</a></li>
								<li><a href="">Our Stores</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="single_widget">
							<h5>my account</h5>
							<div class="wid_line"></div>
							<ul class="widget_nav">
								<li><a href="">My Account</a></li>
								<li><a href="">Personal Information</a></li>
								<li><a href="">Addresses</a></li>
								<li><a href="">Discounts</a></li>
								<li><a href="">Order History</a></li>
								<li><a href="">Your Vouchers</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="single_widget">
							<h5>customer service</h5>
							<div class="wid_line"></div>
							<ul class="widget_nav">
								<li><a href="">Help & Contact</a></li>
								<li><a href="">Shipping & Taxes</a></li>
								<li><a href="">Return Policy</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Affliates</a></li>
								<li><a href="">Legal Notice</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="single_widget">
							<h5>contact Info</h5>
							<div class="wid_line"></div>
							<address>
								Address : 44 New Design Street,<br>
								Melbourne 005<br>
								Phone : (01) 800 433 633<br>
								Email : info@Example.com
							</address>
							<ul class="wid_social">
								<li><a class="fa fa-facebook" href=""></a></li>
								<li><a class="fa fa-twitter" href=""></a></li>
								<li><a class="fa fa-google-plus" href=""></a></li>
								<li><a class="fa fa-pinterest" href=""></a></li>
								<li><a class="fa fa-rss" href=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_bottom_area">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="footer_bottom">
							<p>Copyright &copy; 2015 <a href="index.html">Men’swaer</a>. All Rights Reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<!-- JS Files -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	  $(function() {
		$( "#slider-range" ).slider({
		  range: true,
		  min: 150,
		  max: 1500,
		  values: [ 520, 1100 ],
		  slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		  }
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	  });
	  </script>
	  
    <script src="<?= base_url('assets/public/');?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/public/');?>js/lightbox.min.js"></script>
    <script src="<?= base_url('assets/public/');?>js/jquery.elevatezoom.js"></script>
    <script src="<?= base_url('assets/public/');?>js/jquery.bxslider.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		 $('.slider8').bxSlider({
			mode: 'vertical',
			slideWidth: 300,
			minSlides: 3,
			slideMargin: 10
		  });
		 $('.slider9').bxSlider({
			mode: 'vertical',
			slideWidth: 300,
			minSlides: 3,
			slideMargin: 10
		  });
		 $('.slider10').bxSlider({
			mode: 'vertical',
			slideWidth: 300,
			minSlides: 3,
			slideMargin: 10
		  });
		});
	</script>
    <script src="<?= base_url('assets/public/');?>js/bootstrap-select.min.js"></script>
	<script src="<?= base_url('assets/public/');?>js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
	<script src="<?= base_url('assets/public/');?>js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="<?= base_url('assets/public/');?>js/rs-plugin/rs.home.js"></script>
    <script src="<?= base_url('assets/public/');?>js/bootstrap.min.js"></script>
	<!--Opacity & Other IE fix for older browser-->
	<!--[if lte IE 8]>
		<script type="text/javascript" src="js/ie-opacity-polyfill.js"></script>
	<![endif]-->
    <script src="<?= base_url('assets/public/');?>js/main.js"></script>
  </body>
</html>