<?php //echo $test; die("ok"); ?>
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
			<?php echo $test == 1 ? '<span class="test active" data-id = "1" ><a href="javascript:vaoid(0)">Canadian Customs Duties</a></span>' : '<span class="test sel_auth" data-id="1"><a href="javascript:vaoid(0)">Canadian Customs Duties</a></span>';

				echo $test == 2 ? '<span class="test active" data-id = "2"><a href="javascript:vaoid(0)">Canadian Sales Tax (GST/HST)</a></span>' : '<span class="test sel_auth" data-id="2"><a href="javascript:vaoid(0)">Canadian Sales Tax (GST/HST)</a></span>';

				echo $test == 3 ? '<span class="test active" data-id = "3"><a href="javascript:vaoid(0)">Canadian Govt Incentives</a></span>' : '<span class="test sel_auth" data-id="3"><a href="javascript:vaoid(0)">Canadian Govt Incentives</a></span>';
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
		
		<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;flex-wrap:wrap;">
	    <?php foreach ($questionnaire as $key => $value) { $key = $key+1; ?>
	        <div class="col-xs-6 main-cols col-left" style="margin:15px 0;">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title"><?php echo $key; ?>. <?php echo $value['questionnaire']; ?></div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Bookings <?php echo $total_bookings; ?></h6>
	                    <canvas id="<?php echo $value['map']; ?>"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	       
		<?php } ?>
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
	var test_type = $(".test.active").attr('data-id');
	var total_bookings = <?php echo $total_bookings ?>;
	//alert(total_bookings);

	if(test_type == 1)
    {
    	var arr_lab1 = ['Yes', 'No'];
    	var arr_lab2 = ['More than $500K', '$101K - $500K','$25K - $100K','Less than $25K'];
    	var arr_lab2_fb = ['Yes', 'No'];
    	var arr_lab3 = ['No', 'Yes','Unsure'];
    	var arr_lab4 = ['Self-clear','Customs Broker','Multiple customs brokers'];
    	var arr_lab4_fb = ['Less than 1 year', '1 - 5 years', 'Greater than 5 years'];
    	var arr_lab5 = ['Yes', 'No'];
    	var arr_lab6 = ['Less than 10%', 'Between 10% - 25%', 'Greater than 25%','N/A'];
    	var arr_lab7 = ['Yes', 'No'];
    	var arr_lab8 = ['Less than 5 advanced rulings', '5 - 10 advanced rulings', 'Greater than 10 rulings','None'];
    	var arr_lab9 = ['YES', 'NO']; 
    	var arr_lab9_fb = ['YES', 'NO']; 
    	var arr_lab10 =  ['Yes', 'No'];
    }
    if(test_type == 2)
	{
		var arr_lab1 = ['Yes', 'No'];
		var arr_lab1_fb = ['Yes', 'No'];
		var arr_lab2 = ['Yes', 'No'];
		var arr_lab3 = ['Less than $100K', '$100K - $1.99M', '$2M - $5M', 'Greater than $5M'];
		var arr_lab4 = ['Higher', 'Lower', 'Consistent'];
		var arr_lab5 = ['Yes', 'No'];
		var arr_lab6 = ['USA', 'Canada', 'Another Country'];
		var arr_lab7 = ['Yes', 'No'];
		var arr_lab8 = ['Yes', 'No'];
		var arr_lab9 = ['Yes', 'No'];
		var arr_lab9_fb = ['Yes', 'No'];
		var arr_lab10 = ['Less than 2 years ago', 'More than 4 years ago', 'A very long time ago', 'NEVER had a reverse audit'];
	}
	if(test_type == 3)
	{
		var arr_lab1 = ['Yes', 'No'];

		var arr_lab2 = ['Manufacturer in the private sector', 'Non-manufacturer in the private sector','Not-for-profit' ,'Crown corporation NOT designated under the Broader Public Sector Accountability Act','Union or other organizations acting on behalf of employers','A designated broader public sector organization','A publicly funded organization receiving in excess of 10 million dollars','Federal, provincial or municipal government and/or agency'];

		var arr_lab3 = ['New company hires', 'Existing employees', 'All employees','No training is provided, but planning to provide FREE training in the future'];

		var arr_lab3_fb = ['Career', 'Maintenance', 'Essential skills', 'Health & Safety', 'All'];
		var arr_lab4 = ['Less than 50 employees', '51-100 employees', '101 - 1000 employees', 'Greater than 1,000 employees'];

		var arr_lab5 = ['Yes','No'];

		var arr_lab6 = ['Short-term (less than 52 weeks)' , 'Longterm (greater than 52 weeks)','Both short-term and long-term'];

		var arr_lab7 = ['Company trainers (NOT including journeymen)','Third-party (eg. Private Trainers, Unions, Product Vendors, Colleges, Universities, etc.)','Both company trainers and Third-party equally'];

		var arr_lab7_fb = ['Higher', 'Lower', 'Consistent'];
		var arr_lab8 = ['Less than $100K','$100K- $500K', '$500K - $1M', 'Greater than $ 1M'];
		var arr_lab9 = ['Tax credits' , 'Grants','BOTH taxes credits and grants','Other government funding or subsidies for training','NEVER applied for any government funding for training','Applied but was NOT successful'];
		var arr_lab10 = ['Prepare for expansion', 'Continue on-going training development', 'Both to prepare for expansion and continue on-going training','Prepare for downsizing','NOT interested in applying for future funding'];
	}

	/*Question 1*/
	var ctx = document.getElementById('que_1').getContext('2d');
	var percentage = new Array();
	var color = new Array();
	question1_details = <?php echo json_encode($question1_details); ?>;
	for(var i=0; i< arr_lab1.length; i++)
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
                  dataSum = 0;
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
		    labels: arr_lab1,
		    datasets: [{
		    	label: arr_lab1,
		    	data: question1_details,
		    	backgroundColor: color,
		   		borderWidth: 1,
		        beginAtZero: true,
		    }],
		},
		options: q2Options
    });
    /*Question1*/
    /*Question2*/
    var ctx = document.getElementById('que_2').getContext('2d');
   	var question2_details = new Array();
   	var color2 = new Array();
	question2_details = <?php echo json_encode($question2_details); ?>;
	for(var i=0; i< arr_lab2.length; i++)
	{
		color2.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}

	var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab2,
            datasets: [{
            	label: arr_lab2,
            	data: question2_details,
            	backgroundColor: color2,
            }],
        },
        options: q2Options
    });
    /*Question2*/

    /*Question3*/
    var ctx = document.getElementById('que_3').getContext('2d');
   	var question3_details = new Array();
   	var color3 = new Array();
	question3_details = <?php echo json_encode($question3_details); ?>;
	for(var i=0; i< arr_lab3.length; i++)
	{
		color3.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab3,
            datasets: [{
            	label: arr_lab3,
            	data: question3_details,
            	backgroundColor: color3,
            }],
        },
        options: q2Options
    });
    /*Question3*/

    /*Question4*/
    var ctx = document.getElementById('que_4').getContext('2d');
   	var question4_details = new Array();
   	var color4 = new Array();
	question4_details = <?php echo json_encode($question4_details); ?>;
	for(var i=0; i< arr_lab4.length; i++)
	{
		color4.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab4,
            datasets: [{
            	label: arr_lab4,
            	data: question4_details,
            	backgroundColor: color4,
            }],
        },
        options: q2Options
    });
    /*Question4*/

    /*Question5*/
    var ctx = document.getElementById('que_5').getContext('2d');
   	var question5_details = new Array();
   	var color5 = new Array();
	question5_details = <?php echo json_encode($question5_details); ?>;
	for(var i=0; i< arr_lab5.length; i++)
	{
		color5.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab5,
            datasets: [{
            	label: arr_lab5,
            	data: question5_details,
            	backgroundColor: color5,
            }],
        },
        options: q2Options
    });
    /*Question5*/

    /*Question6*/
    var ctx = document.getElementById('que_6').getContext('2d');
   	var question6_details = new Array();
   	var color6 = new Array();
	question6_details = <?php echo json_encode($question6_details); ?>;
	for(var i=0; i< arr_lab6.length; i++)
	{
		color6.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab6,
            datasets: [{
            	label: arr_lab6,
            	data: question6_details,
            	backgroundColor: color6,
            }],
        },
        options: q2Options
    });
    /*Question6*/

     /*Question7*/
    var ctx = document.getElementById('que_7').getContext('2d');
   	var question7_details = new Array();
   	var color7 = new Array();
	question7_details = <?php echo json_encode($question7_details); ?>;
	for(var i=0; i< arr_lab7.length; i++)
	{
		color7.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab7,
            datasets: [{
            	label: arr_lab7,
            	data: question7_details,
            	backgroundColor: color7,
            }],
        },
        options: q2Options
    });
    /*Question7*/


     /*Question8*/
    var ctx = document.getElementById('que_8').getContext('2d');
   	var question8_details = new Array();
   	var color8 = new Array();
	question8_details = <?php echo json_encode($question8_details); ?>;
	for(var i=0; i< arr_lab8.length; i++)
	{
		color8.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab8,
            datasets: [{
            	label: arr_lab9,
            	data: question8_details,
            	backgroundColor: color8,
            }],
        },
        options: q2Options
    });
    /*Question8*/

     /*Question9*/
    var ctx = document.getElementById('que_9').getContext('2d');
   	var question9_details = new Array();
   	var color9 = new Array();
	question9_details = <?php echo json_encode($question9_details); ?>;
	for(var i=0; i< arr_lab9.length; i++)
	{
		color9.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab9,
            datasets: [{
            	label: arr_lab9,
            	data: question9_details,
            	backgroundColor: color9,
            }],
        },
        options: q2Options
    });
    /*Question9*/

     /*Question10*/
    var ctx = document.getElementById('que_10').getContext('2d');
   	var question10_details = new Array();
   	var color10 = new Array();
	question10_details = <?php echo json_encode($question10_details); ?>;
	for(var i=0; i< arr_lab10.length; i++)
	{
		color10.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
	   var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: arr_lab10,
            datasets: [{
            	label: arr_lab10,
            	data: question10_details,
            	backgroundColor: color10,
            }],
        },
        options: q2Options
    });
    /*Question10*/


    /*follow back questions*/
    /*if(test_type == 2)
    {
    	alert(test_type);
    	var ctx = document.getElementById('que_1_fb').getContext('2d');
	   	var question1_fb_details = new Array();
	   	var color1_fb = new Array();
		question1_fb_details = "<?php echo json_encode($question1_fb_details); ?>";
		console.log(question1_fb_details);
		for(var i=0; i< 2; i++)
		{
			color1_fb.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
		}

		var myChart = new Chart(ctx, {
	        type: 'doughnut',
	        data: {
	            labels: ['Yes', 'No'],
	            datasets: [{
	            	label: ['Yes', 'No'],
	            	data: question1_fb_details,
	            	backgroundColor: color1_fb,
	            }],
	        },
	        options: q1Options
	    });
	    
	    var ctx = document.getElementById('que_9_fb').getContext('2d');
	   	var question9_fb_details = new Array();
	   	var color9_fb = new Array();
		question9_fb_details = "<?php echo json_encode($question9_fb_details); ?>";
		for(var i=0; i< 2; i++)
		{
			color9_fb.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
		}

		var myChart = new Chart(ctx, {
	        type: 'doughnut',
	        data: {
	            labels: arr_lab9_fb,
	            datasets: [{
	            	label: arr_lab9_fb,
	            	data: question9_fb_details,
	            	backgroundColor: color9_fb,
	            }],
	        },
	        options: q1Options
	    });
	    
	}*/
	/*follow back questions*/


		$("#time-period").select2();
		$("#time-period").change(function(){
			$("#timeForm").submit();
		});
		$('.sel_auth').click(function(){
			var test = $(this).attr('data-id');
			$("#test").val(test);
			$('#timeForm').submit();
		});
		$("#report").click(function(){
			var t = $("#time-period").val();
			var test = $('.test.active').attr('data-id');
			$.ajax({
				type:'post',
				url: "<?php echo base_url(); ?>reports/exportWebBookings",
				dataType:'json',
				data:{time:t,test:test},
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
</script>