

	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="/profile.php" method="POST">
					<span class="login100-form-title p-b-49">
						update pro
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "نام کامل">
						<span class="label-input100">نام کامل</span>
						<input class="input100" type="text" name="name" placeholder="نام کامل">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "گذر واژه">
						<span class="label-input100">گذر واژه</span>
						<input class="input100" type="password" name="pwd" placeholder="گذر واژه">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>					

					<div class="wrap-input100 validate-input m-b-23" data-validate = "تکرار گذر واژه">
						<span class="label-input100">تکرار گذر واژه</span>
						<input class="input100" type="password" name="repwd" placeholder="تکرار گذر واژه">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>


					
					<div class="container-login100-form-btn" style="margin-bottom:40px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<input type="hidden" name="ac" value="do_update" />
							<button class="login100-form-btn" >
								Send
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