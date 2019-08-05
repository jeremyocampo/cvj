
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <title>Bootstrap Multiple Item Product Carousel</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
body {
	background: #e2eaef;
	font-family: "Open Sans", sans-serif;
}
h2 {
	color: #000;
	font-size: 26px;
	font-weight: 300;
	text-align: center;
	text-transform: uppercase;
	position: relative;
	margin: 30px 0 60px;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	border-radius: 1px;
	background: #7ac400;
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .item {
	color: #747d89;
	min-height: 325px;
    text-align: center;
	overflow: hidden;
}
.carousel .thumb-wrapper {
	padding: 25px 15px;
	background: #fff;
	border-radius: 6px;
	text-align: center;
	position: relative;
	box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
.carousel .item .img-box {
	height: 120px;
	margin-bottom: 20px;
	width: 100%;
	position: relative;
}
.carousel .item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .item h4 {
	font-size: 18px;
}
.carousel .item h4, .carousel .item p, .carousel .item ul {
	margin-bottom: 5px;
}
.carousel .thumb-content .btn {
	color: #7ac400;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #7ac400;
    padding: 6px 14px;
    margin-top: 5px;
    line-height: 16px;
    border-radius: 20px;
}
.carousel .thumb-content .btn:hover, .carousel .thumb-content .btn:focus {
	color: #fff;
	background: #7ac400;
	box-shadow: none;
}
.carousel .thumb-content .btn i {
	font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.carousel .carousel-control {
	height: 44px;
	width: 40px;
	background: #7ac400;	
    margin: auto 0;
    border-radius: 4px;
	opacity: 0.8;
}
.carousel .carousel-control:hover {
	background: #78bf00;
	opacity: 1;
}
.carousel .carousel-control i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: #fff;
	text-shadow: none;
    font-weight: bold;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}
.carousel .item-price strike {
	opacity: 0.7;
	margin-right: 5px;
}
.carousel .carousel-control.left i {
	margin-left: -2px;
}
.carousel .carousel-control.right i {
	margin-right: -4px;
}
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border-color: transparent;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.carousel .wish-icon {
	position: absolute;
	right: 10px;
	top: 10px;
	z-index: 99;
	cursor: pointer;
	font-size: 16px;
	color: #abb0b8;
}
.carousel .wish-icon .fa-heart {
	color: #ff6161;
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(".wish-icon i").click(function(){
			$(this).toggleClass("fa-heart fa-heart-o");
		});
	});	
</script>

</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Default <b>Packages</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper">
									<div class="thumb-content">
									<h4> Grand Wedding Package A</h4>									
									<p class="totalpax"><b>Minimum 100 pax </b></p>
									<p class="price"> <b>107,000 - 150,000</b></p>
									<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
									<br>
								</div>						
							</div>
						</div>

						<div class="col-sm-3">
							<div class="thumb-wrapper">
									<div class="thumb-content">
									<h4> Grand Wedding Package B</h4>									
									<p class="totalpax"><b>Minimum 100 pax </b></p>
									<p class="price"> <b>107,000 - 150,000</b></p>
									<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
									<br>
								</div>						
							</div>
						</div>

						<div class="col-sm-3">
								<div class="thumb-wrapper">
										<div class="thumb-content">
										<h4> Grand Wedding Package C</h4>									
										<p class="totalpax"><b>Minimum 100 pax </b></p>
										<p class="price"> <b>107,000 - 150,000</b></p>
										<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
									</div>						
								</div>
							</div>

						<div class="col-sm-3">
							<div class="thumb-wrapper">
									<div class="thumb-content">
									<h4> Grand Debut Package A</h4>									
									<p class="totalpax"><b>Minimum 100 pax </b></p>
									<p class="price"> <b>107,000 - 150,000</b></p>
									<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
									<br>
								</div>						
							</div>
						</div>

						<div class="col-sm-3">
								<div class="thumb-wrapper">
										<div class="thumb-content">
										<h4> Grand Debut Package B</h4>									
										<p class="totalpax"><b>Minimum 100 pax </b></p>
										<p class="price"> <b>107,000 - 150,000</b></p>
										<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
										<br>
									</div>						
								</div>
							</div>

						<div class="col-sm-3">
								<div class="thumb-wrapper">
										<div class="thumb-content">
										<h4> Grand Debut Package C</h4>									
										<p class="totalpax"><b>Minimum 100 pax </b></p>
										<p class="price"> <b>107,000 - 150,000</b></p>
										<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
									</div>						
								</div>
							</div>
						
							<div class="col-sm-3">
									<div class="thumb-wrapper">
											<div class="thumb-content">
											<h4> Grand Wedding Package A</h4>									
											<p class="totalpax"><b>Minimum 100 pax </b></p>
											<p class="price"> <b>107,000 - 150,000</b></p>
											<a href="#" id = "viewdetails" class="btn btn-primary">View Details</a>
										</div>						
									</div>
								</div>
							
						
					</div>
				</div>
			</div>


						
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</div>
</body>
</html>                                		                            