	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<span class="login100-form-title p-b-49">
						Home
					</span>
				<form class="login100-form validate-form" action="/home.php" method="POST">		
					<div class="container-login100-form-btn" style="margin-bottom:40px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<input type="hidden" name="ac" value="<?php echo $data->formaction ?>" />
							<button class="login100-form-btn" >
								Send
							</button>
						</div>
					</div>
					<div class="text-center" style="margin-bottom:40px;">
						<span class="alert alert-info"><?php if(isset($data->intime)) print(date('Y-m-d  g:i:s A' , $data->intime));?></span> 
					</div>

				</form>

				<?php if($this->Getmsg()): ?>
				<div class="text-center">
					<?php echo $this->Getmsg(); ?>
				</div>
				<?php endif ?>
				
				<form class="login100-form validate-form" action="/signin.php" method="POST">
						<div class="container-login100-form-btn" style="margin-top:30px;">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<input type="hidden" name="ac" value="do_signout" />
								<button class="login100-form-btn" >
									Exit
								</button>
							</div>
						</div>
				</form>

			</div>
		</div>
	</div>