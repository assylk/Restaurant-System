<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','restaurantdb');

//Create Connection
$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($link->connect_error){ //if not Connection
die('Connection Failed'.$link->connect_error);//kills the Connection OR terminate execution
}

$sqlbreakfast = "SELECT * FROM menu WHERE item_category = 'Breakfast' ORDER BY item_type; ";
$resultbreakfast = mysqli_query($link, $sqlbreakfast);
$breakfast = mysqli_fetch_all($resultbreakfast, MYSQLI_ASSOC);

$sqllunch = "SELECT * FROM menu WHERE item_category = 'Lunch' ORDER BY item_type; ";
$resultlunch = mysqli_query($link, $sqllunch);
$lunch = mysqli_fetch_all($resultlunch, MYSQLI_ASSOC);

$sqldinner = "SELECT * FROM menu WHERE item_category = 'Dinner' ORDER BY item_type; ";
$resultdinner = mysqli_query($link, $sqldinner);
$dinner = mysqli_fetch_all($resultdinner, MYSQLI_ASSOC);

$sqldessert = "SELECT * FROM menu WHERE item_category = 'Desserts' ORDER BY item_type; ";
$resultdessert = mysqli_query($link, $sqldessert);
$dessert = mysqli_fetch_all($resultdessert, MYSQLI_ASSOC);

$sqlsode = "SELECT * FROM menu WHERE item_category = 'Soda' ORDER BY item_type; ";
$resultsoda = mysqli_query($link, $sqlsode);
$soda = mysqli_fetch_all($resultsoda, MYSQLI_ASSOC);

$sqldrinks = "SELECT * FROM menu WHERE item_category = 'Drinks and Tea' ORDER BY item_type; ";
$resultdrinks = mysqli_query($link, $sqldrinks);
$drinks = mysqli_fetch_all($resultdrinks, MYSQLI_ASSOC);



// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '<div class="user-profile">';
    echo 'Welcome, ' . $_SESSION["member_name"] . '!';
    echo '<a href="../customerProfile/profile.php">Profile</a>';
    echo '</div>';
    
}

session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Taste.it</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./../../css/animate.css">

    <link rel="stylesheet" href="./../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="./../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./../../css/magnific-popup.css">

    <link rel="stylesheet" href="./../../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="./../../css/jquery.timepicker.css">


    <link rel="stylesheet" href="./../../css/flaticon.css">
    <link rel="stylesheet" href="./../../css/style.css">

</head>
<style>
.dropdown-menu-black {
    background-color: rgba(0, 0, 0, 0.7);
    /* Black with 70% opacity */
    border: none;
}
</style>
<body>

    <div class="wrap">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md d-flex align-items-center">
                    <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+56 12 345 678</a> or <span
                            class="mailus">email us:</span> <a href="#">tasteit@gmail.com</a></p>
                </div>
                <div class="col-12 col-md d-flex justify-content-md-end">
                    <p class="mb-0">Mon - Fri / 9:00-21:00, Sat - Sun / 10:00-20:00</p>
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Taste.<span>it</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="../../about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="../../chef.php" class="nav-link">Chef</a></li>
                    <li class="nav-item"><a href="../../menu.php" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="#reservation" class="nav-link">Reservation</a></li>
                    <li class="nav-item"><a href="../../blog.php" class="nav-link">Blog</a></li>
                    <!-- Dropdown for Account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account
                        </a>
                        <div class="dropdown-menu" style="background-color:rgba(0, 0, 0, 0.7)"
                            aria-labelledby="navbarDropdown">
                            <?php

// Get the member_id from the query parameters
$account_id = $_SESSION['account_id'] ?? null; // Change this to the way you obtain the member ID

