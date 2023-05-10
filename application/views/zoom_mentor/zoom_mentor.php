<!DOCTYPE html>
<html>
<head>
  <title>Anbruch Video</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/zoom_mentor/fevicon.png" type="image/gif">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/9b697bdfde.js"></script>


  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/zoommentor.css">
  <style type="text/css">
  	/*#banner {background-image:url("<?php echo base_url(); ?>/assets/images/zoom_mentor/banner.jpg"); padding:15px; height:650px;}*/
  	@font-face {
    font-family: Gilroy;
    src: url("<?php echo base_url(); ?>/assets/images/zoom_mentor/Gilroy-Regular.otf");
	}
	@font-face {
	   font-family: Gilroy;
	   src: url("<?php echo base_url(); ?>/assets/images/zoom_mentor/Gilroy-Bold.otf");
	   font-weight: 700;
	}
	@font-face {
	   font-family: Gilroy;
	   src: url("<?php echo base_url(); ?>/assets/images/zoom_mentor/Gilroy-Semibold.otf");
	   font-weight: 600;
	}
	@font-face {
	   font-family: Gilroy;
	   src: url("<?php echo base_url(); ?>/assets/images/zoom_mentor/Gilroy-Medium.otf");
	   font-weight: 500;
	}
	.banner-overlay {position: absolute;width: 560px;height: 58px;background-image: linear-gradient(to right, rgb(0,0,0,0), rgb(0,0,0,0.7) 50%, rgb(0,0,0,1));top: 0px;left: 0;}
	.modal-backdrop.show { opacity: 0.75; }
	#videoModal .modal-content { background-color:transparent;width: 900px;position: relative;right: 200px;border-color:transparent; }
	#videoModal .modal-header { border:none; }
	#videoModal .close { color:lightgray;font-size: 49px;font-weight: 450;margin-right:-45px; }
	.search .google_search { width:220px;display:inline-block;padding: 0 10px; height:30px; vertical-align: middle;    transform: scale(0,1);transition: 0.4s linear;transform-origin: right; }
	.search .google_search.open { display: inline-block !important;    width: 220px !important;
	    transform: scale(1) !important;background: transparent; border:none;border-bottom: 1px solid white;color:white;margin-left:20px; }   
	.search .google_search.open:focus{ box-shadow: 0 0 0 0 rgba(0,123,255,.25); }
	.search .google_search.open::placeholder{ color: white; }
	.search a { float:right;margin: 6px 0px;position: relative;right:30px;color:#F44336 !important;}
	.banner-centent.text-center{ position: relative;color:#fff;text-shadow:0px 0px 20px #000; }
	#banner { height:900px; }
	#banner video { position: absolute;top:0; }
	#video .col-md-6.col-sm-12 { height: 330px; }
	#video .box { height:290px; }.flip-card {background-color: transparent;perspective: 1000px;}
	.flip-card-inner {position: relative;width: 100%;height: 100%;text-align: center;transition: 0.6s ease-in-out;transform-style: preserve-3d;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);}
	#video .box:hover .flip-card-inner {transform: rotateY(180deg);transition: 0.6s ease-in-out;}
	.flip-card-front, .flip-card-back {position: absolute;width: 100%;height: 229px;backface-visibility: hidden;}
	.flip-card-front {background-color: #bbb;color: black;}
	.flip-card-back {background-color: #f24210d1;color: white;transform: rotateY(180deg);height:290px;padding-top: 80px;}
	.play_video { position: absolute;left:48%; top:64%;font-size:50px;opacity: 0.8;z-index:999; }.flip-card-back a { color: white;border: 1px solid #fff;padding: 10px 20px;text-decoration: none;background: #ce3b12; }
	.picture_in_picture_video { position: absolute;left:95%; top:106%;font-size:28px;opacity: 1;transform: rotate(180deg);display: none;}
	.picture_in_picture_video:hover{ color:#ff5901;transition: 0.3s }
	.flip-card-back a:hover { background: #FFF !important;color: #ce3b12 !important;transition: 0.6s;}
</style>
</head>
<body>
<div id="banner">
	<video width="1350"  id="banner_video" muted poster="<?php echo base_url(); ?>assets/images/zoom_mentor/banner-2.jpg" >
		  <source src="<?php echo base_url(); ?>assets/images/zoom_mentor/banner-preview.mp4" type="video/mp4">
		  Your browser does not support the video.
	</video>
	<!-- <span class="picture_in_picture_video"><i class="fa fa-window-maximize"></i></span> -->
	<!-- <span class="play_video"><i class="fa fa-play-circle"></i></span> -->
<div class="container">
     <nav>
	     <div class="brand text-center">
		     <a href="#"><img src="<?php echo base_url(); ?>assets/images/zoom_mentor/logo.png" alt="anbruch-logo"></a>
		 </div>
		 <div class="nav-btn">
		 	<div class="search" style="margin:0; width:280px;padding: 10px 5px;">
			    <form action="https://www.google.com/search" id="searchform" class="searchform" method="get" name="searchform" target="_blank">
					<input name="sitesearch" type="hidden" value="">
					<input autocomplete="on" class="form-control google_search" name="q" placeholder="Search" required="required"  type="text">
					<a href="#" title="Search"><i class="fa fa-search"> </i></a>
				</form>
		    </div>
			
		    <!--  <div class="log-in">
			     <a href="#">LOG IN</a>
			 </div> -->
		 </div>
	 </nav>
     <div class="banner-centent text-center">
	     <h1>LOREM IPSUM DUMMY TEXT</h1>
		 <h4>Lorem Ipsum is simply dummy text.</h4>
		 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply<br>
            dummy text of the printing and typesetting industry.
		 </p>
		 <div class="banner-ntn">
		     <button type="button" class="btn watch">WATCH NOW</button>
		     <button type="button" class="btn learn">LEARN MORE</button>
		 </div>
	 </div>
</div>
</div>
<!-- video modal -->
<div class="modal" id="videoModal" tabindex="-1" data-backdrop="static" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
    </div>
      <div class="modal-body">
        <video width="900" height="450" controls autoplay loop muted poster="<?php echo base_url(); ?>assets/images/zoom_mentor/favicon.png">
		  <source src="<?php echo base_url(); ?>assets/images/zoom_mentor/banner.mp4" type="video/mp4">
		  Your browser does not support the video.
		</video>
      </div>
    </div>
  </div>
</div>
<!-- video modal -->
<div class="container" id="welcome">
     <div class="row">
	     <div class="col-lg-6 col-md-12 welcome-text">
		     <div>
			     <h4>ABOUT LOREM IPSUM</h4>
				 <h1>What It Is All About</h1>
				 <p>
				     Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                     Lorem Ipsum has been the industry's standard dummy text ever since the
                     1500s, when an unknown printer took a galley of type and scrambled it to
                     make a type specimen book. It has survived not only five centuries, but also
                     the leap into electronic typesetting, remaining essentially unchanged.
				 </p>
				 <button type="button" class="btn">EXPLORE</button>
			 </div>
		 </div>
		 
	     <div class="col-lg-6 col-md-12 welcome-video">
		     <div>
		     	<iframe width="540" height="375" src="https://www.youtube.com/embed/Cbk980jV7Ao?" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			 </div>
		 </div>
	 </div>
</div>

<div class="container text-center" id="video">
     <h2>ALL VIDEOS</h2>
	 <div class="row">
	     <div class="col-md-6 col-sm-12">
		     <div class="box">
	     		<div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-1.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>JAMES POTTER</h1> 
					      <p>Lorem Ipsum The Dummy Text</p>
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
	     		</div>
			</div>
		 </div>
		 <div class="col-md-6 col-sm-12">
		     <div class="box">
			     <div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-2.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>Erik Lehnsherr</h1> 
					      <p>Lorem Ipsum The Dummy Text</p> 
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
	     		</div>
			 </div>
		 </div>
		 <div class="col-md-6 col-sm-12">
		     <div class="box">
			    <div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-3.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>ROSE RAYMON</h1> 
					      <p>Lorem Ipsum The Dummy Text</p> 
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
	     		</div>
			 </div>
		 </div>
		 <div class="col-md-6 col-sm-12">
		     <div class="box">
			    <div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-4.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>JAMES PARKER</h1> 
					      <p>Lorem Ipsum The Dummy Text</p> 
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
			 	</div>
		 	</div>
		 </div>
		 <div class="col-md-6 col-sm-12">
		     <div class="box">
			    <div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-5.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>BOBBY DRAKE</h1> 
					      <p>Lorem Ipsum The Dummy Text</p> 
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
	     		</div>
			 </div>
		 </div>
		 <div class="col-md-6 col-sm-12">
		     <div class="box">
			    <div class="flip-card">
	     			<div class="flip-card-inner">
	     				<div class="flip-card-front">
			     			<img class="video" src="<?php echo base_url(); ?>assets/images/zoom_mentor/p-6.jpg">
			     		</div>
			     		<div class="flip-card-back">
					      <h1>JEAN GREY</h1> 
					      <p>Lorem Ipsum The Dummy Text</p> 
					      <a href="<?php echo base_url(); ?>ZoomMentor/view">GET ACCESS</a> 
					    </div>
					</div>    
	     		</div> 
			 </div>
		 </div>
	 </div>
</div>

<div class="container" id="testimony">
     <div class="text-center"><h2>TESTIMONIALS</h2></div>
	 <div class="row">
	     <div class="col-lg-4 col-md-6 col-sm-12 box">
		     <div class="content">
			     <p class="testimony-text text-center">
				     Lorem Ipsum is simply dummy text
                     of the printing and typesetting
                     industry. Lorem Ipsum has been the
                     industry's standard dummy text ever
                     since the 1500s, when an unknown
                     printer took a galley of type and
                     scrambled it to make a type
                     specimen book.
				 </p>
				 <div class="person">
				     <div class="image">
					     <img src="<?php echo base_url(); ?>assets/images/zoom_mentor/person-1.jpg">
					 </div>
					 <div class="name">
					     <h4>Ginny Weasley</h4>
						 <p>Manager, ABC</p>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-lg-4 col-md-6 col-sm-12 box">
		     <div class="content">
			     <p class="testimony-text text-center">
				     Lorem Ipsum is simply dummy text
                     of the printing and typesetting
                     industry. Lorem Ipsum has been the
                     industry's standard dummy text ever
                     since the 1500s, when an unknown
                     printer took a galley of type and
                     scrambled it to make a type
                     specimen book.
				 </p>
				 <div class="person">
				     <div class="image">
					     <img src="<?php echo base_url(); ?>assets/images/zoom_mentor/person-2.jpg">
					 </div>
					 <div class="name">
					     <h4>Ron Weasley</h4>
						 <p>Manager, ABC</p>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-lg-4 col-md-6 col-sm-12 box">
		     <div class="content">
			     <p class="testimony-text text-center">
				     Lorem Ipsum is simply dummy text
                     of the printing and typesetting
                     industry. Lorem Ipsum has been the
                     industry's standard dummy text ever
                     since the 1500s, when an unknown
                     printer took a galley of type and
                     scrambled it to make a type
                     specimen book.
				 </p>
				 <div class="person">
				     <div class="image">
					     <img src="<?php echo base_url(); ?>assets/images/zoom_mentor/person-3.jpg">
					 </div>
					 <div class="name">
					     <h4>Hermione Granger</h4>
						 <p>Manager, ABC</p>
					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
</div>
<div id="footer">
     <div class="container">
	     <div class="row">
		     <div class="col-md-4">
			     <div class="foot-about">
				     <img src="<?php echo base_url(); ?>assets/images/zoom_mentor/logo.png">
					 <p>
					     Lorem Ipsum is simply dummy text of the printing
                         and typesetting industry. Lorem Ipsum has been the
                         industry's standard dummy text ever since the 1500s,
                         when an unknown printer took a galley of type and
                         scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text.
					 </p>
				 </div>
			 </div>
			 <div class="col-md-4">
			     <div class="foot-contact">
				     <div class="foot-head">
					     <h6>CONTACT US</h6>
					 </div>
					 <ul class="contact-ul">
					     <li>
						     <i class="fa fa-map-marker"></i>
							 25 The Esplanade<br>
                             PO Box 122 Stn A|<br>
                             Toronto ON, M5W 1A2
						 </li>
						 <li>
						     <i class="fa fa-phone"></i>
							 1-800-344-2627
						 </li>
						 <li>
						     <i class="fa fa-phone"></i>
							 416-687-2TAX (2829)
						 </li>
						 <li>
						     <i class="fa fa-fax"></i>
							 416-900-6TAX (6829)
						 </li><li>
						     <i class="fa fa-envelope-o"></i>
							 info@anbruch.com
						 </li>
					 </ul>
				 </div>
			 </div>
			 <div class="col-md-4">
			     <div class="foot-mail">
				     <div class="foot-head">
					     <h6>STAY UP TO DATE WITH US</h6>
					 </div>
					 <form>
                         <label for="demo">Subscribe to our news and get latest news and update of us</label>
                         <div class="input-group mt-3">
                             <input type="text" class="form-control" placeholder="Email" id="demo" name="email">
                             <div class="input-group-append">
                                 <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
                             </div>
                         </div>
                     </form>
				 </div>
			 </div>
		 </div>
		 <div class="foot-bottom">
		     <div class="copyright">
			     <p>CopyRight© 2019 Anbrunch . All Rights Reserved.</p>
			 </div>
			 <div class="social ml-auto">
			     <a href="#"><i class="fa fa-facebook"></i></a>
			     <a href="#"><i class="fa fa-twitter"></i></a>
			     <a href="#"><i class="fa fa-linkedin-square"></i></a>
			     <a href="#"><i class="fa fa-instagram"></i></a>
			     <a href="#"><i class="fa fa-youtube-play"></i></a>
			 </div>
		 </div>
	 </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#banner_video").get(0).play();
		$(".btn.watch").click(function(){
			$("#videoModal").modal();
		});
		$(".search a").click(function(){
			if($(".search .google_search").hasClass('open'))
			{
				if($(".google_search").val().trim())
				{
					$("#searchform").submit();
				}
				else
				{
					$(".search .google_search").removeClass('open');
				}
			}
			else
			{
				$(".search .google_search").addClass('open');
			}
		});
		/*$("#banner_video, .play_video").click(function(){
			$(".play_video").css('display', 'none');
			$("#banner_video").get(0).play();
			$(".picture_in_picture_video").css('display', 'block');
		});*/
		$("#banner_video").on('ended', function(){
			$(this).get(0).load();
			/*$(".play_video").css('display', 'block');
			$(".picture_in_picture_video").css('display', 'none');*/
		});
	});
	var pipButtonElement = document.getElementsByClassName('picture_in_picture_video');
	var videoElement = document.getElementById('banner_video');
	pipButtonElement[0].addEventListener('click', async function() { console.log(pipButtonElement[0]);
  		await videoElement.requestPictureInPicture();
		videoElement.play();
	});
</script>
</body>
</html>