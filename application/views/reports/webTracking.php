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
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">
		<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Web Tracking </span></h3>
		<!-- <button type="button" class="btn reportbtn" id="report" style="float:right;margin:40px 4px 0px 0px;font-size:15px;">Export Report</button> -->
		<!-- <form action="<?php echo base_url(); ?>reports/webBookings" type="get" name="time-period" id="timeForm">
			<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
				<label for="time-period" style="font-size:14px;">New Records</label>
				<select name="t" id="time-period">
					<option value="" >Choose response</option>
					<option value="week" <?php if(isset($_GET['t']) && $_GET['t'] == 'week'){ echo "selected"; } ?> >This Week</option>
					<option value="month" <?php if(isset($_GET['t']) && $_GET['t'] == 'month'){ echo "selected"; }?> >This Month</option>
					<option value="year" <?php if(isset($_GET['t']) && $_GET['t'] == 'year'){ echo "selected"; } ?> >This Year</option>
				</select>
				<input type="hidden" id="test" name="test" value="<?php //echo $test; ?>" />
			</div>
		</form> -->
		
		<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;flex-wrap:wrap;">
	  		<!-- canvas_one -->
	  		<div class="col-xs-6 main-cols col-left" style="margin:15px 0;">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">1. Book Vs. Finish Vs. Not Finish</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Records <?php echo $total; ?></h6>
	                    <canvas id="canvas_one"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
	        <!-- canvas one -->
	        <!-- canvas_two -->
	        <div class="col-xs-6 main-cols col-left" style="margin:15px 0;">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">2. Comparison Chart for Test-Canadian Customs Duties</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Records <?php echo $total_CCD; ?></h6>
	                    <canvas id="canvas_two"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
			<!-- canvas_two -->
			<!-- canvas_three -->
			<div class="col-xs-6 main-cols col-left" style="margin:15px 0;">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">3. Comparison Chart for Test-Canadian Sales Tax (GST/HST)</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Records <?php echo $total_CST; ?></h6>
	                    <canvas id="canvas_three"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
			<!-- canvas_three -->
			<!-- canvas_four -->
			<div class="col-xs-6 main-cols col-left" style="margin:15px 0;">
	            <div style="margin-left:-15px;">
	              <div style="background:#fff;">
	                <div class="content-title">4. Comparison Chart for Test-Canadian Govt Incentives</div>  
	                 <div id="booking-WEB" class="collapse in" style="padding-bottom:15px;">
	                    <h6 style="text-align:center;">Total Records <?php echo $total_CGI; ?></h6>
	                    <canvas id="canvas_four"></canvas> 
	                 </div>
	              </div>
	            </div>
	        </div>
			<!-- canvas_four -->

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
	/*$("#time-period").change(function(){
		$("#timeForm").submit();
	});*/


	/*Chart js*/
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

    /*canvas_one*/
    var ctx = document.getElementById('canvas_one').getContext('2d');
	var color_one = new Array();
	var canvas_one = <?php echo json_encode($canvas_one); ?>;
	for(var i=0; i< 3; i++)
	{
		color_one.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
	}
    var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
		    labels:['Book', 'Finish', 'Not Finish'],
		    datasets: [{
		    	label: ['Book', 'Finish', 'Not Finish'],
		    	data: canvas_one,
		    	backgroundColor: color_one,
		   		borderWidth: 1,
		        beginAtZero: true,
		    }],
		},
		options: q1Options
    });
    /*canvas_one*/
    var chart_background = [
       // 'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)'
    ];
    
    var ctx2 = document.getElementById('canvas_two').getContext('2d');
    var canvas_two = <?php echo json_encode($canvas_two); ?>;
	var myChart2 = new Chart(ctx2, {
	    type: 'bar',
	    data: {
	        labels: ['Que.1', 'Que.2', 'Que.3', 'Que.4', 'Que.5', 'Que.6', 'Que.7', 'Que.8', 'Que.9', 'Que.10'],
	        datasets: [{
	            label: 'Target: 10',
	            data: canvas_two,
	            backgroundColor: chart_background,
	            borderColor: chart_background,
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                },
	                 minBarLength: 2,
	                stacked: false,
	                 scaleLabel: {
	                     display: true,
	                     labelString: 'Answers'
	                }
	            }],
	            xAxes: [{
	                 scaleLabel: {
	                     display: false,
	                     labelString: 'Test Name'
	                }
	            }]
	        }
	    }
	 });

	var ctx3 = document.getElementById('canvas_three').getContext('2d');
    var canvas_three = <?php echo json_encode($canvas_three); ?>;
	var myChart3 = new Chart(ctx3, {
	    type: 'bar',
	    data: {
	        labels: ['Que.1', 'Que.2', 'Que.3', 'Que.4', 'Que.5', 'Que.6', 'Que.7', 'Que.8', 'Que.9', 'Que.10'],
	        datasets: [{
	            label: 'Target: 10',
	            data: canvas_three,
	            backgroundColor: chart_background,
	            borderColor: chart_background,
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                },
	                 minBarLength: 2,
	                stacked: false,
	                 scaleLabel: {
	                     display: true,
	                     labelString: 'Answers'
	                }
	            }],
	            xAxes: [{
	                 scaleLabel: {
	                     display: false,
	                     labelString: 'Test Name'
	                }
	            }]
	        }
	    }
	 });

	var ctx4 = document.getElementById('canvas_four').getContext('2d');
    var canvas_four = <?php echo json_encode($canvas_four); ?>;
	var myChart4 = new Chart(ctx4, {
	    type: 'bar',
	    data: {
	        labels: ['Que.1', 'Que.2', 'Que.3', 'Que.4', 'Que.5', 'Que.6', 'Que.7', 'Que.8', 'Que.9', 'Que.10'],
	        datasets: [{
	            label: 'Target: 10',
	            data: canvas_four,
	            backgroundColor: chart_background,
	            borderColor: chart_background,
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                },
	                 minBarLength: 2,
	                stacked: false,
	                 scaleLabel: {
	                     display: true,
	                     labelString: 'Answers'
	                }
	            }],
	            xAxes: [{
	                 scaleLabel: {
	                     display: false,
	                     labelString: 'Test Name'
	                }
	            }]
	        }
	    }
	 });
});
</script>