// Create a query to retrieve the member's information
$query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
$result = mysqli_query($link, $query);

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $account_id != null) {
    $query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
$result = mysqli_query($link, $query);
    // If logged in, show "Logout" link
    // Check if the query was successful
    if ($result) {
        // Fetch the member's information
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $member_name = $row['member_name'];
            $points = $row['points'];
            
            // Calculate VIP status
            $vip_status = ($points >= 1000) ? 'VIP' : 'Regular';
            
            // Define the VIP tooltip text
            $vip_tooltip = ($vip_status === 'Regular') ? ($points < 1000 ? (1000 - $points) . ' points to VIP ' : 'You are eligible for VIP') : '';
            
            // Output the member's information
            echo "<p class='dropdown-item' style='color:white ;font-siz:10px'><a href='../customerLogin/profile.php'>Profile $member_name !</a></p>";
            echo "<p class='dropdown-item' style='color:white'>$points Points </p>";
            echo "<p class='dropdown-item' style='color:white'>$vip_status";
            
            // Add the tooltip only for Regular status
            if ($vip_status === 'Regular') {
                echo " <span class='tooltip'>$vip_tooltip</span>";
            }
            
            echo "</p>";
        } else {
            echo "Member not found.";
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }

    echo '<a class="dropdown-item" style="color:white" href="../customerLogin/logout.php">Logout</a>';
} else {
    // If not logged in, show "Login" link
    echo '<a class="dropdown-item" style="color:white" href="../customerLogin/register.php">Sign Up </a> ';
    echo '<a class="dropdown-item" style="color:white" href="../customerLogin/login.php">Log In</a>';
}

