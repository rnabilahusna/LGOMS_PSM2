<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="order_list"><a href="{{ route('store.ordersListPage') }}" style="color:black; text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('store.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
        </div>


        @auth
       
        <div class="dropdown">
            <div class="profile-group">
                <div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
                <div class="profile"><p class="dropbtn">{{ auth()->user()->name }}</p></div>
            </div>

            <div class="dropdown-content">
                <a href="logout">Sign Out</a>
            </div>


        </div>

       
        
    </div>
</div>

    @if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif


    <div class="card">
		<div class="cardheader">
			<div class="row">
				<div class="col col-md-6" id="thetitle">
                    <b>Welcome back, {{ auth()->user()->name }} STORE</b>
                </div>
			</div>
		</div>
    </div>


 @endauth
</body>
</html>