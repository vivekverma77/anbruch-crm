<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css.map">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<style>
.select2.select2-container.select2-container--default{width:175px !important;margin-left: 10px;margin-top: -4px;}
.reportbtn{background-color: dodgerblue;border-color: dodgerblue;color: #fff;}
.reportbtn:focus{background-color: dodgerblue;border-color: dodgerblue;color: #fff;}
.reportbtn:hover{background-color: #1e90ffd6;border-color: #fff;color: #fff;}

.test-plates{display:table;border-bottom:2px solid #fe832c;margin:50px auto 0px;}
.test-plates span a{font-size:1.25em;padding: 7px 10px;background:#ffffff;color: #fe832c;border-radius:5px 5px 0px 0px;font-weight:560;display:inline-block;margin-bottom:-1px;border:1px solid;}
.test-plates span a:hover{opacity:0.85;}
.test-plates span.active a{background: #fe832c;color: #fff;border:0;}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">
		<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Web Bookings </span></h3>
		<div class="test-plates">
			<?php echo $test == 'Canadian Customs Duties' ? '<span class="test active"><a href="javascript:vaoid(0)">Canadian Customs Duties</a></span>' : '<span class="test sel_auth"><a href="javascript:vaoid(0)">Canadian Customs Duties</a></span>';

				echo $test == 'Canadian Sales Tax (GST/HST)' ? '<span class="test active"><a href="javascript:vaoid(0)">Canadian Sales Tax (GST/HST)</a></span>' : '<span class="test sel_auth"><a href="javascript:vaoid(0)">Canadian Sales Tax (GST/HST)</a></span>';

				echo $test == 'Canadian Govt Incentives' ? '<span class="test active"><a href="javascript:vaoid(0)">Canadian Govt Incentives</a></span>' : '<span class="test sel_auth"><a href="javascript:vaoid(0)">Canadian Govt Incentives</a></span>';
			?>
		</div>
		<button type="button" class="btn reportbtn" id="report" style="float:right;margin:40px 4px 0px 0px;font-size:15px;">Export Report</button>
		<form action="<?php echo base_url(); ?>reports/webBookings" type="get" name="time-period" id="timeForm">
			<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
				<label for="time-period" style="font-size:14px;">New Bookings</label>
				<select name="t" id="time-period">
					<option value="" >Choose response</option>
					<option value="week" <?php if(isset($_GET['t']) && $_GET['t'] == 'week'){ echo "selected"; } ?> >This Week</option>
					<option value="month" <?php if(isset($_GET['t']) && $_GET['t'] == 'month'){ echo "selected"; }?> >This Month</option>
					<option value="year" <?php if(isset($_GET['t']) && $_GET['t'] == 'year'){ echo "selected"; } ?> >This Year</option>
				</select>
				<input type="hidden" id="test" name="test" value="<?php echo $test; ?>" />
			</div>
		</form>
		
		<!-- <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-12 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title" style="text-align:center">Score</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question01"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div> -->
	    <?php //print_r($questionnaire); die("ok"); ?>
		<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-6 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">1. Currently selling goods to Canada ?</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question1"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <div class="col-xs-6 main-cols">
	            <div style="margin-right:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">2. Have you been using a customs broker to CLEAR your goods into Canada ?</div> 
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                      <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question2"></canvas>
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div>


	    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-6 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">3. In the past 4 years what is your estimated ANNUAL sales volume to Canada ?</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question3"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <div class="col-xs-6 main-cols">
	            <div style="margin-right:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">4. In the past 4 years your sales to Canada have been ?</div> 
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                      <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question4"></canvas>
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div>

	    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-6 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">5. Are you registered for Canadian GST (Sales Tax) and regularly filing GST Returns to Canada ?</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question5"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <div class="col-xs-6 main-cols">
	            <div style="margin-right:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">6 Your accounting records for Canadian sales / Accounts Payable records are processed in ?</div> 
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                      <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question6"></canvas>
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div>

	    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-6 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">7. In the past 4 years have you had significant changes in your accounting system and/or staff ?</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question7"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <div class="col-xs-6 main-cols">
	            <div style="margin-right:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title" style="padding:13px 15px 30px;">8. Do you have production or distribution centers in Canada ?</div> 
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                      <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question8"></canvas>
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div>

	    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
	        <div class="col-xs-6 main-cols col-left">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">9. The Canadian Tax Authority (CRA) conducts regular audits. Has your company been REASSESSED in the past 6 MONTHS ?</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question9"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <div class="col-xs-6 main-cols">
	            <div style="margin-right:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title" style="padding:13px 15px 30px;">10. Your company had a REVERSE AUDIT ?</div> 
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                      <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="question10"></canvas>
	                 </div>
	              </div>
	            </div>
	        </div>
	    </div>

	</section>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chartjs-plugin-labels.min.js"></script>
<script>
	$(document).ready(function(){
		$("#time-period").select2();
		$("#time-period").change(function(){
			$("#timeForm").submit();
		});
		$('.sel_auth').click(function(){
			var test = $(this).find('a').text();
			$("#test").val(test);
			$('#timeForm').submit();
		});
		$("#report").click(function(){
			var t = $("#time-period").val();
			$.ajax({
				type:'post',
				url: "<?php echo base_url(); ?>reports/exportWebBookings",
				dataType:'json',
				data:{time:t},
				success:function(data)
				{
					console.log(data);
					if(data.success)
					{
						window.open('https://softgetix.com/projects/crm-anbruch/upload/web_reports/'+data.file_name, '_blank');
					}
				}
			});
		});
	});
	var total_bookings = <?php echo $total_bookings ?>;
	//alert(total_bookings);

	/*Question 01*/
	/*var ctx = document.getElementById('question01').getContext('2d');
	var percentage = new Array();
	var color = new Array();
	question01_details = <?php echo json_encode($question01_details); ?>;
	for(var i=0; i< 5; i++)
	{
    	color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	var q1Options={
       plugins:{
        labels:[{
          fontColor: '#fff',
          fontSize: 16,
          fontStyle:'bold',
          render:'value'
        },
         {
            render: 'label',
            arc:true ,
            position:'outside',
            fontSize: 12,
            fontStyle:'bold', 
          }
        ]
       },
        animation:{
          onComplete: function(animation) {
              var firstSet = animation.chart.config.data.datasets[0].data,
                  dataSum = firstSet.reduce((accumulator, currentValue) => accumulator + currentValue);
                  
              if(typeof firstSet !== "object" || dataSum === 0){
                document.getElementById('no-bdata').style.display = 'block';
                document.getElementById('bookingChart').style.display = 'none'
              }
          }
        }
    }
    var q2Options={
       plugins:{
        labels:[{
          fontColor: '#fff',
          fontSize: 16,
          fontStyle:'bold',
          render:'value'
        },
        ]
       },
        animation:{
          onComplete: function(animation) {
              var firstSet = animation.chart.config.data.datasets[0].data,
                  dataSum = firstSet.reduce((accumulator, currentValue) => accumulator + currentValue);
                  
              if(typeof firstSet !== "object" || dataSum === 0){
                document.getElementById('no-bdata').style.display = 'block';
                document.getElementById('bookingChart').style.display = 'none'
              }
          }
        }
    }
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
		    labels: ['Poor', 'Fair', 'Average', 'Good', 'Excellent'],
		    datasets: [{
		    	label: ['Poor', 'Fair', 'Average', 'Good', 'Excellent'],
		    	data: question01_details,
		    	backgroundColor: color,
		   		borderWidth: 1,
		        beginAtZero: true,
		    }],
		},
		options: q1Options
    });*/
    /*Question01*/

	/*Question 1*/
	var ctx = document.getElementById('question1').getContext('2d');
	var percentage = new Array();
	var color = new Array();
	question1_details = <?php echo json_encode($question1_details); ?>;
	for(var i=0; i< 2; i++)
	{
		/*var per = Math.round(question1_details[i]*100 / total_bookings);
    	percentage.push(per);*/
    	color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	var q1Options={
       plugins:{
        labels:[{
          fontColor: '#fff',
          fontSize: 16,
          fontStyle:'bold',
          render:'value'
        },
         {
            render: 'label',
            arc:true ,
            position:'outside',
            fontSize: 12,
            fontStyle:'bold', 
          }
        ]
       },
        animation:{
          onComplete: function(animation) {
              var firstSet = animation.chart.config.data.datasets[0].data,
                  dataSum = firstSet.reduce((accumulator, currentValue) => accumulator + currentValue);
                  
              if(typeof firstSet !== "object" || dataSum === 0){
                document.getElementById('no-bdata').style.display = 'block';
                document.getElementById('bookingChart').style.display = 'none'
              }
          }
        }
    }
    var q2Options={
       plugins:{
        labels:[{
          fontColor: '#fff',
          fontSize: 16,
          fontStyle:'bold',
          render:'value'
        },
        ]
       },
        animation:{
          onComplete: function(animation) {
              var firstSet = animation.chart.config.data.datasets[0].data,
                  dataSum = firstSet.reduce((accumulator, currentValue) => accumulator + currentValue);
                  
              if(typeof firstSet !== "object" || dataSum === 0){
                document.getElementById('no-bdata').style.display = 'block';
                document.getElementById('bookingChart').style.display = 'none'
              }
          }
        }
    }
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
		    labels: ['Yes', 'No'],
		    datasets: [{
		    	label: ['Yes', 'No'],
		    	data: question1_details,
		    	backgroundColor: color,
		   		borderWidth: 1,
		        beginAtZero: true,
		    }],
		},
		options: q1Options
    });
    /*Question1*/

    /*Question2*/
    var ctx = document.getElementById('question2').getContext('2d');
   	var question2_details = new Array();
   	var color2 = new Array();
	question2_details = <?php echo json_encode($question2_details); ?>;
	for(var i=0; i< 2; i++)
	{
		color2.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}

	var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
            	label: ['Yes', 'No'],
            	data: question2_details,
            	backgroundColor: color2,
            }],
        },
        options: q1Options
    });
    /*Question2*/

    /*Question3*/
    var ctx = document.getElementById('question3').getContext('2d');
   	var question3_details = new Array();
   	var color3 = new Array();
	question3_details = <?php echo json_encode($question3_details); ?>;
	for(var i=0; i< 4; i++)
	{
		color3.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Less than $100K', '$100K - $1.99M', '$2M - $5M', 'Greater than $5M'],
            datasets: [{
            	label: ['Less than $100K', '$100K - $1.99M', '$2M - $5M', 'Greater than $5M'],
            	data: question3_details,
            	backgroundColor: color3,
            }],
        },
        options: q2Options
    });
    /*Question3*/

    /*Question4*/
    var ctx = document.getElementById('question4').getContext('2d');
   	var question4_details = new Array();
   	var color4 = new Array();
	question4_details = <?php echo json_encode($question4_details); ?>;
	for(var i=0; i< 3; i++)
	{
		color4.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Higher', 'Lower', 'Consistent'],
            datasets: [{
            	label: ['Higher', 'Lower', 'Consistent'],
            	data: question4_details,
            	backgroundColor: color4,
            }],
        },
        options: q1Options
    });
    /*Question4*/

    /*Question5*/
    var ctx = document.getElementById('question5').getContext('2d');
   	var question5_details = new Array();
   	var color5 = new Array();
	question5_details = <?php echo json_encode($question5_details); ?>;
	for(var i=0; i< 2; i++)
	{
		color5.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
            	label: ['Yes', 'No'],
            	data: question5_details,
            	backgroundColor: color5,
            }],
        },
        options: q1Options
    });
    /*Question5*/

    /*Question6*/
    var ctx = document.getElementById('question6').getContext('2d');
   	var question6_details = new Array();
   	var color6 = new Array();
	question6_details = <?php echo json_encode($question6_details); ?>;
	for(var i=0; i< 3; i++)
	{
		color6.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['USA', 'Canada', 'Another Country'],
            datasets: [{
            	label: ['USA', 'Canada', 'Another Country'],
            	data: question6_details,
            	backgroundColor: color6,
            }],
        },
        options: q1Options
    });
    /*Question6*/

     /*Question7*/
    var ctx = document.getElementById('question7').getContext('2d');
   	var question7_details = new Array();
   	var color7 = new Array();
	question7_details = <?php echo json_encode($question7_details); ?>;
	for(var i=0; i< 2; i++)
	{
		color7.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
            	label: ['Yes', 'No'],
            	data: question7_details,
            	backgroundColor: color7,
            }],
        },
        options: q1Options
    });
    /*Question7*/


     /*Question8*/
    var ctx = document.getElementById('question8').getContext('2d');
   	var question8_details = new Array();
   	var color8 = new Array();
	question8_details = <?php echo json_encode($question8_details); ?>;
	for(var i=0; i< 2; i++)
	{
		color8.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
            	label: ['Yes', 'No'],
            	data: question8_details,
            	backgroundColor: color8,
            }],
        },
        options: q1Options
    });
    /*Question8*/

     /*Question9*/
    var ctx = document.getElementById('question9').getContext('2d');
   	var question9_details = new Array();
   	var color9 = new Array();
	question9_details = <?php echo json_encode($question9_details); ?>;
	for(var i=0; i< 2; i++)
	{
		color9.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Yes', 'No'],
            datasets: [{
            	label: ['Yes', 'No'],
            	data: question9_details,
            	backgroundColor: color9,
            }],
        },
        options: q1Options
    });
    /*Question9*/

     /*Question10*/
    var ctx = document.getElementById('question10').getContext('2d');
   	var question10_details = new Array();
   	var color10 = new Array();
	question10_details = <?php echo json_encode($question10_details); ?>;
	for(var i=0; i< 4; i++)
	{
		color10.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Less than 2 years ago', 'More than 4 years ago', 'A very long time ago', 'NEVER had a reverse audit'],
            datasets: [{
            	label: ['Less than 2 years ago', 'More than 4 years ago', 'A very long time ago', 'NEVER had a reverse audit'],
            	data: question10_details,
            	backgroundColor: color10,
            }],
        },
        options: q2Options
    });
    /*Question10*/

</script>