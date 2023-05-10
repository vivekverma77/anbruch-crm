<?php if ($this->session->flashdata('success')){  ?>
	<div class="alert alert-success alert-block fade in">
		<button data-dismiss="alert" class="close close-sm" type="button">
				<i class="fa fa-times"></i>
		</button>
		<h4>
				<i class="icon-ok-sign"></i>
				<?php echo 'Success' ?>!
		</h4>
		<p><?php echo $this->session->flashdata('success'); ?></p>
	</div>
<?php } ?>	


<?php if ($this->session->flashdata('error')){  ?>
	<div class="alert alert-danger alert-block fade in">
		<button data-dismiss="alert" class="close close-sm" type="button">
				<i class="fa fa-times"></i>
		</button>
		<h4>
				<i class="icon-ok-sign"></i>
				<?php echo 'Error' ?>!
		</h4>
		<p><?php echo $this->session->flashdata('error'); ?></p>
	</div>
<?php } ?>	


<?php if (isset($message)) foreach ($message as $key => $value) { ?>
	<div class="alert alert-<?php echo $key ?> alert-block fade in">
			<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
			</button>
			<!-- <h4>
					<i class="icon-ok-sign"></i>
					<?php echo ucfirst($key) ?>!
			</h4> -->
			<p><?php echo $value ?></p>
	</div>
<?php } ?>
