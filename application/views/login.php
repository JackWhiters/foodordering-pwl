<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | <?php echo $_SESSION['system']['name'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
	<link rel="shortcut icon" href="<?php echo base_url().$_SESSION['system']['logo'] ?>" type="image/x-icon"/>
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url() ?>assets/mobile/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo base_url() ?>assets/mobile/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo base_url() ?>assets/mobile/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/jquery-3.4.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script> 
</head>
<style>
    #login_progress {
        display:none;
    }
</style>
<body style="background-color: #666666;">
	
	<div class="login-main">
	<div class="modal"  role="dialog" id="loader" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="mloader">
            <div class="loader"></div>
          </div>
      </div>
    </div>
  </div>
		<div class="login-field">
			<div class="sign-only" style='display:none'>
				<a href="javascript:void(0)" id="login-link" style="color:black"><i class="fa fa-arrow-left"></i></a>
			</div>
			<div class="login-icon-field">
				<img src="<?php echo base_url().$_SESSION['system']['logo'] ?>" width="75px" height="75px" alt="">
			</div>
			<form id="login-frm">
				<div class="col-md-12">
					<div class="row login_validation"></div>
					<div class="row">
						<div class="md-form col-sm-12">
							<i class="fa fa-user prefix"></i>
								<input type="text" id="email" name="email" class="form-control" required>
								<label for="email">Email or Username</label>
						</div>
						<div class="md-form col-sm-12">
							<i class="fa fa-lock prefix"></i>
								<input type="password" id="password" name="password" class="form-control" required>
								<label for="password">Password</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<center>
								<button class="btn btn-primary" type="submit" id="login-btn">Login</button>
							</center>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<center>
								<a href="javascript:void(0)" id="signup-link"><b>Sign up</b></a>
							</center>
						</div>
					</div>	
				</div>
			
			</form>

			<form id="signup-frm" style="display:none">
				<div class="col-md-12">
					<div class="row">
						<div class="md-form col-sm-12">
								<input type="text" id="firstname" name="firstname" class="form-control" required>
								<label for="firstname">First name</label>
						</div>
					</div>
					<div class="row">
						<div class="md-form col-sm-12">
									<input type="text" id="lastname" name="lastname" class="form-control" required>
									<label for="lastname">Last name</label>
						</div>
					</div>
					<div class="row">
						<div class="md-form col-sm-12">
									<input type="number" id="phone" name="phone_number" class="form-control" required>
									<label for="phone">Phone number</label>
						</div>
					</div>
					<div class="row">
						<div class="md-form col-sm-12">
									<input type="email" id="email2"  name="email2" class="form-control" required>
									<label for="email2">Email or Username</label>
						</div>
					</div>
					<div class="row" id="email_validation">

					</div>
					<div class="row">
						<div class="md-form col-sm-12">
									<input type="password" id="password2" name="password" class="form-control" required>
									<label for="password2">Password</label>
						</div>
					</div>
					<div class="row">
						<div class="md-form col-sm-12">
									<input type="password" id="cpassword" class="form-control" required>
									<label for="cpassword">Confirm password</label>
						</div>
					</div>
					<div class="row" id="pass_validation">

					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							<center><button class="btn btn-primary" type="submit" id="signup-btn">Create Account</button></center>
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>
	
	

	
	
	<script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/mdb.min.js"></script>
    
    <script>
        $(document).ready(function(){
        	$('html body').css({height:$(document).height()})
			$('#signup-link').click(function(){
				start_loader()
				$('#login-frm').hide('fadeOut')
				$('#signup-frm').show('fadeIn')
				$('.sign-only').show('fadeIn')
				$('.login-main').height($(document).height())
				$('html, body').animate({
					scrollTop: $(".sign-only").offset().top
				}, 500);
				end_loader()
			})
			$('#login-link').click(function(){
				start_loader()
				$('#signup-frm').hide('fadeOut')
				$('.sign-only').hide('fadeOut')
				$('#login-frm').show('fadeIn')
				$('.login-main').height($(window).height())
				end_loader()
			})

			// $('#signup-btn').click(()=>{
			// 	$('#signup-frm').submit()
			// })
			// $('#login-btn').click(()=>{
			// 	$('#login-frm').submit()
			// })
			$('#login-frm').submit(function(e){
				e.preventDefault()
				start_loader()
				$.ajax({
					url:'<?php echo base_url('login/login') ?>',
					method:'POST',
					data:$(this).serialize(),
					error:(err)=>{
						alert('An error occcured. Please try to refresh this page.')
						console.log(err)
						end_loader()
					},
					success:resp=>{
						if(typeof resp != undefined){
							resp = JSON.parse(resp)

							if(resp.status == 'success'){
								if(resp.type == 5){
									location.replace('<?php echo base_url('order') ?>')
								}else if(resp.type == 1){
									location.replace('<?php echo base_url('admin') ?>')
								}else if(resp.type == 2){
									location.replace('<?php echo base_url('kitchen') ?>')
								}else if(resp.type == 3 || 6){
									location.replace('<?php echo base_url('sales/pos') ?>')
								}else if(resp.type == 4){
									location.replace('<?php echo base_url('delivery') ?>')
								}
							}else if(resp.status == 'email_unknown'){
								$('.login_validation').html('<span class="err">* Email is not registered.</span>')
								end_loader()
							}else if(resp.status == 'login_failed'){
								$('.login_validation').html('<span class="err">* Login failed. Wrong password.</span>')
								end_loader()
							}else if(resp.status == 'blocked'){
								$('.login_validation').html('<span class="err">* Your account has been blocked.</span>')
								end_loader()
							}else{
								$('.login_validation').html('<span class="err">* Database error .Please try to refresh this page</span>')
								end_loader()
							}
						}
					}
				})
			})
			$('#signup-frm').submit(function(e){
				e.preventDefault()
				start_loader();
				var frmData = $(this).serialize();
				console.log(frmData)
				if($('.err').length > 0)
				$('.err').remove()
				if($('#password2').val() != $('#cpassword').val()){
					$('#pass_validation').html('<span class="err">* Password do not match</span>')
					$('#cpassword').trigger('focus')
					end_loader()
					return false;
				}
				$.ajax({
					url:'<?php echo base_url('login/check_email') ?>',
					method:'POST',
					data:{email:$('#email2').val()},
					error:(err)=>{
						alert('An error occured. Please refresh this page.')
						console.log(err)
						end_loader
						return false;
					},
					success:function(resp){
						if(resp > 0){
							$('#email_validation').html('<span class="err">* Email already exist.</span>')
							$('#email2').focus();
							$('html, body').animate({
								scrollTop: $("#email2").offset().top
							}, 500);
							end_loader();
							return false;
								
						}else{
							$.ajax({
								url:'<?php echo base_url('login/create_account') ?>',
								method:'POST',
								data:frmData,
								error:(err)=>{
									alert('An error occured. Please try to refresh this page.')
									console.log(err)
									end_loader
									return false;
								},
								success:resp=>{
									if(typeof resp != undefined){
										resp =JSON.parse(resp)

										if(resp.status == 'success'){
											if(resp.type == 5){
												location.replace('<?php echo base_url('order') ?>')
											}else if(resp.type == 1){
												location.replace('<?php echo base_url('admin') ?>')
											}else if(resp.type == 2){
												location.replace('<?php echo base_url('kitchen') ?>')
											}else if(resp.type == 3){
												location.replace('<?php echo base_url('sales/pos') ?>')
											}else if(resp.type == 4){
												location.replace('<?php echo base_url('delivery') ?>')
											}
										}
									}else{
										alert('An error occured')
									}
								}
							})
						}
					}
				})

				
			})
        })
		window.start_loader = function(){
			$('#loader').modal('show')
		}
		window.end_loader = function(){
			$('#loader').modal('hide')
		}	
    </script>

</body>
</html>