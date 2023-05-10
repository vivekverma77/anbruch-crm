<!--
admin cancel booking
-->
<style>
	.panel-body {
    padding: 15px;
    margin: 35px 0 0 0;
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
.booking .sel-detail{
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

</style>	

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
					
            <header class="panel-heading">
               Cancel Booking 
                        <!--span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span-->
            </header>
            
            <div class="panel-body booking">	
													
							<div class="row sel-detail">
								<div class="main-region js-consent-lockable" id="main-region">
									<div class="solo">
									<div class="header">
	
								<div class="js-profile-region">
									<div class="box text-center small-container">
										
										<a class="js-signup-button mbl pill-button" href='<?php echo base_url()."index.php/modules/viewRecord/?cm=$current_module&id=$current_record_id&record_status=$recordStatus";  ?>' ><i class="fas fa-long-arrow-alt-left"></i> Back</a>
											<div class="title-wrapper">
												<div class="mbs phs popover-holder">
													<div class="increased popover-toggle silent">
														<h2>Cancel Booking</h2>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr class="mbl">
									
										<div class="vsmall-container">								
											<div class="adaptive enter-details">
												<div class="col1of2 plm">
													
													<h2 class="mbm">Enter Details</h2>
													<form id="frmSchedule" class="js-form" autocomplete="off" novalidate="" autocorrect="off">
														<div class="js-base-questions-region">
															<div>
																<div class="field js-input-container mbm">
																	<label>Enter booking e-mail address *</label>
																	<input class="js-input text" type="email" name="email" data-model="invitee" autocomplete="off" required="" value="">
																	<span data-error="email"></span>
																</div>
															</div>
														</div>
														
														<div class="ptm">
															<input class="button submit-btn js-loading-hide schedule_event" type="button" value="Cancel Booking" style="background:#ec7878;">
														
															<input type="hidden" name="current_module" id="current_module" value="<?php echo $current_module; ?>">
															<input type="hidden" name="current_record_id" id="current_record_id" value="<?php echo $current_record_id; ?>">
															<input type="hidden" name="recordStatus" id="recordStatus" value="<?php echo $recordStatus; ?>">		
															<input type="hidden" name="created_by" id="created_by" value="<?php echo $currentUserData['id']; ?>">											
															<input type="hidden" name="bookingId" id="bookingId" value="<?php echo $bookingId; ?>">													
															
														</div>
													</form>
												</div>
											</div>
										</div>
									
									</div>
								
								</div>

							</div>
							
							<div class="row sel-confirmation">
								<div class="main-region js-consent-lockable" id="main-region">
									<div>
										<div class="header">
                     <div class="box text-center">
											<h2 class="pts">Cancelled</h2>
											<div class="mbs phl">
												Your booking is cancelled.
											</div>
                     </div>
										</div>
										
								<div class="narrower vsmall-container">
									<hr class="dotted mbm">				
								
									<div class="text-center">
										<a class="js-signup-button mbl pill-button" href='<?php echo base_url()."index.php/modules/viewRecord/?cm=$current_module&id=$current_record_id&record_status=$recordStatus";  ?>' ><i class="fas fa-long-arrow-alt-left"></i> Back</a>
									</div>
								
								</div>
							
							</div>
						</div>	
	
							</div>
									
						</div>
     

         
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->


<script>
	
	$(document).on('click','.schedule_event',function(){

			var email = $("input[name='email']").val();

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
				url:  '<?php echo base_url()."index.php/booking/cancelBooking"; ?>',
				type: "POST",
				data: frmdata,
				beforeSend: function() {
				
				},
				success: function(result)
				{
					console.log(result);
					if(result=='no_booking_found')
					{
						$("input[name='email']").val('');
						alert('No booking exists with this email address!');
						
						return;
					}					
					if(result=='not_cancelled')
					{
						$("input[name='email']").val('');
						alert('Error! Booking is not cancelled. try after some time!');
						
						return;
					}					
			
					$('.sel-confirmation').show();
					$('.sel-detail').hide();
		
				}	
			});			
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
