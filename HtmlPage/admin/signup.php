
	
	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="/admin.php" method="POST">
					<span class="login100-form-title p-b-49">
						Sing up
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="ایمیل">
						<span class="label-input100">ایمیل</span>
						<input class="input100" type="email" name="email" placeholder="ایمیل">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="گذر واژه ضروری است">
						<span class="label-input100">گذر واژه</span>
						<input class="input100" type="password" name="pwd" placeholder="گذر واژه">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
						<span class="label-input100">تکرار گذر واژه</span>
						<input class="input100" type="password" name="repwd" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="نام کامل">
						<span class="label-input100">نام کامل</span>
						<input class="input100" type="text" name="name" placeholder="نام کامل">
						<span class="focus-input100" data-symbol="&#xf192;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="شماره تماس">
						<span class="label-input100">شماره تماس</span>
						<input class="input100" type="text" name="tell" placeholder="شماره تماس">
						<span class="focus-input100" data-symbol="&#xf192;"></span>
					</div>
					
					
					<div class="container-login100-form-btn" style="margin-bottom:40px;margin-top:80px">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<input type="hidden" name="ac" value="do_signup" />
							<button class="login100-form-btn" >
								Sing Up
							</button>
						</div>
					</div>
					<div class="text-center">
						<?php echo $this->Getmsg(); ?>
					</div>


				</form>
			</div>
		</div>
	</div>
