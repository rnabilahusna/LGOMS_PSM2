

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link rel="stylesheet" href="css/signupstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="register_user">Register User</div>
            <div class="order_list"><a href="{{ route('sales.ordersListPage') }}" style="color:black; text-decoration:none">Order List</div>
            <div class="design_list"><a href="{{ route('sales.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
        </div>

		@auth
       
		<div class="dropdown">
			<div class="profile-group">
				<div class="profile-pic"><img  src="/images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
				<div class="profile"><p class="dropbtn">{{ auth()->user()->name }}</p></div>
			</div>

			<div class="dropdown-content">
				<a href="#">Account Settings</a>
				<a href="#">Sign Out</a>
			</div>


		</div>

		@endauth
        
    </div>
</div>

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif

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
                
              <form id="registerFormP" class="well form-horizontal" action="/register" method="post">
                @csrf
                <div class="contents-right">
                  <div class="PI-left">
                      <p style="text-decoration:underline;color: grey;">Personal Information</p>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="name" placeholder="Full Name *" class="form-control"  type="text" Required value="{{old('name')}}">
                                    @if($errors->has('name'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="ICNo" placeholder="IC Number *" class="form-control"  type="text" Required value="{{old('ICNo')}}"> 
                                    @if($errors->has('ICNo'))
                                            <span class="text-danger" style="color:red">{{ $errors->first('ICNo') }}</span>
                                    @endif
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
                                        <input type="text" class="form-control" name="contactNum" placeholder="012-34567890" required value="{{old('contactNum')}}">
                                        @if($errors->has('contactNum'))
                                            <span class="text-danger" style="color:red">{{ $errors->first('contactNum') }}</span>
                                        @endif
                                    </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="staffID" placeholder="Staff ID *" class="form-control"  type="text" Required value="{{old('staffID')}}">
                                    @if($errors->has('staffID'))
                                            <span class="text-danger" style="color:red">{{ $errors->first('staffID') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                      <div class="dept">
                            <label for="department" class="form-group">Department</label>
                            <select name="department" class="form-group" style="width:85%; height:40px; color:grey; padding-left: 10px">
                                   
                                                <option name="department" value="Sales"> Sales </option>
                                        
                                                <option name="department" value="Store"> Store </option>
                                            
                                                <option name="department" value="QC"> Quality Control </option>
                                        
                                                <option name="department" value="production">  Production </option>
                                        
                            </select>
                        </div>


                  </div>

                  <div class="PI-right">
                  
                  <p style="text-decoration:underline;color: grey;"> Login Info </p>

                        <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  name="email" placeholder="Email *" class="form-control"  type="text" Required value="{{old('email')}}">
                                        @if($errors->has('email'))
                                            <span class="text-danger" style="color:red">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input  id="password" name="password" placeholder="Password *" class="form-control"  type="password" Required value="{{old('password')}}">
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


</body>
</html>

