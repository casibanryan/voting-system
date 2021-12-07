<?php

	session_start();
    $student_id = $_SESSION['student_id'];
    $surname = $_SESSION['surname'];
	$type = $_SESSION['type'];
    if(!$student_id && !$surname){
        header("location:login.html");
    }

?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CPC Online Voting</title>
	<!-- FONTS -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|PT+Sans:400,400italic,700' rel='stylesheet' type='text/css'>

	<!-- STYLESHEET -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
	<link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body class="home" data-spy="scroll" data-target=".politics-navbar">

	<!-- SITE HEADER -->
	<header class="site-header">
		<div class="top-bar">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 trending-topics hidden-sm hidden-xs">
						<h4>Trending</h4>
						<ul class="list-inline">
							<li><a href="#">Cordova Public College Online Election</a></li>
						</ul>
					</div> <!-- .col-md-6 ends -->
					<div class="col-md-4 social-links">
						<ul class="list-inline">
							<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
							<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
							<li><a href="#"><i class="icon ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="icon ion-social-linkedin-outline"></i></a></li>
						</ul>
					</div> <!-- .col-md-6 ends -->
					<div class="col-md-2">
					<li class="list-inline">
						<?php if($type == 1) { ?> 
						<a href="admin.php" class="btn btn-primary">Dashboard </a>
						<?php } ?>
						<a href="logout.php" class="btn btn-primary">Logout </a>
					</li>
					</div>
				</div> <!-- .row ends -->
			</div> <!-- .container-fluid ends -->
		</div> <!-- .top-bar ends -->

		<nav class="navbar navbar-default politics-navbar">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#politics-navbar-real" area-expanded="false">

						<span class="sr-only">Toggle Navigation</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>

					</button>

					<a class="navbar-brand" href="#">Politics</a>
				</div> <!-- .navbar-header ends -->
				<div class="collapse navbar-collapse" id="politics-navbar-real">
					<ul class="nav navbar-nav navbar-left">
						<li class="active"><a data-scroll href="index.php">Home <span class="sr-only">(current)</span></a></li>
						<li><a href="vote.php">Vote</a></li>
					</ul> <!-- .nav navbar-nav ends -->

					<ul class="nav navbar-nav navbar-right">

						<li><a data-scroll href="#featured-event">Events</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul> <!-- .nav navbar-nav ends -->
				</div> <!-- .collapse navbar-collapse ends -->
			</div> <!-- .container ends -->
		</nav> <!-- .navbar navbar-default ends -->

	</header> <!-- .site-header ends -->

	<!-- SLIDER -->

	<section class="politics-slider" id="politics-slider">
		<div class="carousel slide politics-carousel" id="politics-carousel" data-ride="carousel">

			<ol class="carousel-indicators">
				<li data-target="politics-carousel" data-slide-to="0" class="active"></li>
				<li data-target="politics-carousel" data-slide-to="1"></li>
			</ol> <!-- .carousel-indicators ends -->

			<div class="carousel-inner">
				<div class="item active">
					<img class="carousel-bg" src="assets/images/cpc-1.jpg" alt="carousel image">
					<div class="carousel-caption">
						<div class="caption-image">
							<img data-animation="animated fadeInRight" src="assets/images/vote.png" alt="vote-girl">
						</div> <!-- .caption-image ends -->
						<div class="caption-content">
							<h1><small data-animation="animated fadeInDown">Wind of changes</small>  <span data-animation="animated fadeInRight">News days are comming</span></h1>
							<p data-animation="animated fadeInUp">
								We all hear that voting is important, but it can be easy to feel discouraged and forget the true significance of your participation in elections.
							</p>
							<button class="btn btn-main btn-lg" data-animation="animated fadeInUp"><b>Vote Now</b></button>
						</div> <!-- .caption-content ends -->

					</div> <!-- .carousel-caption ends -->
				</div> <!-- .item active ends -->
				<div class="item">
					<img class="carousel-bg" src="assets/images/cpc-3.jpg" alt="carousel image">
					<div class="carousel-caption">

						<div class="caption-content">
							<h1><small data-animation="animated fadeInDown">A beautiful Day</small> <span data-animation="animated fadeInDown">The Judgement day</span></h1>
							<p data-animation="animated fadeInUp">
								Voting is essential because it pushes a country's democracy to function in a fair and equal way. The whole point of a democracy is to ensure that everyone has their chance to elect a candidate and vote for policies that represent and benefit their communities.
							</p><a href="#intro-section">
							<button class="btn btn-main btn-lg" data-animation="animated fadeInUp">Learn More</button>
						</a>
						</div> <!-- .caption-content ends -->

					</div> <!-- .carousel-caption ends -->
				</div> <!-- .item active ends -->
			</div> <!-- .carousel-inner ends -->

			<!-- CONTROLS -->
			<a class="left carousel-control" href="#politics-carousel" role="button" data-slide="prev">
				<span class="icon ion-ios-arrow-back" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a> <!-- .left carousel-control ends -->

			<a class="right carousel-control" href="#politics-carousel" role="button" data-slide="next">
				<span class="icon ion-ios-arrow-forward" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a> <!-- .right carousel-control ends -->

		</div> <!-- .carousel slide ends -->
	</section> <!-- .politics-slider ends -->

	<!-- INTRO SECTION -->

	<section class="intro-section section-block bg-secondary" id="intro-section">
		<div class="container">
			<div class="section-title-block">
				<h2>Welcome <span>to the world of Politics</span></h2>
				<div class="title-style">
					<i class="icon ion-ios-star"></i>
					<i class="icon ion-ios-star"></i>
					<i class="icon ion-ios-star"></i>
				</div>
				<p class="text-white">
					As election season approaches quickly, it is important for all of us to make our voice heard. As a student who wants change, it is important for other people my age to realize the importance of voting as well.
					We can do better!  Every vote counts, whether you think so or not.
				</p>
			</div> <!-- .section-title-block ends -->

			<div class="row section-content">
				<div class="col-lg-3">
					<div class="content-wrapper">
						<div class="icon-block"><i class="icon ion-ios-world-outline"></i></div>
						<h3><a href="#">Our Mandate</a></h3>
						<p class="text-white">
							Another responsibility of citizens is voting. The law does not require citizens to vote, but voting is a very important part of any democracy. By voting, citizens are participating in the democratic process. Citizens vote for leaders to represent them and their ideas, and the leaders support the citizens' interests.
						</p>
					</div> <!-- .content-wrapper ends -->
				</div> <!-- col-lg-3 ends -->

				<div class="col-lg-3">
					<div class="content-wrapper">
						<div class="icon-block"><i class="icon ion-ios-chatboxes-outline"></i></div>
						<h3><a href="#">Election Campaign</a></h3>
						<p class="text-white">
							All campaign material must be approved by the SGA Election Commissioner and the Office of Co- Curricular Programs, who will ensure content meets campus standards
