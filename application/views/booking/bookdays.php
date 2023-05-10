<?php
if(!empty($from_date))
{
	$predate = date ("Y-m-d", strtotime("-7 day", strtotime($from_date)));
	if($predate >=date ("Y-m-d"))
	{
	?>
	<span class="fa fa-angle-left previous_week" data-nav="<?php echo $predate; ?>" style="visibility: visible;"></span>
<?php 	
	}
	else
	{
?>
	<span class="fa fa-angle-left " style="visibility:visible;opacity:0.5; font-size: 40px;margin-top: 18px;"></span>
<?php		
	}
	$x =0; 
	while($x <= 6)
	{		
		$newdate = date ("Y-m-d", strtotime("+$x day", strtotime($from_date)));
		if($newdate==date ("Y-m-d", strtotime($booking_date)))
		{
			$current = 'current';
		}
		else
		{
			$current = '';
		}
	?> 
		<div class="fraction <?php echo $current; ?> js-day-wrapper available">
			<div class="day js-show-picker">
				
				<div>
					<strong class="shorthand"><?php echo date("D", strtotime($newdate)); ?></strong>
					<strong class="full sday"><?php echo date("l", strtotime($newdate)); ?></strong>
				</div>
			
				<div>
					<div class="muted shorthand"><?php echo date("M j", strtotime($newdate)); ?></div>
					<div class="full muted sdate"><?php echo date("F j, Y", strtotime($newdate)); ?></div>
				</div>		
				
			</div>
		</div>
	<?php 			
		$x++;	
	} 
	$nextdate = date ("Y-m-d", strtotime("+1 day", strtotime($newdate)));	
	?>
<span class="fa fa-angle-right next_week" data-nav="<?php echo $nextdate; ?>" style="visibility: visible;"></span>
	
<?php
}
else
{ ?>
		<div class="fractionNIU js-day-wrapper available">
			<div class="day js-show-picker">
				<div>
					<strong class="shorthand">No Days Found.</strong>					
				</div>
			</div>
		</div>		
<?php	
}
?>	
