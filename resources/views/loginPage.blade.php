<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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
<div class="wrapper_big">
        <div class="wrapper">
            <div class="form-box login">
                <img src="images/profile_picture_default.png" alt="profile pic" style="width:90px;height:90px;">
                <form action="#">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" placeholder="Email" required>
                        <label hidden>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" placeholder="Password" required>
                        <label hidden>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Remember me</label>
                        <a href="#">Forgot password?</a>
                    </div>
                    <div><button type="submit" class="btn">Login</button></div>
                    
                </form>
            </div>
        </div>

        @yield('content')
    
    </div>
    </div>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>