<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <!-- <link rel="stylesheet" href="css/navbarstyle.css" > -->
    <link rel="stylesheet" href="css/signupstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="register_user">Register User</div>
            <div class="order_list">Order List</div>
            <div class="design_list">Design List</div>
        </div>

        <div class="dropdown">
            <div class="profile-group">
                <div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
                <div class="profile"><p class="dropbtn">Profile</p></div>
            </div>

            <div class="dropdown-content">
                <a href="#">Account Settings</a>
                <a href="#">Sign Out</a>
            </div>
        </div>
        
    </div>
</div>

<div class="smaller_body">
    <div class="bg">
        <img src="images/bg_1.jpg" alt="">
    </div>
</div>

<div class="container-contents-right">

                <div class="btnrole">
                            <button type="submit" class="btnstaff" onclick="#">Staff</button>
                            <button type="submit" class="btnclient" >Client</button>
                </div>

                <p style="color: grey;font-size:20px;text-align:center;padding-top: 20px;">Sign up for Staff</p>
                
              <form id="registerFormP" onsubmit ="verifyPassword()" class="well form-horizontal" method="post">
                <div class="contents-right">
                  <div class="PI-left">
                      <p style="text-decoration:underline;color: grey;">Personal Information</p>

                      
                      <!-- <input type="hidden" name="role" value="staff"> -->
                      
                      

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="fullname" placeholder="Full Name *" class="form-control"  type="text" Required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="ICNo" placeholder="IC Number *" class="form-control"  type="text" Required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Citizenship&emsp;</label>
                                    <label>
                                        <input type="radio" name="citizenship" value="malaysian" /> Malaysian
                                    </label>
                                    <label>
                                        <input type="radio" name="citizenship" value="non-malaysian" /> Non-Malaysia
                                    </label>
                      </div>


                      <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                        <input type="tel" class="form-control" name="contactNum" placeholder="+6012-34567890" pattern="+601-[0-9]{9}" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="staffID" placeholder="Staff ID *" class="form-control"  type="text" Required>
                                </div>
                            </div>
                        </div>


                      <div class="dept">
                            <label for="department" class="form-group">Department</label>
                            <select class="form-group" style="width:85%; height:40px; color:grey; padding-left: 10px">
                                    <!-- <label class="col-md-4 control-label">Department&emsp;</label> -->
                                   
                                                <option name="department" value="Sales"> Sales </option>
                                        
                                                <option name="department" value="Store"> Store </option>
                                            
                                                <option name="department" value="QC"> Quality Control </option>
                                        
                                                <option name="department" value="production">  Production </option>
                                        
                            </select>
                        </div>

                      

                      <!-- <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="phone" placeholder="Phone *" class="form-control"  type="text" Required>
                                </div>
                            </div>
                        </div> -->

                      


                  </div>

                  <div class="PI-right">
                  
                  <p style="text-decoration:underline;color: grey;"> Login Info </p>

                        <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  name="email" placeholder="Email *" class="form-control"  type="text" Required>
                                    </div>
                                </div>
                            </div>
<!-- 
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  name="username" placeholder="Username *" class="form-control"  type="text" Required>
                                    </div>
                                </div>
                            </div> -->

                        <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  id="password" name="password" placeholder="Password *" class="form-control"  type="password" Required>
                                        <span id="message" style="color:red"> </span> <br>
                                    </div>
                                </div>
                            </div>

                            
                        <button type="submit" id="registerbutton" class="button buttonregister" >Register</button>
                             

                        </div>
                    </div>
                </div>

                
            </form>
        </div>

@yield('content')
    
</body>
</html>