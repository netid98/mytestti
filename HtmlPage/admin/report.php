

	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<a href="/admin.php" class="btn">Back to users</a>
				<span class="login100-form-title p-b-49">
					Report
				</span>
				<div style="margin-bottom:25px;text-align:center;">
					<form action="/admin.php" method="GET">
						<input type="hidden" name="ac" value="do_report">
						<input type="hidden" name="uid" value="<?php echo $data[0]->userid ?>">
						<input class="form-control" type="text" name="date" placeholder="Date Filter">
					</form>
				</div>

				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Time</th>
				      <th scope="col">Date</th>
				      <th scope="col">In_Out Time</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($data as $io): ?>
				    <tr>
				      <th scope="row"><?php echo $io->id ?></th>
				      <td><?php echo date('H:i:s' , $io->time) ?></td>
				      <td><?php echo $this->formatdate($io->date) ?></td>
				      <td><?php echo $io->IO ?></td>
				    </tr>
					<?php endforeach ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>