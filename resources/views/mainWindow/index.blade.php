<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link rel="stylesheet" href="css/mydesignsliststyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>LGOMS</title>
</head>
<body>
<div class="menu-container">

    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="register_user"><a href="{{route('register.index')}}" style="color:black; text-decoration:none">Register User</a></div>
            <div class="order_list">Order List</div>
            <div class="design_list">Design List</div>
        </div>

        @auth
       
        <div class="dropdown">
            <div class="profile-group">
                <div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
                <div class="profile"><p class="dropbtn">{{ auth()->user()->name }}</p></div>
            </div>

        <form action="/logout" method="get">
            @csrf
            <div class="dropdown-content">
                <!-- <a href="#">Account Settings</a> -->
               <a href="#">Sign Out</a>
            </div>
        </form>

        </div>
    </div>
</div>

<div class="card">
		<div class="cardheader">
			<div class="row">
				<div class="col col-md-6" id="thetitle">
                    <b>Welcome back, {{ auth()->user()->name }}</b>
                </div>
			</div>
		</div>
</div>

@endauth
</body>
</html>
