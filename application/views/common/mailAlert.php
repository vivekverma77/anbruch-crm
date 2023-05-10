<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link href="<?php echo base_url(); ?>assets/css/sweetalert2.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/sweetalert2.all.min.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		var status = "<?php echo $status; ?>";
		if(status == 2)
		{
			Swal.fire({
	            type: 'warning',
	            title: 'Warning',
	            text: "<?php echo $message; ?>",
	            customClass: {
	            popup: 'animated swing'
	            },
	            animation: false,  
			}).then(function(){
				window.close();
			});
		}
		if(status == 1)
		{
			Swal.fire({
	            type: 'success',
	            title: 'Thank You',
	            text: "<?php echo $message; ?>",
	            customClass: {
	            popup: 'animated swing'
	            },
	            animation: false,  
			}).then(function(){
				window.close();
			});
		}
	});
</script>
</html>