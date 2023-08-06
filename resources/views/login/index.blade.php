<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link rel="stylesheet" href="css/loginpagestyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <style>
        
    </style>
</head>
<body>
  <div class="smaller_body">
<div class="bg">
  <img src="images/bg.jpg" alt="">
</div>
        <div class="menu-container">
            <div class="menu">
                <div class="marking" style="color:#FFFFFF">.</div>
                <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>
                <div class="marking" style="color:#FFFFFF">.</div>
            </div>
        </div>

<!-- display message returned from the loginController -->

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('loginError')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="wrapper_big">
        <div class="wrapper">
            <div class="form-box login">
                <img src="images/profile_picture_default.png" alt="profile pic" style="width:90px;height:90px;">
                <!-- login form -->
                <form action="/login" method="post"> 
                    @csrf

                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input name="email" type="email" placeholder="Email" style="color:white; background-color: #FF6161;" class="form-control @error('email') is-invalid @enderror" required>
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input name="password" class="form-control" type="password" placeholder="Password" style="color:white; background-color: #FF6161;" required>
                        
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Remember me</label>
                        <a href="#">Forgot password?</a>
                    </div>
                    <div><button type="submit" class="btn">Login</button></div>
                    
                </form>
            </div>
        </div>
    
    </div>
    </div>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>