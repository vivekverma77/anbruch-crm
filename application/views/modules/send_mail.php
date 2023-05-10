<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">

    <meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
    <meta http-equiv=”X-UA-Compatible” content=”IE=9”>

    <link rel="shortcut icon" href="<?php echo base_url() ?>static/images/favicon.ico">
    <title><?php echo $title; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url() ?>static/minified_master/mVersion12.css"/>
    <script type="text/javascript" src="<?php echo base_url() ?>static/minified_master/mVersion12.js"></script>       

    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet"/>
    	
    <!-- Custom styles for this template -->
		<link href="<?php echo base_url() ?>static/css/my.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>static/js/jquery.nicescroll.js"></script>

    <style>
			.form-control{  color: #000; }
			.file_uploader {
			    border: 2px dashed #ccc;
			    background: #f1f3f4;
			    padding: 24px;
			    position: relative;
			    text-align: center;
			    font-size: 20px;
			}
			.file_uploader input {
				position: absolute;
			    width: 100%;
			    height: 100%;
			    left: 0;
			    top: 0;
			    opacity: 0;
			    cursor: pointer;
			}
			.file_uploader:hover {
			    background: #f0f0f0;
			    border-color: #bbb;
			}
		</style>

	</head>
	<body class="">
		<section class="panel">
			<div class="panel-body">     
				<form id="frmSendMail" action="<?php echo base_url()."reports/sendMail"; ?>" method="post" enctype="multipart/form-data">
				
						<input type="hidden" name="from" value="<?php echo @$fromemail; ?>"/>
						<input type="hidden" name="action" value="<?php echo @$action; ?>"/>
						<input type="hidden" name ="record_id" value = '<?php echo $record_id?>'/>
						<input type="hidden" name ="module_name" value = '<?php echo $module_name?>'/>


						<div class="form-group col-lg-12" style="height:50px;">
									
							<div class="col-lg-6" style="width: 74%;float: left;">
								<img src="<?php echo $user_data['profile_picture']; ?>" style="width: 50px;height: 50px;border-radius: 50%;margin-right: 7px;"><?php echo @$fromemail; ?>
							</div>
							
							<div class="col-lg-6" style="width: 25%;float: right;">						
								<!--label for="choose">Choose Template:</label-->
								<select class="form-control" name="template" id="template">
									<option value="">Choose Template</option>
									<?php if(!empty($templates)) {
											foreach($templates as $template){
												$slug = str_replace("_"," ",$template['slug'])
									?>
										<option value="<?php echo $template['slug']; ?>"><?php echo ucwords($slug); ?></option>
									<?php
										}
									} ?>
								</select>
							</div>
						</div>
						
						<div class="form-group col-lg-12" style="">												
							<label for="to">To</label>
							<input type="text" class="form-control" name="to" id="to" value="<?php echo @$toemail; ?>">
							<span class="bcc" style="cursor:pointer;margin-right: 5px;">Bcc</span>
							<span class="cc"  style="cursor:pointer;">Cc</span>
						</div>	
							
						<div class="form-group col-lg-12 cc_dv" style="display:none;">												
							<label for="cc">Cc</label><input type="text" class="form-control" name="cc" id="cc" value="">
						</div>	
							
						<div class="form-group col-lg-12 bcc_dv" style="display:none;">												
							<label for="cc">Bcc</label><input type="text" class="form-control" name="bcc" id="bcc" value="">
						</div>	
							
						<div class="form-group col-lg-12" style="">												
							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
						</div>	
							
						<div class="form-group col-lg-12" style="">												
							<textarea style="padding: 10px !important; border: 1px solid #cccccc !important; width:100%; height:300px !important" name="message" class="form-control" required="required" id="message" placeholder=""></textarea>
						</div>
						<div class="form-group col-lg-12">
                   		  <label class="control-label">Attachment</label>
		                  <div class="controls">
		                    <div class="file_uploader">
		                      <input type="file" name="file" id="file">
		                      <span class="value"></span>
		                      <span class="default">
		                        <i class="fa fa-upload"></i>
		                        <span class="choose">Choose a file</span> or Drag and drop
		                      </span>
		                    </div>
		                  </div>
		                </div>
						<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" class="ajax-loader" style="position: fixed;top: 130px;left: 378px;display: none;">
						<div class="form-group col-lg-6 text-center">
							<button type="button" class="btn btn-info btnSendMail"><i class="fa fa-share"></i> Send</button>
						</div>
						
				</form>
				
			</div>
		</section>
	</body>
</html>

<style>
.cke_inner { 
    border: 1px solid #e2e2e4;
}
</style>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> 
<script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script>
<script> 

$(document).ready(function() {  
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.extraAllowedContent = 'iframe(*)';
    CKEDITOR.replace('message',{
		height: '500px',
		filebrowserImageUploadUrl : '<?php echo base_url()."Modules/email_imageUpload"; ?>',
		filebrowserUploadUrl:'<?php echo base_url()."Modules/email_imageUpload"; ?>',
		image_previewText : CKEDITOR.tools.repeat( ' ', 100 )
	})
	alert(CKEDITOR.instances.yourInstance.filter.check( 'iframe' ));
 
}); 


// $('#cke_Upload_132').bind(function(){
// 	alert('here');
// 	chngval();
// });

// function chngval(){
//     $('.cke_dialog_ui_fileButton.cke_dialog_ui_button').text(function(i, oldText) {
//         return oldText === 'Send it to the Server' ? 'New word' : oldText;
//     });
//    }




	CKEDITOR.on( 'dialogDefinition', function( evt ) {


    var dialog = evt.data;
    console.log(dialog);
    if ( dialog.name == 'image' ) {
        // Get dialog we want
        var def = evt.data.definition;

        //Get The Desired Tab Element
        var infoTab = def.getContents( 'Upload' );
        //var img =  infoTab.remove( 'htmlPreview' );
        console.log(infoTab);
        //console.log(evt.dialog.definition.hbox());

        //Add Our Button
        // infoTab.add( {
        //     type: 'button',
        //     id: 'buttonId',
        //     label: 'Compress Image',
        //     title: 'My title',
        //     onClick: function() {
        //         //Here define what to do when button is clicked.
        //         //In my case, I traverse and get the inputs (dirty way).
        //           var url = $(".cke_dialog_ui_vbox_child .cke_dialog_ui_text .cke_dialog_ui_labeled_content .cke_dialog_ui_input_text .cke_dialog_ui_input_text").eq(0).val();
        //           var width = $(".cke_dialog_ui_vbox_child .cke_dialog_ui_text .cke_dialog_ui_labeled_content .cke_dialog_ui_input_text .cke_dialog_ui_input_text").eq(2).val();
        //           var height = $(".cke_dialog_ui_vbox_child .cke_dialog_ui_text .cke_dialog_ui_labeled_content .cke_dialog_ui_input_text .cke_dialog_ui_input_text").eq(3).val();

        //         //Then I perform an ajax call to a Php file                             
        //           $.ajax({ 
        //             url: 'path/to/compress.php',
        //             data: { 
        //                 url: url,
        //                 width: width,
        //                 height: height,
        //                 },
        //             type: 'post',
        //             success: function(output) {
        //                 alert(output);
        //                 }
        //             });
        //     }
        // });
    }
} );
</script>

<!-- <script>
	CKEDITOR.replace( 'message', {
    filebrowserBrowseUrl: '/browser/browse.php',
    filebrowserUploadUrl: '/uploader/upload.php'
});
	</script> -->

<script>

	$("#template").on("change",function()
	{
		var slug = $(this).val();
		$.ajax({
			url:  '<?php echo base_url()."emailtemplates/getTemplateBySlug"; ?>',
			type: "POST",
			data: { "slug":slug },
			beforeSend: function() {
				$("#subject").val("");
				CKEDITOR.instances['message'].setData("");
			},
			success: function(result)
			{
				//console.log(result);
				var result =JSON.parse(result);
				//console.log(result);

				var title = result.title;
				console.log(result.template);
				var template = result.template;
				console.log(template);
				$("#subject").val(title);
				
				CKEDITOR.instances['message'].setData(template);		
		
			}	
		});
		
		
	});
	
	$('.btnSendMail').click(function()
	{		
		console.log('clicked');
		var to = $('#to').val();
		console.log(to);
		if(to=='')
		{
			alert(' "To" address cannot be empty.');
			return;
		}
	
		var subject = $('#subject').val();
		console.log(to);
		if(subject=='')
		{
			alert(' "Subject" cannot be empty.');
			return;
		}
	
		var message = CKEDITOR.instances.message.getData();
		console.log(to);
		if(message=='')
		{
			alert(' "Template" cannot be empty.');
			return;
		}
		
		for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

		var url ="";
    sendEmailWindow = window.open(url, 'Send Email', "width=1000,height=600");
    
		/*var frmdata = $('#frmSendMail').serializeArray();
		$.ajax({
			url:  '<?php echo base_url()."reports/sendMail"; ?>',
			type: "POST",
			data: frmdata,
			//processData: false,
            contentType: false,
			beforeSend: function() {
				
			},
			success: function(result)
			{
				console.log(result);
				if(result=="sent")
				{
					$("#subject").val("");					
					CKEDITOR.instances['message'].setData("");
					alert("Email sent successfully.");
					setTimeout(function()
					{
						sendEmailWindow.close();
					}, 1000);
					
					
				}
				else if(result=="not_sent")
				{
					alert("Email not sent! please try again later.");	
				}
				
			}	
		});	*/
		$(".ajax-loader").show();
		$("#frmSendMail").ajaxSubmit({
			 //dataType: 'json',
			success:function(result){
				console.log(result);
				$(".ajax-loader").hide();
				if(result=="sent")
				{
					$("#subject").val("");					
					CKEDITOR.instances['message'].setData("");
					alert("Email sent successfully.");
					setTimeout(function()
					{
						sendEmailWindow.close();
					}, 1000);
					
					
				}
				else if(result=="not_sent")
				{
					alert("Email not sent! please try again later.");	
				}
			}
		});
	
	});
	
	$('.cc').click(function(){
		$(this).hide();
		$('.cc_dv').show();	
	});
	$('.bcc').click(function(){
		$(this).hide();
		$('.bcc_dv').show();	
	});
 $('.file_uploader #file').click(function(e){
      $('.file_uploader .value').text('');
    });
    $('.file_uploader #file').change(function(e){
        var fileName = e.target.files[0].name;
        $('.file_uploader .value').text(fileName);
    });
</script>

