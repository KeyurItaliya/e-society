<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #60a3bc !important;
		}
		.user_card {
			height: 450px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #60a3bc;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
    </style>
</head>
<body>
	<span id="error_show" style="display: none;" >
		<div class="alert show alert-danger alert-dismissible fade"  role="alert">
			<strong>Error!</strong> You should check in on some of those fields below.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</span>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/colors-1596915_960_720.webp" class="brand_logo" alt="Logo">
					</div>
                </div>
                
				<div class="d-flex justify-content-center form_container">
					<form id="login_form" method="POST">
                        <!-- <span class="message_success"></span> -->
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-check-square"></i></span>
							</div>
							<select class="form-control" name="type_user">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
								<option value="security_guard"> Security Guard </option>
                            </select>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="user_name" class="form-control input_user" value = "<?php if(isset($_COOKIE["user_name_cookie"])){ echo $_COOKIE["user_name_cookie"]; } ?>" autocomplete="off" placeholder="username/registretion ID">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value= "<?php if(isset($_COOKIE["password_cookie"])){ echo $_COOKIE["password_cookie"]; } ?>" placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" name="remember" value="1" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="submit" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't remember your password? 
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#" onclick="forgotPassword()" >Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
    </div>

	<div id="forgot-password" tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content program-details row pl-3 pr-3">
                <div class="pt-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-12 sec-title mb-0">
                    <h2>Forgot password?</h2>
                    <div class="separator"></div>
                </div>
				
                <div class="modal-body text-center">
					
                    <form id="reset_password">
						<div>
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <button type="submit" class="submit-btn mt-3 mb-3">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


	<div id="sign-up" tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content program-details row pl-3 pr-3">
                <div class="pt-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-12 sec-title mb-0">
                    <h2>SignUp </h2>
                    <div class="separator"></div>
                </div>
                <div class="modal-body text-center">
                    <form id="sign_up">
						<div>
							<lable>Name</lable>
                            <input type="text" name="name" placeholder="Name">
                        </div>
						<div>
							<lable>Mobile No</lable>
                            <input class="mt-2" type="text" name="number" placeholder="Mobile No">
                        </div>
						<div>
							<lable>Address</lable>
                            <input class="mt-2" type="text" name="address" placeholder="Address">
                        </div>
                        <div>
							<lable>Email</lable>
                            <input class="mt-2" type="email" name="email" placeholder="Email">
                        </div>
                        <button type="submit" class="submit-btn mt-3 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript"> 
function forgotPassword(){
	$('#forgot-password').modal('show');		
}

function signUp(){
	$('#sign-up').modal('show');
}
</script>
</body>
</html>