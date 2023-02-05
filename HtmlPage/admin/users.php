

	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<a href="/admin.php?ac=do_register" class="btn">Register new user</a>
				<span class="login100-form-title p-b-49">
					Users
				</span>
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Tell</th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($data as $u): ?>
				    <tr>
				      <th scope="row"><?php echo $u->id?></th>
				      <td><?php echo $u->name?></td>
				      <td><?php echo $u->tell?></td>
				      <td><a href="/admin.php?ac=do_report&uid=<?php echo $u->id?>" class="">Report</a></td>
				    </tr>
					<?php endforeach ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>