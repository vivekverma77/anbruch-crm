<style>
	.panel-body {
    padding: 15px;
    margin: 35px 0 0 0;
}
.fraction.current {
    border: 10px solid #1FB5AD;
}

.spots .current_spot
{
	border: 4px solid #1FB5AD;
	border-radius: 5px;
}

	.fraction {
		width: 80px;
		height: 80px;
		text-align: center;
		border: 3px solid #1FB5AD;
		border-radius: 500px;
		margin: 0 10px;
		align-content: center;
		vertical-align: middle;
		cursor: pointer;
		}
	.centered {
		display: flex;
		justify-content: center;
		align-content: center;
	}
	
	.period .fraction .full {
    display: none;
}

<!--  time -->

.spots {
    max-width: 380px;
}
ol, ul {
    list-style: none;
}
.spots .spot {
    font-size: 0px;
    overflow: hidden;
    white-space: nowrap;
    text-align: center;
    margin-bottom: 10px;
}
/*
.header {
    text-align: center;
    margin: 30px 20px;
}
*/
.wrapper.narrow {
    max-width: 380px;
}
/*
.wrapper {
    position: relative;
    margin: 0 auto;
    padding: 0 20px;
    max-width: 860px;
}*/
.centered, .text-center {
    text-align: center;
}
.mbm, .mvm, .mam {
    margin-bottom: 20px;
}
.mbs, .mvs, .mas {
    margin-bottom: 10px;
}
.col3of5 {
    width: 60%;
}
h2 {
    font-size: 18px;
    line-height: 1.3em;
}
.pull-right, .text-right {
    text-align: right;
}
.col2of5 {
    width: 40%;
}
label.switch {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
label.switch input {
    display: none;
}
.mbl, .mvl, .mal {
    margin-bottom: 30px;
}
.seprator {
    position: relative;
    display: none;
    margin: 19px 0 27px 0;
    padding-top:5px;
    text-align: center;
    border-top: 1px solid #dadada;
}
.spots .spot .status {
    display: none;
    text-transform: uppercase;
    font-size: 10px;
    color: #00A2FF;
}
.spots .spot .confirm-button {
    display: none;
}
.time-button, .confirm-button {
    font-size: 14px;
    line-height: 1.3em;
    display: inline-block;
    box-sizing: border-box;
    padding: 18px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.booking .row{
	display:none;
}
.booking .sel-days{
	display:block;
	}
	
	.previous_week, .next_week  {
    font-size: 40px;
    margin-top: 18px;
    cursor:pointer;
	}
	.day.js-show-picker {
    margin: 17px 0;
}

.spot-booked .time-button {
	margin-bottom: 10px;
	border-color: red;
	color: red;
}

</style>	

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
					
            <header class="panel-heading">
                Update Booking - <?php echo $booking['booking_title']; ?>
                        <span class="tools pull-right">
                            <!--a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a-->
                            <a class="module_head" href="<?php echo base_url()."index.php/modules/viewRecord/?cm=$current_module&id=$current_record_id&record_status=$recordStatus";  ?>">Back</a>
                         </span>
            </header>
            
            <div class="panel-body booking">
						
							<div class="row sel-days">
								
								<div class="js-days-region mvl">
									<div class="week-view">
										<h2 class="mbl text-center">Select a Day</h2>
								
										<div class="js-days-region">
											
											<div class="period">											
												
												<div class="centered js-days-body">													
													<!-- days view by ajax -->
													<div class="loader"><img src="<?php echo base_url()."static/images/loader.gif"; ?>" /></div>
												</div>
											
										
											</div>
										
										</div>
									
									</div>
									
								</div> 
						
							</div>
							
							<div class="row sel-time">
								
								<div class="main-region js-consent-lockable" id="main-region">
									<div> 
										<div class="header">
											<div class="box text-center small-container">
												<div class="fas fa-long-arrow-alt-left time-step-back step-back back-step">&nbsp;</div>
												<h2 class="sel_day no-space">Monday</h2>
												<div class="mbm sel_date">November 5, 2018</div>
												<!--div class="mbl">Times are in India, Sri Lanka Time</div-->
											</div>
											
										</div>
										<hr class="mbl">
									
										<div class="narrow vsmall-container">
											<div class="mbm text-center">
											</div>
											<div class="adaptive mbs">
												<div class="col3of5 mbs mobile-centered">
													<h2>Select a Time</h2>
												</div>
												
											</div>
											<div class="js-spot-list mbl">
												<!-- times view by ajax -->
												<div class="loader"><img src="<?php echo base_url()."static/images/loader.gif"; ?>" /></div>
											</div>

										</div>

									</div>

								</div>
									
					
							</div>
							
							<div class="row sel-detail">
								<div class="main-region js-consent-lockable" id="main-region">
									<div class="solo">
										<div class="header">
			
								<div class="js-profile-region">
									<div class="box text-center small-container">
										<div class="fas fa-long-arrow-alt-left  detail-step-back step-back back-step">&nbsp;</div>
											<div class="title-wrapper">
												<div class="mbs phs popover-holder">
													<div class="increased popover-toggle silent">
														<h2>Booking</h2>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr class="mbl">
								<div class="vsmall-container">
									<div class="js-event-error-block mbl notification" style="display: none;">
										<span class="js-event-error-message"></span>
										<a class="button ghost js-event-error-action js-step-back">Find a new spot</a>
									</div>
									<div class="adaptive enter-details">
										<div class="col1of2 prm">
											<div class="mbs">
												<div class="marker" style="background-color: #c5c1ff"></div>
												<div class="last-col">
													<h2>Booking</h2>
												</div>
											</div>
											<div class="emphasis iconed-text">
												
												<span class="far fa-clock text-green"></span><span class="sel_time  text-green"> 09:30am - Monday, October 8, 2018</span>
											</div>
											<!--div class="iconed-text">
												<i class="icon-globe"></i>
												India, Sri Lanka Time
											</div-->
										</div>
										<div class="col1of2 plm">
											<div class="hidden-tablet-up">
											</div>
											<h2 class="mbm">Enter Details</h2>
											<form id="frmSchedule" class="js-form" autocomplete="off" novalidate="" autocorrect="off">
												<div class="js-base-questions-region">
													<div>
														<div class="field js-input-container mbm">
															<label>Title *</label>
															<input class="js-input text" type="text" name="booking_title" data-model="invitee" autocorrect="off" autocomplete="off" required="" maxlength="155" value="<?php echo $booking['booking_title']; ?>">
															<span data-error="booking_title"></span>
														</div>
														<div class="field js-input-container mbm">
															<label>Full Name *</label>
															<input class="js-input text" type="text" name="full_name" data-model="invitee" autocorrect="off" autocomplete="off" value="<?php echo $booking['name']; ?>" required="" maxlength="155" >
															<span data-error="full_name"></span>
														</div>
														<div class="field js-input-container mbm">
															<label>Your e-mail address *</label>
															<input class="js-input text" type="email" name="email" data-model="invitee" autocomplete="off" required="" value="<?php echo $booking['email']; ?>">
															<span data-error="email"></span>
														</div>
													</div>
												</div>
												<div class="js-location-region"></div>
												<div class="js-custom-questions-region"><div class="questions"></div></div>
												<div class="js-sms-reminder-region"></div>
												<div class="field js-payment-input-region"></div>
												<div class="hidden js-captcha-container"></div>
												<div class="ptm">
													<input class="button submit-btn js-loading-hide schedule_event" type="button" value="Update">
													<input type="hidden" name="selected_day" id="selected_day" value="<?php echo date('l', strtotime($booking['booking_date'])); ?>">
													<input type="hidden" name="selected_date" id="selected_date" value="<?php echo date('F d, Y', strtotime($booking['booking_date'])); ?>">
													<input type="hidden" name="selected_time" id="selected_time" value="<?php echo date('h:ia', strtotime($booking['booking_date'])); ?>">
													<input type="hidden" name="current_module" id="current_module" value="<?php echo $current_module; ?>">
													<input type="hidden" name="current_record_id" id="current_record_id" value="<?php echo $current_record_id; ?>">
													<input type="hidden" name="recordStatus" id="recordStatus" value="<?php echo $recordStatus; ?>">
													<input type="hidden" name="created_by" id="created_by" value="<?php echo $currentUserData['id']; ?>">
													<input type="hidden" name="bid" id="bid" value="<?php echo $booking['booking_id']; ?>">
													
												</div>
											</form>
										</div>
									</div>
								</div></div></div>
															
							</div>
							
							<div class="row sel-confirmation">
								<div class="main-region js-consent-lockable" id="main-region">
									<div>
										<div class="header">
                                        	
                                            <div class="box text-center">
											<h2 class="pts">Updated</h2>
											<div class="mbs phl">
												Your booking schedule is updated.
											</div>
                                            </div>
										</div>
										
								<div class="narrower vsmall-container">
									<hr class="dotted mbm">
									<div class="mbs">
										<div class="marker" style="background-color: #c5c1ff"></div>
										<div class="last-col">
											<h2>Booking Details</h2>
										</div>
									</div>
									<div class="emphasis iconed-text">
										<i class="icon-clock"></i>
										<span class="far fa-clock text-green"></span><span class="sel_time text-green">09:30am - Monday, October 8, 2018</span>
									</div>
									<!--div class="iconed-text">
										<i class="icon-globe"></i>
										India, Sri Lanka Time
									</div-->
									<div class="text-center">
										<strong>
										</strong>
										<!--div class="pvl">
											<strong>A calendar invitation has been sent to your email address.</strong>
										</div-->
									</div>
									<hr class="dotted mbl">
									<div class="mbl">
									</div>
									<div class="text-center">
										<a class="js-signup-button mbl pill-button" href='<?php echo base_url()."index.php/modules/viewRecord/?cm=$current_module&id=$current_record_id&record_status=$recordStatus";  ?>' ><i class="fas fa-long-arrow-alt-left"></i> Back</a>
									</div>
								</div></div></div>	
															
							</div>
		
						</div>
     

         
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->


<script>
	
		function load_days_body(from_date)
		{
			//var from_date = "<?php echo date('Y-m-d'); ?>";
			//var to_date = "<?php echo date('Y-m-d', strtotime('+7 day',strtotime(date('Y-m-d')))); ?>";
			var booking_date = "<?php echo date('Y-m-d',strtotime($booking['booking_date']) ); ?>";
			$.ajax({
				url:  '<?php echo base_url()."index.php/booking/bookDays"; ?>',
				type: "POST",
				data: { 'from_date': from_date, 'booking_date': booking_date },
				beforeSend: function() {
					$('.js-days-body').html("<div class='loader'><img src='<?php echo base_url()."static/images/loader.gif"; ?>' /></div>");
				},
				success: function(result)
				{
					//console.log(result);					
					$('.js-days-body').html(result);
				}	
			});	
		}		
		load_days_body("<?php echo date('Y-m-d',strtotime($booking['booking_date']) ); ?>");
		
		$(document).on('click','.previous_week',function(){
			var cdate = $(this).attr('data-nav');	
			load_days_body(cdate);
		});
	
		$(document).on('click','.next_week',function(){
			var cdate = $(this).attr('data-nav');	
			load_days_body(cdate);
		});
	
		$(document).on('click','.fraction',function()
		{			
			$('.sel-days').hide();
			$('.sel-time').show();
			
			var day = $(this).find('.sday').html();
			var date = $(this).find('.sdate').html();
			
			console.log(day);
			console.log(date);
			$('.sel_day').html(day);
			$('.sel_date').html(date);
			$('#selected_day').val(day);
			$('#selected_date').val(date);		
			
			//load_times_body("<?php echo date('Y-m-d H:i',strtotime($booking['booking_date']) ); ?>");
			//console.log("<?php echo date('Y-m-d', strtotime('+ date +')); ?>");
			load_times_body(date+" "+"<?php echo date('H:i',strtotime($booking['booking_date']) ); ?>");
			
		});	
		
		function load_times_body(from_date)
		{
			var current_record_id = "<?php echo $current_record_id; ?>";
			$.ajax({
				url:  '<?php echo base_url()."index.php/booking/bookTimes"; ?>',
				type: "POST",
				data: { 'from_date': from_date, 'current_record_id': current_record_id  },
				beforeSend: function() {
					$('.js-spot-list').html("<div class='loader'><img src='<?php echo base_url()."static/images/loader.gif"; ?>' /></div>");
				},
				success: function(result)
				{
					//console.log(result);					
					$('.js-spot-list').html(result);
				}	
			});	
		}	
		
		$(document).on('click','.time-step-back',function(){
			$('.sel-days').show();
			$('.sel-time').hide();
		});		
		
		$(document).on('click','.detail-step-back',function(){
			$('.sel-detail').hide();
			$('.sel-time').show();
		});		
		
		$(document).on('click','.time-button',function(){
			console.log('in');
			$(".spots").find('li').removeClass("active");
			$(this).parent('li').addClass("active");
			$('.confirm-button').hide();
			$(this).next('.confirm-button').show();
		
		});
		
		$(document).on('click','.confirm-button',function(){
			
			$('.sel-time').hide();
			$('.sel-detail').show();
			
			
			var day = $('#selected_day').val();
			var date = $('#selected_date').val();		
			
			var time = $(this).attr('data-time');
			var time_date = time+' - '+day+', '+date;
			console.log(time_date);
			$('.sel_time').html(time_date);		
			$('#selected_time').val(time);				
		
		});	
		
		$(document).on('click','.schedule_event',function(){
			
			var booking_title = $("input[name='booking_title']").val();
			var full_name = $("input[name='full_name']").val();
			var email = $("input[name='email']").val();
			if(booking_title=='')
			{
				alert('Enter booking title!');
				return;	
			}
			
			if(full_name=='')
			{
				alert('Enter full name!');
				return;	
			}
			
			if(email=='')
			{
				alert('Enter email address!');
				return;	
			}
			
			if(!validateEmail(email))
			{
				alert('Enter valid email address!');
				return;
			}
			
			var frmdata = $('#frmSchedule').serializeArray();
			
			console.log(frmdata);
			
			$.ajax({
				url:  '<?php echo base_url()."index.php/booking/bookedit"; ?>',
				type: "POST",
				data: frmdata,
				beforeSend: function() {
				
				},
				success: function(result)
				{
					console.log(result);
					
					if(result=='booking_already_exists')
					{
						alert('Booking for this time already exists! Choose other time or change email address.');
						
						return;
					}					
			
					$('.sel-confirmation').show();
					$('.sel-detail').hide();
		
				}	
			});			
		});
	
		
	$(function()
	{				
	
	});
	
	
	function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
	}
	
</script>