// Close the database connection
mysqli_close($link);
?>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- END nav -->

    <section class="hero-wrap">
        <div class="home-slider owl-carousel js-fullheight">
            <div class="slider-item js-fullheight" style="background-image:url(./../../images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate">
                            <div class="text w-100 mt-5 text-center">
                                <span class="subheading">Taste.it Restaurant</h2></span>
                                <h1>Cooking Since</h1>
                                <span class="subheading-2">1958</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item js-fullheight" style="background-image:url(./../../images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate">
                            <div class="text w-100 mt-5 text-center">
                                <span class="subheading">Taste.it Restaurant</h2></span>
                                <h1>Best Quality</h1>
                                <span class="subheading-2 sub">Food</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section ftco-wrap-about ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row no-gutters" id="reservation">
                <div class="col-sm-4 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary">
                    <form method="GET" action="../CustomerReservation/availability.php" class="appointment-form">
                        <h3 class="mb-3">Book your Table</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="date" name="reservation_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                            $availableTimes = array();
                            for ($hour = 10; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $availableTimes[] = $time;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" class="form-control" >';
                            echo '<option value="" selected disabled>Select a Time</option>';
                            foreach ($availableTimes as $time) {
                                echo "<option  value='$time'>$time</option>";
                            }
                            echo '</select>';
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<p>$message</p>";
                            }
                            ?>
                                </div>
                                <input type="number" id="head_count" name="head_count" value=1 hidden required>

                            </div>




                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Search Table"
                                        class="btn btn-white py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8 wrap-about py-5 ftco-animate img"
                    style="background-image: url(./../../images/about.jpg);">
                    <div class="row pb-5 pb-md-0">
                        <div class="col-md-12 col-lg-7">
                            <div class="heading-section mt-5 mb-4">
                                <div class="pl-lg-3 ml-md-5">
                                    <span class="subheading">About</span>
                                    <h2 class="mb-4">Welcome to Taste.it</h2>
                                </div>
                            </div>
                            <div class="pl-lg-3 ml-md-5">
                                <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came
                                    from it would have been rewritten a thousand times and everything that was left from
                                    its origin would be the word "and" and the Little Blind Text should turn around and
                                    return to its own, safe country. A small river named Duden flows by their place and
                                    supplies it with the necessary regelialia. It is a paradisematic country, in which
                                    roasted parts of sentences fly into your mouth.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-intro" style="background-image: url(./../../images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span>Now Booking</span>
                    <h2>Private Dinners &amp; Happy Hours</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Specialties</span>
                    <h2 class="mb-4">Our Menu</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Breakfast</h3>
                        </div>
                        <?php foreach ($breakfast as $item): ?>

                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/breakfast-1.jpg);">
                            </div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>



                        <span class="flat flaticon-bread" style="left: 0;"></span>
                        <span class="flat flaticon-breakfast" style="right: 0;"></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Lunch</h3>
                        </div>
                        <?php foreach ($lunch as $item): ?>

                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/lunch-1.jpg);"></div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>


                        <span class="flat flaticon-pizza" style="left: 0;"></span>
                        <span class="flat flaticon-chicken" style="right: 0;"></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Dinner</h3>
                        </div>
                        <?php foreach ($dinner as $item): ?>
                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/dinner-1.jpg);"></div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <span class="flat flaticon-omelette" style="left: 0;"></span>
                        <span class="flat flaticon-burger" style="right: 0;"></span>
                    </div>
                </div>

                <!--  -->
                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Desserts</h3>
                        </div>
                        <?php foreach ($dessert as $item): ?>
                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/dessert-1.jpg);">
                            </div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <span class="flat flaticon-cupcake" style="left: 0;"></span>
                        <span class="flat flaticon-ice-cream" style="right: 0;"></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Soda</h3>
                        </div>
                        <?php foreach ($soda as $item): ?>
                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/wine-1.jpg);"></div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <span class="flat flaticon-wine" style="left: 0;"></span>
                        <span class="flat flaticon-wine-1" style="right: 0;"></span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="heading-menu text-center ftco-animate">
                            <h3>Drinks &amp; Tea</h3>
                        </div>
                        <?php foreach ($drinks as $item): ?>
                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(./../../images/drink-1.jpg);"></div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3><?php echo $item['item_name']; ?></h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price"><?php echo $item['item_price']; ?>DT</span>
                                    </div>
                                </div>
                                <p><?php echo $item['item_type']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <span class="flat flaticon-wine" style="left: 0;"></span>
                        <span class="flat flaticon-wine-1" style="right: 0;"></span>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="ftco-section testimony-section" style="background-image: url(./../../images/bg_5.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-3 pb-2">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <span class="subheading">Testimony</span>
                    <h2 class="mb-4">Happy Customer</h2>
                </div>
            </div>
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-7">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap text-center">
                                <div class="text p-3">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="user-img mb-4"
                                        style="background-image: url(./../../images/person_1.jpg)">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="fa fa-quote-left"></i>
                                        </span>
                                    </div>
                                    <p class="name">John Gustavo</p>
                                    <span class="position">Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center">
                                <div class="text p-3">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="user-img mb-4"
                                        style="background-image: url(./../../images/person_1.jpg)">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="fa fa-quote-left"></i>
                                        </span>
                                    </div>
                                    <p class="name">John Gustavo</p>
                                    <span class="position">Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center">
                                <div class="text p-3">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="user-img mb-4"
                                        style="background-image: url(./../../images/person_1.jpg)">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="fa fa-quote-left"></i>
                                        </span>
                                    </div>
                                    <p class="name">John Gustavo</p>
                                    <span class="position">Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center">
                                <div class="text p-3">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="user-img mb-4"
                                        style="background-image: url(./../../images/person_1.jpg)">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="fa fa-quote-left"></i>
                                        </span>
                                    </div>
                                    <p class="name">John Gustavo</p>
                                    <span class="position">Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center">
                                <div class="text p-3">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <div class="user-img mb-4"
                                        style="background-image: url(./../../images/person_1.jpg)">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="fa fa-quote-left"></i>
                                        </span>
                                    </div>
                                    <p class="name">John Gustavo</p>
                                    <span class="position">Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Chef</span>
                    <h2 class="mb-4">Our Master Chef</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img" style="background-image: url(./../../images/chef-4.jpg);"></div>
                        <div class="text px-4 pt-2">
                            <h3>John Gustavo</h3>
                            <span class="position mb-2">CEO, Co Founder</span>
                            <div class="faded">
                                <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                                <ul class="ftco-social d-flex">
                                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img" style="background-image: url(./../../images/chef-2.jpg);"></div>
                        <div class="text px-4 pt-2">
                            <h3>Michelle Fraulen</h3>
                            <span class="position mb-2">Head Chef</span>
                            <div class="faded">
                                <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                                <ul class="ftco-social d-flex">
                                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img" style="background-image: url(./../../images/chef-3.jpg);"></div>
                        <div class="text px-4 pt-2">
                            <h3>Alfred Smith</h3>
                            <span class="position mb-2">Chef Cook</span>
                            <div class="faded">
                                <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                                <ul class="ftco-social d-flex">
                                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img" style="background-image: url(./../../images/chef-1.jpg);"></div>
                        <div class="text px-4 pt-2">
                            <h3>Antonio Santibanez</h3>
                            <span class="position mb-2">Chef Cook</span>
                            <div class="faded">
                                <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                                <ul class="ftco-social d-flex">
                                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 d-flex">
                    <div class="img img-2 w-100 mr-md-2" style="background-image: url(./../../images/bg_6.jpg);"></div>
                    <div class="img img-2 w-100 ml-md-2" style="background-image: url(./../../images/bg_4.jpg);"></div>
                </div>
                <div class="col-md-6 ftco-animate makereservation p-4 p-md-5">
                    <div class="heading-section ftco-animate mb-5">
                        <span class="subheading">This is our secrets</span>
                        <h2 class="mb-4">Perfect Ingredients</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the
                            Semantics, a large language ocean.
                        </p>
                        <p><a href="#" class="btn btn-primary">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Blog</span>
                    <h2 class="mb-4">Recent Blog</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="../../blog-single.php?blogid=1" class="block-20"
                            style="background-image: url('./../../images/image_1.jpg');">
                        </a>
                        <div class="text px-4 pt-3 pb-4">
                            <div class="meta">
                                <div><a href="#">August 3, 2020</a></div>
                                <div><a href="#">Admin</a></div>
                            </div>
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <p class="clearfix">
                                <a href="#" class="float-left read btn btn-primary">Read more</a>
                                <a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="../../blog-single.php?blogid=2" class="block-20"
                            style="background-image: url('./../../images/image_2.jpg');">
                        </a>
                        <div class="text px-4 pt-3 pb-4">
                            <div class="meta">
                                <div><a href="#">August 3, 2020</a></div>
                                <div><a href="#">Admin</a></div>
                            </div>
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <p class="clearfix">
                                <a href="#" class="float-left read btn btn-primary">Read more</a>
                                <a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="blog-entry">
                        <a href="../../blog-single.php?blogid=3" class="block-20"
                            style="background-image: url('./../../images/image_3.jpg');">
                        </a>
                        <div class="text px-4 pt-3 pb-4">
                            <div class="meta">
                                <div><a href="#">August 3, 2020</a></div>
                                <div><a href="#">Admin</a></div>
                            </div>
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                    blind texts</a></h3>
                            <p class="clearfix">
                                <a href="#" class="float-left read btn btn-primary">Read more</a>
                                <a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb ftco-intro bg-primary">
        <div class="container py-5">
            <div class="row py-2">
                <div class="col-md-12 text-center">
                    <h2>We Make Delicious &amp; Nutritious Food</h2>
                    <a href="#" class="btn btn-white btn-outline-white">Book A Table Now</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-no-pb ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Taste.it</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in Bookmarksgrove</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Open Hours</h2>
                        <ul class="list-unstyled open-hours">
                            <li class="d-flex"><span>Monday</span><span>9:00 - 24:00</span></li>
                            <li class="d-flex"><span>Tuesday</span><span>9:00 - 24:00</span></li>
                            <li class="d-flex"><span>Wednesday</span><span>9:00 - 24:00</span></li>
                            <li class="d-flex"><span>Thursday</span><span>9:00 - 24:00</span></li>
                            <li class="d-flex"><span>Friday</span><span>9:00 - 02:00</span></li>
                            <li class="d-flex"><span>Saturday</span><span>9:00 - 02:00</span></li>
                            <li class="d-flex"><span>Sunday</span><span> Closed</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Instagram</h2>
                        <div class="thumb d-sm-flex">
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-1.jpg);">
                            </a>
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-2.jpg);">
                            </a>
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-3.jpg);">
                            </a>
                        </div>
                        <div class="thumb d-flex">
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-4.jpg);">
                            </a>
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-5.jpg);">
                            </a>
                            <a href="#" class="thumb-menu img"
                                style="background-image: url(./../../images/insta-6.jpg);">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Newsletter</h2>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <form action="#" class="subscribe-form">
                            <div class="form-group">
                                <input type="text" class="form-control mb-2 text-center"
                                    placeholder="Enter email address">
                                <input type="submit" value="Subscribe" class="form-control submit px-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 bg-primary py-3">
            <div class="row no-gutters">
                <div class="col-md-12 text-center">

                    <p class="mb-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="./../../js/jquery.min.js"></script>
    <script src="./../../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="./../../js/popper.min.js"></script>
    <script src="./../../js/bootstrap.min.js"></script>
    <script src="./../../js/jquery.easing.1.3.js"></script>
    <script src="./../../js/jquery.waypoints.min.js"></script>
    <script src="./../../js/jquery.stellar.min.js"></script>
    <script src="./../../js/owl.carousel.min.js"></script>
    <script src="./../../js/jquery.magnific-popup.min.js"></script>
    <script src="./../../js/jquery.animateNumber.min.js"></script>
    <script src="./../../js/bootstrap-datepicker.js"></script>
    <script src="./../../js/jquery.timepicker.min.js"></script>
    <script src="./../../js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="./../../js/google-map.js"></script>
    <script src="./../../js/main.js"></script>

</body>
</html>