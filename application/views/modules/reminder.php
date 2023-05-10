 <style>
    #remind_date,#remind_time {width: 100px;}
    #remind_text {width: 252px;}
    .error {border: 1px solid red;}
    .task-row { padding-bottom: 5px;margin-bottom: 10px;padding-right: 10px;}
    .task-row:not(:last-child) { border-bottom: 1px solid #f2f2f2;}
    .task-row .task-title b {font-size: 13px;color: #455a64;}
    .task-row .task-title .date {color: #1eb5ad;;font-size: 11px;font-weight: 700;opacity: .75;}
    .task-row .task-title .fa {background: #f5f5f5;width: 30px;height: 30px;line-height: 30px;text-align: center;border-radius: 20px;color: #1eb5ad;cursor: pointer;}
    .task-row .task-title .fa:hover {background: #eee;}
    .task-row .desc {color: #282828b8;}
    .reminder-count {position: absolute;right: 26px;border-radius: 50px;background: #fe832c;color: #fff;top: -2px;border: none;text-align: center;width: 20px;height: 20px;padding: 0;font-size: 10.5px;line-height: 23px;}
    #reminderFeed {max-height: 280px;overflow-y: scroll;overflow: auto;}
    label.status {position:relative; padding:6px; cursor:pointer; color:#4CAF50;float: right;}
    label.status.ignore {color:#F44336;}
    label.status input {position:absolute; visibility:hidden;}
    span.status-label {border-radius:32px; border:2px solid; padding:4px 18px 4px 28px; position:relative;}
    span.radio-icon {border:2px solid; padding:2px; background:#fff; display:inline-block; border-radius:7px; position:absolute; left:12px; top:9px;}
    label.status:hover span.radio-icon {border:4px solid; padding:0;}
    label.status input:checked + .status-label {background:currentColor;}
    label.status input:checked + .status-label .text {color:#fff; position:relative;} 
    label.status input:checked + .status-label .radio-icon {color:#fff;} 
    #reminderFeed .left {width: 50%;float: left;}
    #reminderFeed .right {width: 50%;float: right;}
    .reminder-content-row {margin-top: 15px;}
    input#task {width: 50%;}
    div.company-name{font-size: 13px;padding: 5px 0px;color: #455a64;font-weight: 700;} 
  .ui-autocomplete{
    z-index: 99999;
  }
  .reminder-count{display: none}
</style>
<section class="panel" style="border:0;">
    <div class="panel-body">
    <div class="row">    
    <form class="form-inline" action="<?php echo base_url();?>reminder/save" method="post" id="reminderForm">    
        <div class="form-group col-xs-12 text-right">
            <div class="company-name text-left">Lead name</div>
            <input type="hidden" name="record_id" id="reminder_record_id">
            <input type="text" name="task" id="task" class="form-control" placeholder="Enter Task" required="" autocomplete="off" >
            
            <textarea class="form-control hidden" name="description" placeholder="Enter Description"></textarea>
            <input type="text" name="remind_date" id="remind_date" placeholder="Task Date" class="form-control">
            <input type="text" name="remind_time" id="remind_time" placeholder="Task Time" class="form-control">
            <button type="button" class="btn btn-success" id="saveReminder">Add<i class="fa fa-plus icon-right"></i> </button>
        </div>
    </form>
    </div> 
    <div class="row reminder-content-row">
        <div class="form-group col-xs-12">
            <div class="tab-title"> <span><i class="fa fa-clock"></i>All Reminders </span> (<b class="count">0</b>) </div>
           <div id="reminderFeed">
           </div> 
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $("#remind_date").datepicker({ minDate: 0, });
    $("#remind_time").timepicker({ timeFormat: 'H:i','step': 15});

    $("#saveReminder").click(function(){

      var format = 'MM/DD/YYYY HH:mm'
      timeInEST = moment().tz('America/New_York').format(format)
      rem_time=moment($("#remind_date").val()+' '+$('#remind_time').val()).format(format)

      timeInEST=moment(timeInEST);
      rem_time=moment(rem_time);

      if(rem_time.isBefore(timeInEST)){
        alert('Reminder can not be add in past');
        return ;
      }

      if(!$('#remind_date').val()){
         alert('Please select date');
         return ;
      }
      
      if($("#task").val()){ 
          $("#task").removeClass('error'); 
        $("#reminderForm").ajaxSubmit({
            url:'<?php echo base_url();?>'+'reminder/save',
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.success == true ){
                    $("#reminderForm").trigger("reset");
                     getReminders();
                     getUpcomingReminders();
                }
            }
        });
       }else
       {
        $("#task").addClass('error');
       } 
    });

    function getReminders(){
        $.ajax({
            url:'<?php echo base_url();?>'+'reminder/get',
            type:'get',
            dataType:'json',
            data: { record_id : "<?php echo $current_record_id; ?>" },     
            success:function(data){
            var html = '';
            var count = 0;
               if(data !=''){
                count = data.length;
                $.each(data, function(index, data){
                  //   var date = moment(data.created_at).format('MM/DD/YYYY');
                     if(data.remind_date){
                      var date = moment(data.remind_date).format('MM/DD/YYYY');
                      var time = moment(data.remind_date).format('HH:mm');
                     }else{
                      var date = '';
                      var time = '';
                     }
                     //var time = data.remind_time;
                     var status = data.status == 'completed' ? 'checked' : '';
                     var status2 = data.status == 'ignore' ? 'checked' : '';
                    html += '<div class="task-row" id="'+data.id+'"><div class="task-title clearfix"><div class="left"> <b>'+data.task+'</b><br/> <span class="date"> '+date+' '+time+' by '+data.first_name+' '+data.last_name+'</span></div><div class="right"> <i class="fa fa-trash pull-right delete_reminder" id="'+data.id+'" title="Delete"></i> <label id="'+data.id+'" class="ignore status" title="Mark completed"> <input type="radio" name="status'+data.id+'" class="status-checkbox" value="ignore" '+status2+'><span class="status-label"><span class="radio-icon"></span><span class="text"> Ignore</span></span> </label> <label id="'+data.id+'" class="completed status" title="Mark Ignore"> <input type="radio" name="status'+data.id+'" class="status-checkbox" value="completed" '+status+'><span class="status-label"><span class="radio-icon"></span><span class="text">Completed</span></span> </label></div><div class="desc">'+data.description+'</div></div></div>';
                });
               }else{
                html +=  '<p>No reminder available</p>';
               }
             console.log(html);
             $(".count,.reminder-count").text(count);
             if(count > 0){
                $(".reminder-count").show();
             }else{
                $(".reminder-count").hide();
             }  
             $("#reminderFeed").html(html);  
            }
        });
    }
    getReminders();
    $(document).on('click','.delete_reminder',function(){
        var r = confirm('Are sure you want to remove this reminder ?');
        if(r == true){
            var id = $(this).attr('id');
            $.ajax({
            url:'<?php echo base_url();?>'+'reminder/delete/'+id,
            type:'get',
            dataType:'json',     
            success:function(data){
               if(data.success == true){
                 getReminders();
               }
            }
          });
        }
    });
     $(document).on('click','.status',function(){
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
                getReminders();
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
});
</script>
 <script>
  $(document).ready(function(){
        $(function () {
            var availableTags = [
              "Call back",
              "Send Intro Letter",
              "Send Video",
              "Wish Happy Birthday",
              "Wish Merry Christmas",
              "Wish Happy Thanksgiving",
              "Follow-up on Email"
            
            ];
            $("#task").autocomplete({
                source: availableTags
            });
        });
  })
    </script>