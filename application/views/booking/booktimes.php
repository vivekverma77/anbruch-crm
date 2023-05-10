<div class="js-am-spot-list">	
	<ul class="spots">
	<?php  
	$current_time = date('g:i A', strtotime($from_date));
	$time = '8:30'; // start
	for ($i = 0; $i <= 5; $i++)
	{
		$prev = date('g:i A', strtotime($time)); // format the start time
		$next = strtotime('+30mins', strtotime($time)); // add 30 mins
		$time = date('g:i A', $next); // format the next time
		//echo $time;
		if($current_time==$time)
		{
			$current = 'current_spot';
			
			if (($key = array_search($current_time, $bookingTimeNotAvailable)) !== false) {
				unset($bookingTimeNotAvailable[$key]);
			}
		}
		else
		{
			$current = '';
		}

		if(in_array($time,$bookingTimeNotAvailable) )
		{
	?>
		<li class="spot-booked available collapsed">
			<button class="js-select time-button">
				<?php echo $time; ?> - Already Booked						
			</button>			
		</li>
 <?php        
		}
		else
		{	
 ?>
		<li class="spot <?php echo $current; ?> available collapsed">
			<button class="js-select time-button">
				<?php echo $time; ?>
				<div class="status">available</div>
			</button>
			<button class="base confirm-button js-confirm" data-time="<?php echo $time; ?>">Confirm</button>
		</li>
 <?php        
    }
  }
 ?>

	</ul>
</div>

<div class="seprator" style="display: block;">
	<h2 class="text">Noon</h2>
</div>

<div class="js-pm-spot-list">
	<ul class="spots">
	<?php
	$time = '12:00'; // start
	for ($i = 0; $i <= 8; $i++)
	{
		$prev = date('g:i A', strtotime($time)); // format the start time
		$next = strtotime('+30mins', strtotime($time)); // add 30 mins
		$time = date('g:i A', $next); // format the next time
		//echo $time;
		if($current_time==$time)
		{
			$current = 'current_spot';
			if (($key = array_search($current_time, $bookingTimeNotAvailable)) !== false) {
				unset($bookingTimeNotAvailable[$key]);
			}
		}
		else
		{
			$current = '';
		}
		
		if(in_array($time,$bookingTimeNotAvailable))
		{
	?>
		<li class="spot-booked available collapsed">
			<button class="js-select time-button">
				<?php echo $time; ?> - Already Booked			
			</button>			
		</li>
 <?php        
		}
		else
		{	
 ?> 
		<li class="spot <?php echo $current; ?> available collapsed">
			<button class="js-select time-button">
				<?php echo $time; ?>
				<div class="status">available</div>
			</button>
			<button class="base confirm-button js-confirm"  data-time="<?php echo $time; ?>">Confirm</button>
		</li>
	
	<?php        
		}
	}
	?>
	</ul>
</div>
