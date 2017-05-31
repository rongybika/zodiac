<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <!-- Required meta tags always come first -->
    <title>Zodiac</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!--adding bootstrap & jquery-ui css-->
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

    <!--adding style.css-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main-add.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->

    <!--adding jquery js files-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

    <!-- MonthYearPicker-Addon .css and .js -->
    <script type="text/javascript" src="assets/js/lib/datepicker/jquery.ui.datepicker.monthyearpicker.js"></script>
    <link type="text/css" href="assets/js/lib/datepicker/jquery.ui.datepicker.monthyearpicker.css" rel="stylesheet"/>
    
</head>

<body class="landing">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="index.php">Zodiac</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.php">Home</a></li>
											<li><a href="#one">Check</a></li>
											<!--<li><a href="elements.html">About</a></li>
											<li><a href="#">Sign Up</a></li>
											<li><a href="#">Log In</a></li>-->
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Zodiac</h2>
							<p>Check who is<br />
							compatible with you.</p>
							<!--<ul class="actions">
								<li><a href="#" class="button special">Activate</a></li>
							</ul>-->
						</div>
						<a href="#one" class="more scrolly">Try More</a>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style1 special">
						<div class="inner">
<?php
//Check if exist submited date and is not empty
$is_date = isset($_POST['submit']) && !empty($_POST['datepicker']);
?>

<!--Show input date form and show error message if not date in input field after submit-->
<form action="#one" method="post">
    <p>Choose your birthday date: <input type="text" id="datepicker"
                                                     name="datepicker"><span class="message<?php if (isset($_POST['datepicker']) && ($_POST['datepicker'] == null)) echo ' alert'; ?>">Please choose your birthday date</span></p>
    <input name="submit" type="submit" value="Send"/>
</form>
<!--insert datepicker in input form-->
<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
    })
</script>
<?php

//show result if date was sended and is not empty
if ($is_date) {
    //insert functions
    require_once('assets/inc/functions.php');

    $dInputDate = $_POST['datepicker'];
    echo checkZodiacFromDate($dInputDate);
}
?>
</div>
					</section>

				

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Zodiac</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

            <!-- Scripts -->            
            
			<!--<script src="assets/js/jquery.min.js"></script>-->
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
            <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script>
            <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</body>
</html>