Candidates are allowed a maximum of six posters campus-wide, and seventy flyers
A sheet counts as a poster. Sheets must be no larger than twin size.



						</p>
					</div> <!-- .content-wrapper ends -->
				</div> <!-- col-lg-3 ends -->

				<div class="col-lg-3">
					<div class="content-wrapper">
						<div class="icon-block"><i class="icon ion-ios-personadd-outline"></i></div>
						<h3><a href="#">Get involved</a></h3>
						<p class="text-white">
							Conducted to have a free and open discussion about who is a better representative 
							and in turn, which party will make a better government. In India, Election Campaigns take place for a two-week
							 period between the announcement of the final list of candidates and the date of polling.
						</p>
					</div> <!-- .content-wrapper ends -->
				</div> <!-- col-lg-3 ends -->

				<div class="col-lg-3">
					<div class="content-wrapper">
						<div class="icon-block"><i class="icon ion-ios-color-wand-outline"></i></div>
						<h3><a href="#">Make Change</a></h3>
						<p class="text-white">
						When we vote. we take back our power to choose, to speak up, and to stand with those who support us and each other.
						then there's no such things as a vote that doesn't matter it all matters.
						also remember it that the ballot is stronger than the bullet.
						lets make our school better for the future.

						</p>
					</div> <!-- .content-wrapper ends -->
				</div> <!-- col-lg-3 ends -->
			</div> <!-- .row section-content ends -->
		</div> <!-- .container ends -->
	</section> <!-- .intro-section ends -->



	<!-- FEATURED CONTENT -->

	<section class="featured-content" id="featured-content">
		<div class="container">
			<div class="content-block">
				<h2>Student needs a leader and you need me!</h2>
				<p>
					if we don't vote we are ignoring history and giving away the future.
		Honor the past,<br>
		Support the future
				</p>
				<button class="btn btn-main btn-normal">Vote Now</button>
			</div> <!-- .content-block ends -->
			<div class="image-block">
				<img class="img-responsive" src="assets/images/content.png" alt="man image 2">
			</div> <!-- .image-block ends -->
		</div> <!-- .container ends -->
	</section> <!-- .featured-content ends -->


	<!-- QUICK LINKS BLOCK -->

	<section class="quick-links-block" id="quick-links-block">
		<div class="container-fluid">
			<div class="row section-content">
				<div class="col-md-4 mission-block">
					<div class="content-wrapper">
						<i class="icon ion-ios-paw-outline"></i>
						<h3>Our Mission</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.
						</p>
						<a class="read-more-link" href="#">Learn More</a>
					</div> <!-- .content-block ends -->
				</div> <!-- col-md-4 ends -->

				<div class="col-md-4 vision-block">
					<div class="content-wrapper">
						<i class="icon ion-ios-eye-outline"></i>
						<h3>Our Vision</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.
						</p>
						<a class="read-more-link" href="#">Learn More</a>
					</div> <!-- .content-block ends -->
				</div> <!-- col-md-4 ends -->

				<div class="col-md-4 issue-block">
					<div class="content-wrapper">
						<i class="icon ion-ios-paper-outline"></i>
						<h3>Our Goal</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.
						</p>
						<a class="read-more-link" href="#">Learn More</a>
					</div> <!-- .content-block ends -->
				</div> <!-- col-md-4 ends -->
			</div> <!-- .row section-content ends -->
		</div> <!-- .container-fluid ends -->
	</section> <!-- .quick-links-block ends -->



	<!-- FEATURED EVENT  -->

	<section class="featured-event" id="featured-event">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 event-block">
					<h2>Upcomming Election</h2>

					<ul class="event-counting">
						<li>
							<h3><span class="days">239</span> <small>Days</small></h3>
						</li>
						<li>
							<h3><span class="hours">23</span> <small>Hours</small></h3>
						</li>
						<li>
							<h3><span class="minutes">9</span> <small>Minutes</small></h3>
						</li>
						<li>
							<h3><span class="seconds">49</span> <small>Seconds</small></h3>
						</li>
					</ul>
				</div> <!-- .col-lg-8 ends -->

				<div class="col-lg-4 facts-block">
					<ul class="facts-content">
						<li>
							<div class="icon-block"><i class="icon ion-ios-people-outline"></i></div>
							<h3><strong class="timer" data-from="100000" data-to="232343" data-speed="5000">232,343</strong> <span>Volunteers</span></h3>
						</li>

						<li>
							<div class="icon-block"><i class="icon ion-ios-briefcase-outline"></i></div>
							<h3><strong class="timer" data-from="10000" data-to="32343" data-speed="5000">32,343</strong> <span>Projects</span></h3>
						</li>

						<li>
							<div class="icon-block"><i class="icon ion-ios-heart-outline"></i></div>
							<h3><strong class="timer" data-from="1000" data-to="343" data-speed="5000">343</strong> <span>Awards</span></h3>
						</li>
					</ul>
				</div> <!-- .col-lg-4 ends -->
			</div> <!-- .row ends -->

		</div> <!-- .container-fluid ends -->
	</section> <!-- .featured-event ends -->


	

	<!-- EMAIL SUBSCRIPTION -->

	<section class="email-subscription" id="email-subscription">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="icon-block"><i class="icon ion-ios-email-outline"></i></div>
					<div class="content-block">
						<h2>Get latest news</h2>
						<p>Subscribe to our newsletter</p>
					</div> <!-- .content-block ends -->
				</div> <!-- .col-md-6 ends -->
				<div class="col-md-6">
					<form class="subscription-form" id="subscription-form">
						<div class="row no-padding">
							<div class="col-sm-8">
								<div class="form-group">
									<label class="sr-only" for="email">Email:</label>
									<input class="form-control" type="email" id="email" placeholder="Your email here">

								</div> <!-- .form-group ends -->
							</div> <!-- .col-sm-8 ends -->
							<div class="col-sm-4">
								<button class="btn btn-main">Submit</button>
							</div> <!-- .col-sm-4 ends -->
						</div> <!-- .row ends -->

					</form> <!-- .subscrition-form ends -->
				</div> <!-- .form-block ends -->
			</div> <!-- .row ends -->
		</div> <!-- .container ends -->
	</section> <!-- .email-subscriptin ends -->


	<!-- MAIN FOOTER -->
	<footer class="main-footer" id="main-footer">
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 copyright-block">
                    <p>All rights reserved &copy; 2021 -2022 <a href="#">Cordova Public College</a></p>
                </div> <!-- .col-md-4 ends -->
                <div class="col-lg-4 social-block">
                    <ul class="social-icon-list list-inline">
                        <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-dribbble"></i></a></li>
                    </ul>
                </div> <!-- .col-lg-4 ends -->
                <div class="col-lg-4 extra-links-block">
                    <ul class="extra-links list-inline">
                        <li><a href="#">Terms &amp; Condition</a></li>
                        <li><a href="#">Legal</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul> <!-- .extra-links ends -->
                </div> <!-- .col-lg-4 ends -->
            </div> <!-- .row ends -->
        </div> <!-- .container-fluid ends -->
    </div> <!-- .bottom-bar ends -->
</footer> 
<!-- .main-fooer ends -->


	<!-- SCRIPTS -->
	<script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="assets/js/slick.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.downCount.js"></script>
	<script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
	<script type="text/javascript" src="assets/js/smooth-scroll.min.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>