@extends('navbar_sales')

@section('content')

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
                
              <form id="registerFormP" class="well form-horizontal" action="{{ route('user.validate_registration') }}" method="post">
                @csrf
                <div class="contents-right">
                  <div class="PI-left">
                      <p style="text-decoration:underline;color: grey;">Personal Information</p>

                      
                      <!-- <input type="hidden" name="role" value="staff"> -->
                      
                      

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="name" placeholder="Full Name *" class="form-control"  type="text">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
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
                                   
                                                <option name="department" value="Sales"> Sales </option>
                                        
                                                <option name="department" value="Store"> Store </option>
                                            
                                                <option name="department" value="QC"> Quality Control </option>
                                        
                                                <option name="department" value="production">  Production </option>
                                        
                            </select>
                        </div> -->

        


                  </div>

                  <div class="PI-right">
                  
                  <p style="text-decoration:underline;color: grey;"> Login Info </p>

                        <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  name="email" placeholder="Email *" class="form-control"  type="text">
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
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
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
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


@endsection('content')