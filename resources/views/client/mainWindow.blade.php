

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/makeappointmentstyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>


<!-- @if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif -->

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
            <div class="my_orders"><a href="{{ route('client.myOrdersListPage') }}" style="color:black; text-decoration:none">My Orders</a></div>
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
                <b>Welcome back, {{ auth()->user()->name }} CLIENT</b>
            </div>
        </div>
    </div>
</div>


     @endauth

</body>
</html>