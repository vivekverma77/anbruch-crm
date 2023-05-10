</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo base_url() ?>static/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?php echo base_url() ?>static/js/skycons/skycons.js"></script>
<!--<script src="<?php /*echo base_url() */?>static/js/jquery.scrollTo/jquery.scrollTo.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!--<script src="<?php /*echo base_url() */?>static/js/calendar/clndr.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<!--<script src="<?php /*echo base_url() */?>static/js/calendar/moment-2.2.1.js"></script>
<script src="<?php /*echo base_url() */?>static/js/evnt.calendar.init.js"></script>-->

<!--<script src="<?php /*echo base_url() */?>static/js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php /*echo base_url() */?>static/js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="<?php /*echo base_url() */?>static/js/gauge/gauge.js"></script>-->

<!--clock init-->
<!--<script src="<?php /*echo base_url() */?>static/js/css3clock/js/css3clock.js"></script>-->

<!--Easy Pie Chart-->
<!--<script src="<?php /*echo base_url() */?>static/js/easypiechart/jquery.easypiechart.js"></script>-->

<!--Sparkline Chart-->
<!--<script src="<?php /*echo base_url() */?>static/js/sparkline/jquery.sparkline.js"></script>-->

<!--Morris Chart-->
<!--<script src="<?php /*echo base_url() */?>static/js/morris-chart/morris.js"></script>
<script src="<?php /*echo base_url() */?>static/js/morris-chart/raphael-min.js"></script>-->

<!--<script src="<?php /*echo base_url() */?>static/js/dashboard.js"></script>-->
<!--<script src="<?php /*echo base_url() */?>static/js/jquery.customSelect.min.js" ></script>-->
<!--common script init for all pages-->
<!--<script src="<?php /*echo base_url() */?>static/js/scripts.js"></script>-->
<!--script for this page-->
<!-- Custom styles for this template -->
<link href="<?php echo base_url() ?>static/css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment-timezone.js"></script>
<audio autostart="0" class='player_audio' style="display: none;" src='<?php echo base_url()?>assets/audio/sound.mp3'></audio>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
function load_reminder(){
  $("#reminder_table").DataTable({
        "ordering":false,
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": true,
        "bAutoWidth": false,
        "oLanguage": {
              "sEmptyTable": "No upcoming reminder available",
              "sSearchPlaceholder": "",
              "sProcessing": "<div align='center'><img style='position:relative;top: -50px;width: 64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>"},
        "sAjaxSource": "<?php echo base_url() ?>" + "reminder/loadReminder",
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true,      
  });
}
moment.tz.add([
   'America/New_York|EST EDT|50 40|0101|1Lz50 1zb0 Op0'
]);	
	//get upcoming reminder
   function getUpcomingReminders(){

        $.ajax({
            url:'<?php echo base_url();?>'+'reminder/getUpcoming',
            type:'get',
            dataType:'json',     
            success:function(data){ 
            var html = '';
            var count = 0;
            if(data !='')
                count = data.length;
            $(".top-reminder-count").text(count);  
            if(count > 0){
               $(".top-reminder-count").show();
            }else{
               $(".top-reminder-count").hide();
            }
            $("#reminder-popup .numbers").text('('+count+')');  
            
            if(data !=''){
                $.each(data, function(index, data){
                     if(data.remind_date){ 
                        var date   = new Date(data.remind_date),
                        yr      = date.getFullYear(),
                        month   = date.getMonth()+1,
                        day     = date.getDate(),
                        newDate = month + '/' + day +'/'+ yr ;
                      
                        var rem_time = getTime(data.remind_date);
                        var format = 'MM/DD/YYYY HH:mm'
                       
                        timeInEST = moment().tz('America/New_York').format(format)
                    
                        var time = moment(newDate+' '+rem_time).format(format)
                        time=moment(time)
            					
                        timeInEST=moment(timeInEST);
                        if (time.isSame(timeInEST)) {
                          load_reminder();
                          $('.player_audio')[0].play();
            							$("#reminder-popup").addClass("open");
                          setTimeout(function(){
                              $("#reminder-popup").removeClass("open");
                          },7000)
            							
            						}
                	}
            	})
             }
           }
        });
    }
setInterval(function(){ 
 getUpcomingReminders();
}, 15000);
getUpcomingReminders();
$("#nav-reminder").click(function(){
    load_reminder();
    $("#reminder-popup").toggleClass("open");
    getUpcomingReminders();
});

$("#reminder-popup-close").click(function(){
  $("#reminder-popup").removeClass("open");
});
$(document).on('click','.reminder-item .r-status',function(){
         var r = confirm('Are sure you want to perform this action ?');
        if(r == true){
            var val = $(this).find('input').val();
            var id = $(this).attr('id');
            $.ajax({
            url:'<?php echo base_url();?>'+'reminder/response/'+id + '/'+val,
            type:'get',
            dataType:'json',     
            success:function(data){
              console.log(data);
               if(data.success == true){
                getUpcomingReminders();
                load_reminder();
               }
             }
           });
            return false;
          }else
          {
            var val = $(this).find('input').prop("checked", false);
            return false;
          }             
    });
function getTime(str)
{
   var date   = new Date(str),
   hr = date.getHours(),
   min = date.getMinutes(),
   //ss = hr < 12 ? ' am' : ' pm';
   //hr =+ hr % 12 || 12;
   min = min < 1 ? '0'+min : min;
   return hr+':'+min;
 }


//$('#toggleIcon').click();


</script>