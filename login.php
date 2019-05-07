
<html lang="en">
<head>	

  <meta charset="UTF-8">
  <title>L&SS Login</title>
  <link href= "lib/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href= "lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/sweetalert.min.js"></script>

	
  <script type="text/javascript">
	var brow = navigator.appName;
	if(brow == 'Microsoft Internet Explorer')
	{
		swal({
			title: "Portal Info",
			text: "Please use Chrome Browser for better experience",
			icon: "warning",
		});
	}
	
	$(document).ready(function(){
		$("#usname").on('keyup', function (e) {
			if (e.keyCode == 13) {
				$("#acnlog" ).click();
			}
		});
		
		$("#pwd").on('keyup', function (e) {
			if (e.keyCode == 13) {
				$("#acnlog" ).click();
			}
		});
		
		//ajax call for login
		$("#acnlog").click(function () 
		{
			var user = $("#usname").val();
			var pass = $("#pwd").val();
			var flag = 1;
			
			if(user=='' || user==' ' || pass=='' || pass==' ')
			{
				swal({
					title: "Portal Info",
					text: "Please provide credentials to login",
					icon: "warning",
				});
			}
			else
			{			
				/*Ajax Request*/
				$.ajax({
					type: "post",
					url: 'lpajax.php',
					data:{
						'usname' : user,
						'psw' : pass,
						'flag' : flag
					},
					success: function(response){
						if(response==1)
						{
							location.href='home.php';
						}
						else if(response==2)
						{
							swal({
								title: "Portal Info",
								text: "Please provide correct credentials",
								icon: "error",
							});
						}
						else if(response==3)
						{
							swal({
								title: "Portal Info",
								text: "Your access is revoked as you are no longer an active member of L&SS. If you are still part of L&SS, please reach out to your manager to gain access",
								icon: "info",
							});
						}
						else if(response==4)
						{
							$("#dummylnk" ).click();
						}
						else if(response==5)
						{
							swal({
								title: "Portal Info",
								text: "Please check with your manager to initiate creation of your profile in L&SS directory",
								icon: "info",
							});
						}
						else
						{
							swal({
								title: "Portal Info",
								text: "some issue, please reach out to Admin",
								icon: "error",
							});
						}
					},
					error: function(errors) {
						swal({
							title: "Portal Info",
							text: "some issue, please reach out to Admin",
							icon: "error",
						});
					}
				});
			}

		});
		
		//ajax call for password reset
		$("#fogpassb").click(function () 
		{
			var user = $("#fogpassd").val();
			var flag = 2;
			
			if(user=='' || user==' ')
			{
				swal({
					title: "Portal Info",
					text: "Please provide d number to reset your password",
					icon: "warning",
				});
			}
			else
			{			
				/*Ajax Request*/
				$.ajax({
					type: "post",
					url: 'lpajax.php',
					data:{
						'usname' : user,
						'flag' : flag
					},
					success: function(response){
						if(response==1)
						{
							$("#fogpass").modal("toggle");
							swal({
								title: "Portal Info",
								text: "A new password has been sent via mail",
								icon: "success",
							});
						}
						else if(response==2)
						{
							$("#fogpass").modal("toggle");
							swal({
								title: "Portal Info",
								text: "Please check with your manager to initiate creation of your profile in L&SS directory",
								icon: "info",
							});
						}
						else
						{
							$("#fogpass").modal("toggle");
							swal({
								title: "Portal Info",
								text: "some issue, please reach out to Admin",
								icon: "error",
							});
						}
					},
					error: function(errors) {
						$("#fogpass").modal("toggle");
						swal({
							title: "Portal Info",
							text: "some issue, please reach out to Admin",
							icon: "error",
						});
					}
				});
			}

		});
		
		//ajax call for new password set
		$("#newpassb").click(function () 
		{
			var user = $("#usname").val();
			var newpass = $("#temppassnewin").val();
			var repass = $("#temppassretin").val();
			
			if(newpass === repass)
			{
				npass = newpass.trim();
				if(npass.length >5 && npass.length < 13)
				{
					var flag = 4;
					/*Ajax Request*/
					$.ajax({
						type: "post",
						url: 'lpajax.php',
						data:{
							'usname' : user,
							'newpass' : npass,
							'flag' : flag
						},
						success: function(response){
							if(response==1)
							{
								$("#npassset").modal("toggle");
								swal({
									title: "Portal Info",
									text: "Your new password has been set. Use new password to login",
									icon: "success",
								});
							}
							else if(response==2)
							{
								swal({
									title: "Portal Info",
									text: "Old and new password cant be same",
									icon: "warning",
								});
							}
							else
							{
								$("#npassset").modal("toggle");
								swal({
									title: "Portal Info",
									text: "some issue, please reach out to Admin",
									icon: "error",
								});
							}
						},
						error: function(errors) {
							$("#npassset").modal("toggle");
							swal({
								title: "Portal Info",
								text: "some issue, please reach out to Admin",
								icon: "error",
							});
						}
					});
				}
				else
				{
					swal({
						title: "Portal Info",
						text: "Please provide only 6 to 12 character long password",
						icon: "warning",
					});
				}
			}
			else
			{
				swal({
					title: "Portal Info",
					text: "Your new paswords are not matching",
					icon: "warning",
				});
			}
		});
	});	
  </script>	
  
  <style>
	body {font-family: "Akkurat",Helvetica,Arial,sans-serif;}
		.login-block{
			//background: #DE6262;  /* fallback for old browsers */
			//background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
			//background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			float:left;
			width:100%;
			height:100%;
			padding : 0px 0;
			
			
		}
		.banner-sec{ background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
		.container{background:#fff; border-radius: 10px; }
		.carousel-inner{border-radius:0 10px 10px 0;}
		.carousel-caption{text-align:left; left:5%;}
		.login-sec{padding: 20px 20px; position:relative;}
		.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
		.login-sec .copy-text i{color:#FEB58A;}
		.login-sec .copy-text a{color:#E36262;}
		.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
		.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
		.btn-login{background: #DE6262; color:#fff; font-weight:600;}
		.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
		.banner-text h2{color:#fff; font-weight:600;}
		.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
		.banner-text p{color:#fff;}
		.modelbg {background-image: url('image/bg.jpg');background-repeat: round;}
	</style>
</head>
<body id='body' name='body' style= "Background-image: url(img/Melb.jpg);background-repeat:no-repeat;background-size:100%;background-attachment: fixed;">
	<section class="login-block" style ="display:block;margin-left: auto; margin-bottom:0;margin-top:0;margin-right: auto;position: absolute;opacity:0.9;">
		<div class="container" style='box-shadow:15px 20px 0px rgba(0,0,0,0.1);width:400px;'>
			<div class=" login-sec" style ="margin-top:20%;">	
				<img  src="img/logo_login.png" style = "margin-left: 40%" width='50px' height='50px'>
				<br></br>
				<h2 class="text-center" style = "color:Black">L&SS Resource Portal</h2>
				<form class="login-form">
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input type="text" class="form-control" placeholder="" id='usname' name="usname" style='border-bottom: 1px solid #D0021B;border-top: 0px;border-left: 0px;border-right: 0px;color:#D0021B;margin-bottom: -1px;background-color: #FDF7F8;border-radius:0px;'>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" placeholder="" name="pwd" id  = "pwd" style='border-bottom: 1px solid #D0021B;border-top: 0px;border-left: 0px;border-right: 0px;color:#D0021B;margin-bottom: -1px;background-color: #FDF7F8;border-radius:0px;'>
					</div><br>
					<div class="form-check">
						<label class="form-check-label">
						<input type="checkbox" class="form-check-input">
						<small>Remember Me</small>
						</label>
						<button  type='button' class="btn btn-login float-right" value="Login" name="acnlog" id="acnlog" style='width: 112px;height:41px;' >Login</button>
					</div> 
					<br><br>
					<div>
						<div class='row'>
							<div class='col' align='right'>
								<a href='#' data-target='#fogpass' data-toggle='modal' id='fogpassl' name='fogpassl' style='font-size:14px;'>Forget Password?</a>
							</div>
						</div>
					</div>
				</form>				
			</div>		
		</div>
	</section>
	
	<!--Model for Forget Password-->
	<div class='modal fade' id='fogpass' tabindex='-1'>
		<div class='modal-dialog' >
			<div class='modal-content' >
				<div class='modal-header' style='border-bottom: 0px'>
					<h5 class='modal-title'>Password Reset</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<div class="modal-content animate" style='padding-top:10px;padding-bottom:10px'>
						<div style='text-align:center'>
						  <img src="img/logo_login.png" style='width:50px;height:50px'>
						  <br><br>
						  <h1 style="text-align:center;font-size:20px;font-weight:bold;background:white;color:#DE6262"></h1>
						</div>
						<div class="container">
						  <small>Please Provide your d number</small>
						  <input type="text" placeholder="" name="fogpassd" id="fogpassd" class='form-control' style='border-bottom: 1px solid #D0021B;border-top: 0px;border-left: 0px;border-right: 0px;color:#D0021B;margin-bottom: -1px;background-color: #FDF7F8;border-radius:0px'>  
						  <br>							  
						  <button class='btn btn-login btn-block' name='fogpassb' id='fogpassb'>Submit</button> 
						  <br>
						  <small>You will receive a mail with a temporary password after submission</small>
						</div>
						
					  </div>
				</div>
				<div class='modal-footer' style='border-top: 0px;'>
					<button type='button' class='btn btn-login' data-dismiss='modal' id ='logbut'>Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<!--Setting New Password-->
	<div class='modal fade' id='npassset' tabindex='-1'>
		<div class='modal-dialog' >
			<div class='modal-content' >
				<div class='modal-header' style='border-bottom: 0px'>
					<h5 class='modal-title'>Set New Password</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<div class="modal-content animate" style='padding-top:10px;padding-bottom:10px'>
						<div style='text-align:center'>
						  <img src="img/logo_login.png" style='width:50px;height:50px'>
						  <br><br>
						  <h1 style="text-align:center;font-size:20px;font-weight:bold;background:white;color:#DE6262"></h1>
						</div>
						<div class="container">	
						  <small>Please provide 6-12 character long password</small>
						  <input type="password" placeholder="" name="temppassnewin" id="temppassnewin" class='form-control' style='border-bottom: 1px solid #D0021B;border-top: 0px;border-left: 0px;border-right: 0px;color:#D0021B;margin-bottom: -1px;background-color: #FDF7F8;border-radius:0px'>  
						  <br>	
						  <small>Retype your new password</small>
						  <input type="text" placeholder="" name="temppassretin" id="temppassretin" class='form-control' style='border-bottom: 1px solid #D0021B;border-top: 0px;border-left: 0px;border-right: 0px;color:#D0021B;margin-bottom: -1px;background-color: #FDF7F8;border-radius:0px'>  
						  <br>							  
						  <button class='btn btn-login btn-block' name='newpassb' id='newpassb'>Change</button> 
						  <br>
						</div>
						
					  </div>
				</div>
				<div class='modal-footer' style='border-top: 0px;'>
					<button type='button' class='btn btn-login' data-dismiss='modal' id ='logbut'>Close</button>
				</div>
			</div>
		</div>
	</div>
	<a href='#' data-target='#npassset' data-toggle='modal' id='dummylnk' name='dummylnk' style='display:none'></a>
	
</body>
</html>

