<?php
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
if(!empty($_GET)){
    //print_r($_GET); die("cool"); 
    /*$questionnair = array(
        "sells_goods_in_canada" => $_GET["que_1"],
        "sells_in_past_4_years" => !empty($_GET["que_1_fb"]) ? $_GET["que_1_fb"] : "",
        "use_customer_broker" => $_GET["que_2"],
        "estimated_annual_sale" => $_GET["que_3"],
        "sale_to_canada" => $_GET["que_4"],
        "canadian_GST" => $_GET["que_5"],
        "payable_in" => $_GET["que_6"],
        "change_in_accounting_system" => $_GET["que_7"],
        "prod_centers_in_canada" => $_GET["que_8"],
        "has_CRA" => $_GET["que_9"],
        "third_party_consult" => !empty($_GET["que_9_fb"]) ? $_GET["que_9_fb"] : "",
        "reverse_audit" => $_GET["que_10"],

    );
    $score = $_GET['score'];
    $file = $_GET['file'];*/
}
else{ /*die();*/ }
?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo base_url() ?>static/css/my.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.min.css">
<link href="<?php echo base_url(); ?>/static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/sweetalert2.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
<style>
.panel{width:80%;margin:0px 140px;}
#main-content{background:#FBFCFD;}
#main-content .panel{width:920px;margin:0 auto;}
#main-content .panel-section{background: #11b6ab;color: white;}
.modal-content {  border:1px solid #797a7d00;border-radius: 10px;overflow: hidden;width:720px;margin:0 auto;}
.modal-dialog{width:unset;}
.modal-header { height: 65px; }
#calendar{ width:100%;margin:-10px 0px; }
.modal-header { background: #fe832c; color: white;}
.modal-title { font-weight: 600;margin-left:10px;}
.modal-body { padding: 5px 40px; }
.modal-header .close { color: white;opacity: 1; }
#comment { width:100%;position:relative; }
.control-label {color:#636060 !important;}
.ui-timepicker-container {z-index:9999 !important;}
.fc .fc-button-group .fc-button {border: 0; border-radius: 4px; color: #fff; transition: 0.2s; text-shadow: none; background: #5a6766 ; text-transform: capitalize; color:#fff;}
.fc .fc-button-group .fc-prev-button, .fc .fc-button-group .fc-next-button {border-radius:25px; height:27px; background:transparent !important; box-shadow:none;}
.fc .fc-button-group .fc-state-hover {background:#dadce0 !important; transition: 0.4s; color:#666 !important;}
.fc .fc-today-button {margin-left:10px; color:#5a6766; border-radius: 4px; background-color:#f3f3f3 !important; text-shadow: none; text-transform: capitalize; padding: 0px 13px 2px; border:1px solid #f3f3f3;}
.fc .fc-today-button.fc-state-hover:hover {background:#dadce0 !important; border:1px solid #666; color:#666 !important; box-shadow:none;}
.fc-month-view .fc-day-number {float:none; text-align:center;line-height:22px; margin:5px auto; font-weight:bold; border-radius:25px; width:22px; height:22px; cursor:pointer; background:#f1f3f4; font-size:11px;}
.fc-ltr .fc-basic-view .fc-day-hover .fc-day-number {background: #62CBC6;}
.fc-toolbar{ border:1px solid lightgray; }
#ignore_btn {color: white;background-color: #c7cbd6;border-color: #c7cbd6;}
#ignore_btn:hover {color: white;background-color: #b0b5b9;border-color: #b0b5b9;}
#confirm_btn {color: #fff;background-color:#fe832c;border-color:#fe832c;float:left;margin-top:25px;padding:10px 15px 8px;font-size:16px;}
#confirm_btn:hover {color: #fff;opacity:0.85;}
#calendar .fc-time-grid-container.fc-scroller { overflow: auto;height:410px !important; }

#calendar .fc-toolbar {padding: 5px;background: gray;color: white;}

#calendar .fc-center h2 { font-size: 21px;color:#fe832c; }
#calendar .fc-day-header {background-color: #dadce0;color: #808080;}
#calendar .fc-widget-content { border-color: #8080805c; }
.fc .fc-button-group .fc-button.fc-today-button { color: gray !important; }
.fc-button.fc-month-button { color: gray !important; text-transform: capitalize;}
.wrapper { padding: 40px 25px; }
.row.no-mg { margin:0;background: #f2f4f8; }
.left-bar, .right-bar, .mid-bar{height:700px;background: white;}
.booking-details {margin-top:15px;}
.left-bar h4.company-title {margin:22px 0px 0px 22px;color:#4d505599;text-transform: capitalize;font-size:18px;}
.left-bar{border-right:0.1em solid #d3d3d36b;}
.left-bar h4 {margin:10px 0px 0px 22px;color:#4d505599;text-transform: capitalize;font-size:16px;}
.left-bar h4 i {margin-right: 5px;}
.left-bar h3 {margin:5px 0px 20px 20px;font-size: 20px; margin-bottom: 0px;}
.head{ width:185px;float:right; position: absolute;right: -6px;top: -6px;overflow: hidden;height: 150px;}
.calendar-badge { float: right;background: #fe832c;text-align: center;width: 100%;color: white;transform: rotate(45deg);position: relative;top: 18px;left: 55px;letter-spacing:0.3px;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);height:40px;cursor: pointer;}
.calendar-badge:hover{ background: #fe832ce0; transition: 0.4s; }
.calendar-badge:before {content: '';position: absolute;background: #fe832c;height: 6px;width: 6px;top: 41px;transition: all 0.1s ease-in;z-index: 999;right: 164px;}
.calendar-badge:after {content: '';position: absolute;background: #fe832c;height: 6px;width: 6px;top: 40px;transition: all 0.1s ease-in;z-index: 999;right: 17px;}
.calendar-powered-by {font-size: 8px;text-transform: uppercase;margin-top: 7px;margin-bottom: -2px;font-weight: 700;}
.calendar-title {font-weight: 700;letter-spacing: -0.6px;}
ul{ padding: 0; }
.features{ margin-top:70px; }
.features h3{margin:0;font-size: 24px;color: #fe832c;}
.features h3 span { font-size: 40px; }
.features .row { font-size: 16px; padding: 10px 0px; }
.icon { color:orange;}
.li-icon { list-style: none;margin-top: 20px;font-size: 16px;color: #132751; position: relative;margin-left: 32px; }
.li-icon:before{ background-image: url("<?php echo base_url(); ?>assets/images/check.png");background-size: 25px 24px;display: inline-block;width: 24px;height: 24px;content:"";padding: 1px 17px;vertical-align: middle;background-repeat: no-repeat;position: absolute;left:-33px;}
.cal-title{ text-align: left;margin-left:20px;position: relative;top:-30px;color:#4d505599; }
.fc .fc-left .fc-prev-button, .fc .fc-right .fc-next-button { background: transparent;box-shadow: none; border: none; color:#4d505599; }
.fc .fc-left .fc-prev-button:hover, .fc .fc-right .fc-next-button:hover{background: #fe832c26 !important; color: #fe832c;border-radius: 50%;transition: 0.4s;  }
.fc .fc-left .fc-prev-button:hover, .fc .fc-right .fc-next-button:focus { border:none; }
#calendar .fc-toolbar {padding: 5px;background: white;color: #4d505599;border:none;margin-bottom: 20px;}
#calendar .fc-day-header {background-color: white;color: #4d505599;text-transform: uppercase;font-size: 13px;font-weight: 500;}
.fc-month-view div.fc-widget-header{ margin-bottom: 15px; }
.fc-month-view .fc-day-number { color:#4d505599;font-size: 16px;padding: 25px;font-weight: 500; }
.fc-month-view .fc-today, .fc-month-view .fc-future { color:#fe832c;background: none !important;border:none !important; }
.fc-month-view thead ,.fc-month-view th, .fc-month-view td{ border:none; }
div:not(.fc-bg) .fc-month-view .fc-today, div:not(.fc-bg) .fc-month-view .fc-future{ position:relative;font-weight: 600; }
div.fc-content-skeleton .fc-today:before, div.fc-content-skeleton .fc-future:before{content: '';position: absolute;width: 45px;height: 45px;background: #fe832c08;border-radius: 25px;opacity: 1;left: 50%;z-index: -1;top: 50%;margin: -22px;}
/*div:not(.fc-bg) .fc-month-view .fc-today:before, div:not(.fc-bg) .fc-month-view .fc-future:before{content: '';position: absolute;width: 45px;height: 45px;background: #fe832c08;border-radius: 25px;opacity: 1;left: 50%;z-index: -1;top: 50%;margin: -22px;}*/
div:not(.fc-bg) .fc-month-view .fc-today:hover, div:not(.fc-bg) .fc-month-view .fc-future:hover { color:white; }
div:not(.fc-bg) .fc-month-view .fc-today:hover:before, div:not(.fc-bg) .fc-month-view .fc-future:hover:before { background: #fe832cc2 !important; }
td.fc-day-number.fc-past { cursor:not-allowed; }

#month-btn { position: relative;top: -15px;left: 190px;padding: 3px 10px;display: none;}
.btn-default{color: #fe832c;background-color: #ffffff;border-color: #fe832c;}
.btn-default:hover,.btn-default:active,.btn-default:focus{ color: #ffffff !important;background-color: #fe832c !important;border-color: #fe832c !important; }

.fc-agendaDay-view .fc-today, .fc-agendaDay-view .fc-future { border:none !important; }
.fc-agendaDay-view thead,.fc-agendaDay-view th,.fc-agendaDay-view td{ border:none; }
.fc-agendaDay-view .fc-slats td { /*border:none !important;*/border: 1px dotted white;border-color: #1fb5ad !important;}
.fc-agendaDay-view .fc-day-grid { display: none; }
.fc-agendaDay-view .fc-slats tr { border:1px dotted black; }
.fc-agendaDay-view .fc-time {position: relative;/*left: 60px;*/color: #fe832c;font-size: 20px;text-transform: capitalize;}
.fc-agendaDay-view hr { display: none; }
.fc-agendaDay-view.fc-view { right:41px;width:568px; }
.fc-agendaDay-view .fc-day-header {background: #10b7abd9 !important;padding:10px !important;color: white !important;font-size: 17px !important;font-weight: 650 !important;letter-spacing: 0.7px;}
.m50{ margin:-50px 0px !important; }
.fc-agendaDay-view td.fc-widget-content:not(.fc-time) { padding-left: 60px; }
.fc-agendaDay-view div.fc-content .fc-time,.fc-agendaDay-view div.fc-content .fc-title{ display: inline-block !important;font-size: 15px;color:white; }
.fc-agendaDay-view td.fc-today { background: white; }
.fa{font-size: 17px;}
.ajax-load{float:left;width:90px;position:relative;left:-20px;display:none;}
.back-arrow{margin: 22px 0 0 10px;width: auto;padding: 7px;height: auto;}
.back-arrow img{width: 150px;height: 50px;}
h4.time-title {text-align:center;margin-left:12px;position: relative;top:45px;background:#fe832c;color: #fff;padding:10px;width:235px;}
.time-plates{margin-top: 65px;text-align: center;    max-height: 495px;overflow-y: scroll;}
.plates {width: 235px;background: #fff;margin: 0 auto;padding: 10px;border: 1px solid #fe832c;color: #fe832c;border-radius: 5px;font-weight: 560;margin-top:15px;}
.plates:hover{border:2px solid;cursor:pointer;}
.time-plates::-webkit-scrollbar {width: 8px;background-color: #F5F5F5; }

.form-details h3.entries{text-align:center;font-size:2rem;margin:-10px 15px 30px; font-size:1.95rem;margin:0; font-weight:650;color:#fe832c;}
.form-details label{float:left;font-size:1.38rem;letter-spacing:0.2px;}
.form-details .row{margin-left:0 !important;margin-right:0 !important;}
.select2.select2-container.select2-container--default{width:99% !important;}
.select2-container--default .select2-selection--multiple{height:30px !important;}
.select2-container--default .select2-selection--multiple:focus,.select2-container--default .select2-selection--multiple:focus-within,.select2-container--default .select2-selection--multiple:active,.select2-container--default .select2-selection--multiple:visited{border-color: #66afe9;outline: 0;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);}
#select2-timezones-container{text-align:left;}
.guest_btn{background: #fff;border-color: #00a2ff;padding: 5px 12px;border-radius: 5px;color: #00a2ff;border: 1px solid;}
.guest_btn:hover{background:#00a2ff24;}

.response-details {width:450px; margin:47px auto 0; border-radius:4px; background:#fff; box-shadow:0 0 8px rgba(0,0,0,.25);}
.response-details h3{font-size:1.95rem; margin:0; font-weight:650; background:#fe832c; color:#fff; padding:40px 0 15px;}
.response-details h4{color:#fff;font-size:17px;background:#fe832c;padding-bottom:21px;margin:0 auto;border-bottom:4px solid #bb530a;}
.summary {text-align:left; margin:0 auto;  padding:10px 60px;}
.summary span {margin: 22px 0px 0 auto;display: block;font-size: 1.6rem;position: relative;color: #949699;padding: 6px 0;padding-left: 60px;}
.summary span.time {color:#fe832c;}
.summary span i{    font-size: 16px;width: 40px;text-align: center;margin: 0;height: 40px;background: #fff;border-radius: 25px;line-height: 40px;margin-right: 20px;position: absolute;color: #fe832c;border: 1px solid #ddd;left: 0;top: 0;}
.back-btn{float: right;color: #fe832c;border: 1px solid #4d50551a;border-radius: 23px;width: 40px;height: 40px;padding-top: 8px;margin: -5px 14px 0px 0px;}
.back-btn:hover{background:#fe8b5e26;}
.back-btn i{font-size:21px;}
.web-back-btn:hover{background:#fe8b5e26;}
.web-back-btn i{font-size:21px;}
.web-back-btn{float: right;color: #fe832c;border: 1px solid #4d50551a;border-radius: 23px;width: 38px;height: 38px;padding-top: 8px;margin: -34px 10px;}
.web-back-btn.last{float: right;color: #fe832c;border: 1px solid #4d50551a;border-radius: 23px;width: 38px;height: 38px;padding-top: 8px;margin: 15px 10px;padding-left:8px;}
.web-back-btn2:hover{background:#fe8b5e26;}
.web-back-btn2 i{font-size:21px;}
.web-back-btn2{float: right;color: #fe832c;border: 1px solid #4d50551a;border-radius: 23px;width: 38px;height: 38px;padding-top: 8px;margin: -34px 10px;}
.web-back-btn2.last{float: right;color: #fe832c;border: 1px solid #4d50551a;border-radius: 23px;width: 38px;height: 38px;padding-top: 8px;margin: 15px 10px;padding-left:8px;}
.time-plates::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px #4d505599;
background-color: #4d505599; }

.user-details {margin: 65px auto 0;border-radius: 4px;background: #fff;box-shadow: 0 0 8px rgba(0,0,0,.25);position:relative;left:80px;
}
.user-details h3 {font-size: 1.95rem;margin: 0;font-weight: 650;background: #fe832c;color: #fff;padding:42px 0px 13px;text-align: center;
}
.user-details .summary {text-align: left;margin: 0 auto;padding: 10px 15px;
}
.user-details .summary span.time {margin: 8px 0px 0 auto;display: block;font-size: 1.6rem;position: relative;padding: 10px 0;padding-left: 50px;
}
.user-details .summary span i {font-size: 16px;width: 40px;text-align: center;margin: 0;height: 40px;background: #fff;border-radius: 25px;line-height: 40px;margin-right: 8px;position: absolute;color: #fe832c;border: 1px solid #ddd;left: 0;top: 0;
}
.user-details h4{color: #fff;font-size: 17px;background: #fe832c;padding-bottom:30px;margin: -3px auto;border-bottom: 4px solid #bb530a;}
.web-back-btn2{display:none;}
.select2-selection.select2-selection--single{width:98%;height:34px;border-color:#8080807a}
.select2-container--default .select2-selection--single .select2-selection__arrow{right:10px;}
.select2.select2-container.select2-container--default.select2-container--below{border-color:#8080807a;}
#guestlist .col-sm-12{display:block !important;}
#comments{width:99%;}
@media only screen and (max-width: 767px) {
    .row.no-mg{background:#fff;}
    .back-arrow,.left-bar h4.company-title,.booking-details,.features{text-align:center;}
    #main-content .panel{width:100% !important;}
    .features ul{margin:0 auto;width:359px;max-width:100%;}
    .features ul li{text-align:left;}
    .web-back-btn{margin:25px 10px;}
    .cal-title{top:25px;}
    #calendar{margin:65px 0;}
    .fc-view-container{display: block;width: 100%;}
    .fc-month-view .fc-day-number{padding:25px 0 0 0;height:47px;}
    h4.time-title{margin:0 auto;}
    div:not(.fc-bg) .fc-month-view .fc-today:hover:before, div:not(.fc-bg) .fc-month-view .fc-future:hover:before{margin-top:-22px;}
    #right-bar2{height:100%;padding-bottom:25px;}
    #right-bar2 .form-details{margin-top:-150px !important;}
    #right-bar2 .entries{padding-top:40px;}
    #right-bar2 .back-btn{margin:30px 14px 0px 0px;}
    #right-bar1 .container{margin-top:-130px !important;}
    #right-bar2 .user-details{width:450px;max-width:100%;margin:0 auto;left:0px;}
    #right-bar2 .response-details{width:450px;max-width:100%;margin:50px auto;}
    .web-back-btn,.back-btn{display:none;}
    .web-back-btn2{margin:0px;display:block;}
    .form-details .col-sm-4{padding-left:15px;}
    .custom-logo{margin-left:45px;}

}
@media only screen and (max-width: 500px) {
    #calendar .fc-day-header{font-size:12px !important;}
    td.fc-day-number.fc-past,.fc-month-view .fc-today, .fc-month-view .fc-future{font-size:14px !important;}
    .features h3{font-size:19px;}
    .features ul{padding-left:40px;}
    .features ul li{font-size:14px;}
    .cal-title{font-size:16px;top:21px;width:100%;}
    .web-back-btn2{width:35px;height:35px;padding-top:8px;}
    .back-btn i{font-size:18px;}
    .fc .fc-toolbar>*>:first-child{margin-left:0px;}
    #calendar .fc-center h2{font-size:18px;}
    .web-back-btn2 i{font-size:15px;}
    h4.time-title{top:0;}
    .time-plates{margin:10px; auto;padding-left:8px;}
    .plates{margin:15px auto;}
    #right-bar2 .entries{padding-left:30px;}
    #right-bar2 .back-btn{width:25px;height:25px;padding-top:2px;}
    .summary{padding:10px 20px;}
    .wrapper{padding:0;}
    .fc .fc-left .fc-prev-button, .fc .fc-right .fc-next-button{width: 30px;height: 30px;padding: 0;border-radius: 25px;color: #fe832c;border: 1px solid #4d505542;}

}
@media only screen and (max-width: 400px)
{
    .features ul{padding-left:22px;}
    .cal-title{margin-left:10px;font-size:15px;}
    .plates{width:200px;}
    #right-bar2{padding:0 0 25px 0;}
    #right-bar2 .col-sm-4, #right-bar2 .col-sm-8{padding:0px !important;}
    .time-plates {position: relative !important;}
}
#out-box {margin-top:4%;margin-bottom: 4%; box-shadow:11px 6px 25px -12px #1e3161; padding:0;}
#out-box .booking-head img {width:auto; height:120px;}
#out-box .booking-head h5 {font-weight:600; color:#1e3161; margin-top:30px;}
@media (max-width:767px) {
     #out-box .content-1 {display:block;}
     #out-box .booking-head img {height:75px;}
}
#msg-box {max-width: 100%; padding:0;}
#msg-box .logo {padding:20px;}
#msg-box .logo img {width:230px; max-width:100%;}
#msg-box .msg-content {padding:30px;}
#msg-box .msg-content .icon {margin-bottom:20px;}
#msg-box .msg-content .icon img {width:100px; max-width:100%;}
#msg-box .msg-content p {color:#464646; line-height:25px;}
#msg-box .regards {margin-top:30px;}
#msg-box .regards h4 {color:#ea5a18; margin:0;}
#msg-box .regards h4 {color:#2b4a92; margin:8px; font-weight:600;}
.custom-row{    
    margin-right: -15px;
    margin-left: -15px;
}
</style>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<!--main content start-->
<title>Booking</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

</head>
<body>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <div class="panel-section">
                <!-- <div class="increased popover-toggle silent" style="padding: 5px 0px;text-align:center;">
                    <h2 style="font-size: 25px; font-weight: 500;">Booking</h2>
                    
                </div> -->      
            </div>
            <div class="row no-mg">
                <div class="col-sm-4 left-bar">
                    <div class="back-arrow"><img width="150" height="36" src="<?php echo base_url();?>assets/images/webAnbruch.jpg" class="custom-logo" alt="anbruch" itemprop="logo" style="margin-left:24px;">
                    <span class="web-back-btn2"><i class="fa fa-arrow-left"></i></span>
                    </div>
                    <div style="margin:20px;height:35px;">
                    <img src="<?php echo base_url() ?>assets/images/minutes.png" style="height:80px;margin-left:60px;">
                    
                    </div>
                    <!-- <h4 class="company-title">Anbruch.Inc</h4>
                    <div class="booking-details">
                        <h4><i class="fa fa-clock"></i>30 min</h4>
                        <h4><i class="fa fa-map-marker-alt"></i> https://anbruch.com/</h4>
                    </div> -->
                    <div class="features">
                        <h3><span>5</span> Good Reasons Why Anbruch</h3>
                        <ul>
                            <li class="li-icon"><span>Maximized savings & refunds</span></li>
                            <li class="li-icon"><span>Success fee-based compensation</span></li>
                            <li class="li-icon"><span>Non-intrusive value-driven process</span></li>
                            <li class="li-icon"><span>End-to-end personalized audit support service</span></li>
                            <li class="li-icon"><span>No risk, no out-of-pocket cost, no obligation!</span></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-sm-1"></div> -->
                <div class="col-sm-8 right-bar" id="right-bar1">
                    <div class="container" style="text-align: center;width:100%;margin-top:50px;">
                        <span class="web-back-btn"><i class="fa fa-arrow-left"></i></span>
                        <h4 class="cal-title" style="width:50%;">Select Date & Time</h4>
                        <button type="button" id="month-btn" class="btn btn-default">Month</button>
                        <div id="calendar"></div> 
                    </div>
                </div>
                <div class="col-sm-8 right-bar" id="right-bar2" style="display:none;">
                    <div class="form-details" style="text-align: center;width:100%;margin-top:50px;">
                        <!-- <div class="response-details" style="padding:60px;">
                            <h3>Booking Scheduled</h3>
                            <h4>You are scheduled with Andrew Auger</h4>
                            <div class="summary">
                               <span><i class="fa fa-calendar"></i>Booking Title</span>
                               <span><i class="fa fa-clock"></i>11/15/2019 09:00 am - 09:30 am</span>
                               <span><i class="fa fa-globe-americas"></i>America/Chicago Time</span>
                               <span><i class="fa fa-map-marker-alt"></i>Vijay Nagar Indore, India</span>
                            </div>
                        </div> -->
                        <span class="back-btn"><i class="fa fa-arrow-left"></i></span>
                        <h3 class="entries">Enter Details</h3>
                        <form id="website-booking" name="websiteBooking" type="post" class="form-vertical" action="<?php echo base_url(); ?>User/addWebBooking" style="margin-top:20px;">
                            <?php if(!empty($_GET)){ foreach ($_GET as $key => $value) { ?>
                                <input type="hidden" name="questionnaire[<?php echo $key ?>]" value="<?php echo $value; ?>">
                            <?php } ?>
                            <?php } ?>
                            <input type="hidden" name="duration" id="duration" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone:</label>
                                        <input type="text" class="form-control" name="phone" id="phone">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="company_name">Company Name:</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name">
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                  <div class="custom-row">  
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label class="control-label" for="city">City:</label>
                                            <input type="text" class="form-control" name="city" id="city">
                                        </div>
                                    </div>
                                     <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Province/State:</label>
                                            <input type="text" class="form-control" name="state" id="state">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="country">Country:</label>
                                        <input type="text" class="form-control" name="country" id="country">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="timezone">Timezone:</label>
                                        <?php $default = date_default_timezone_get();?>
                                        <select class="form-control" name="timezones" id="timezones">
                                           <?php foreach(tz_list() as $t) { ?>
                                            <option value="<?php print $t['zone'] ?>" <?php echo ($default == $t['zone'] ? 'selected' : '');  ?>>
                                              <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Date:</label>
                                        <input class="input-xlarge form-control datepicker" name="st_date" id="start_date2" type="text" placeholder="MM/DD/YYYY" required value="" autocomplete="off"> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="start_time">Start:</label>
                                        <input class="input-xlarge form-control timepicker" name="st_time" id="start_time" value="" type="text" placeholder="HH:MM" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="end_time">End:</label>
                                        <input class="input-xlarge form-control timepicker" name="end_time" id="end_time" value="" type="text" placeholder="HH:MM" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="text-align:left;">
                                <div class="col-sm-12">
                                <input type="button" class="guest_btn" value="Add Guests">
                                </div>
                            </div>
                            <div class="row" id="guestlist" style="display:none;">
                                <div class="col-sm-12" style="display:inline-grid;text-align:-webkit-auto;">
                                    <label class="control-label" for="guest">Guest Email(s):</label>
                                    <select class="form-control select2" name="guest[]" id="guest" multiple="" placeholder="Enter email"></select>
                                </div>
                            </div>
                            <div class="row" style="margin-top:13px;">
                                <div class="col-sm-12">
                                    <label class="control-label" for="comments">Comments:</label>
                                    <textarea type="text" class="form-control" name="comments" id="comments" ></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <button class="btn btn-warning" id="confirm_btn" type="button">Schedule Booking</button>
                                <img src="<?php echo base_url(); ?>assets/images/ajax-loader.gif" class="ajax-load">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-3 mid-bar" style="display: none;">
                    <h4 class="time-title">2019-11-14</h4>
                    <div class="time-plates">
                        <div class="plates">
                            10:00 am
                        </div>
                        <div class="plates">
                            10:00 am
                        </div>
                    </div>
                </div>
            </div>
        <!-- page end-->
        </section>
    </section>
</section>
</body>
<!--main content end-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#guest").select2({
            tags: true,
            placeholder: "Enter email",
            tokenSeparators: [',', ' ']
        });
        $("#timezones").select2();
        $(".guest_btn").click(function(){
            $("#guestlist").css('display', 'block');
            $(this).css('display', 'none');
        });
        $(".datepicker").datepicker({
            minDate: 0
        });
        $("input.timepicker").timepicker({
            timeFormat: 'h:mm a',
            interval: 30,
        });
         $('#calendar').fullCalendar({
            selectable: true,
            slotDuration :'00:15:00',
            nowIndicator: true,
            header: {
              left: 'prev',
              center: 'title',
              right: 'next'
            },
            height:510,
            eventLimit:true,
            scrollTime: "09:00:00",
            dayClick: function(date,jsEvent, view) {
                 if(view.name == 'month')
                 {
                    if(date.isAfter(moment()) || date.isSame(moment(), 'day'))
                    {
                        var tarik = date.format('MM/DD/YYYY');
                        $("#main-content .panel").css('width','1200px');
                        $(".left-bar").removeClass('col-sm-4').addClass('col-sm-3');
                        $(".right-bar").removeClass('col-sm-8').addClass('col-sm-6');
                        $(".mid-bar").css('display', 'block');
                        $(".time-title").html(tarik);
                        $.ajax({
                            type:'post',
                            url:"<?php echo base_url(); ?>/user/getWEBPlates",
                            dataType:'json',
                            data:{date:tarik},
                            success:function(response)
                            {
                               var html = '';
                               if(response)
                               {
                                    //console.log(response);
                                    $.each(response, function(key, value){
                                      //  console.log(value['time']);
                                        if(value['time'])
                                        {

                                            if(value['time'] >= 9 && value['time'] < 12)
                                            {
                                                if(value['Prev'] != 0)
                                                {
                                                    html +='<div class="plates" data-id="'+tarik+' '+value["time"]+':00 am" >'+value["time"]+':00 am</div>';
                                                }
                                                if(value['Next'] != 0)
                                                {
                                                    html += '<div class="plates" data-id="'+tarik+' '+value["time"]+':30 am">'+value["time"]+':30 am</div>';
                                                }
                                            }
                                            else
                                            {
                                                if(value['Prev'] != 0)
                                                {
                                                    html +='<div class="plates" data-id="'+tarik+' '+value["time"]+':00 pm" >'+value["time"]+':00 pm</div>';
                                                }
                                                if(value['Next'] != 0)
                                                {
                                                    html += '<div class="plates" data-id="'+tarik+' '+value["time"]+':30 pm">'+value["time"]+':30 pm</div>';
                                                }
                                            }
                                        }
                                    });
                                    
                                    $(".time-plates").html(html);
                                    
                               } 
                            }
                        });
                    }
                    else
                    {
                        $("#month-btn").css('display', 'none');
                        alert("Previous time can't be select");
                    }
                }
            },
            eventSources: [{
                  events: function (start, end, timezone, callback) { 
                    /*$.ajax({
                        url: '<?php echo base_url() ?>User/getBookingTitle',
                        method:'post',
                        dataType: 'json',
                        success: function (msg) {
                          console.log(msg);
                          var events = msg.events;
                          console.log(events);
                          callback(events);
                          
                        }
                    });*/
                  },
                },               
              ],
          });
        $(document).on('click', '.plates', function(){
            var str = $(this).attr('data-id').split(' ');
            var booking_date = str[0];
            var booking_time = str[1]+' '+str[2];
            var x = str[1].split(':');
            if(x[1] == '00')
            {
                x[1] = '30';
            }
            else
            {
                x[1] = '00';
                if(x[0] == '12')
                {
                    x[0] = '1';
                }
                else
                {
                    if(x[0] == '11')
                    {
                        str[2] = 'pm';
                    }
                    x[0] = parseInt(x[0]) + 1;    
                }                
            }
            var end_time = x[0]+':'+x[1]+' '+str[2];
            $('#start_time').val(booking_time);
            $('#start_date2').val(booking_date);
            $('#end_time').val(end_time);
            $("#right-bar1").css('display', 'none');
            $(".mid-bar").css('display', 'none');
            $("#right-bar2").attr('class', 'right-bar col-sm-9');
            $("#right-bar2").css('display', 'block');
           // $("#website-booking #name").focus();
            var scroll_speedometer = jQuery("#website-booking").offset().top;
            jQuery('html,body').animate({scrollTop: scroll_speedometer}, 500);
        });
        $(".back-btn").click(function(){
            $("#right-bar2").css('display', 'none');
            $("#right-bar1").css('display', 'block');
            $(".mid-bar").css('display', 'block');
        });
        $("#confirm_btn").click(function(){
            var name = $("#website-booking #name").val().trim();
            var email = $("#website-booking #email").val().trim();
            var phone = $("#website-booking #phone").val().trim();
            var company_name = $("#website-booking #company_name").val().trim();
            var country = $("#website-booking #country").val().trim();
            var city = $("#website-booking #city").val().trim();
            var state = $("#website-booking #state").val().trim();
            var timezone = $("#website-booking #timezones").val();
            var date  = $("#website-booking #start_date2").val();
            var start_time = $("#website-booking #start_time").val();
            var end_time = $("#website-booking #end_time").val();
            var guests = $("#website-booking #guest").val();
            var comments = $("#website-booking #comments").val();
            var message = '';
            var status = false;
            if(!date)
            {
                message = "Please select a valid booking date.";
                status = true;
            }
            else if(!start_time)
            {
                message = "Please select valid start time.";
                status = true;
            }
            else if(!end_time)
            {
                message = "Please select valid start time.";
                status = true;
            }
            else if(!name)
            {
                message = "Please enter a valid name.";
                status = true;
            }
            else if(!email)
            {
                message = "Please enter a valid email address.";
                status = true;
            }
            else if(!phone)
            {
                message = "Please enter a valid phone number.";
                status = true;
            }
            else if(!company_name)
            {
                message = "Please enter a valid company name.";
                status = true;
            }
            else if(!country)
            {
                message = "Please enter a valid country.";
                status = true;
            }
            else if(!city)
            {
                message = "Please enter valid city.";
                status = true;
            }
            else if(!state)
            {
                message = "Please enter valid province/state.";
                status = true;
            }
            else if(!timezone)
            {
                message = "Please select valid timezone.";
                status = true;
            }
            if(status)
            {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: message,
                    customClass: {
                    popup: 'animated swing'
                    },
                    animation: false,  

                });
                return false;
            }
            var duration = timeDiff(start_time,end_time);
            $('#duration').val(duration);
            $("#website-booking").ajaxSubmit({
                dataType:'json',
                type:'post',
                beforeSend:function(){
                    $(".ajax-load").show();
                },
                success:function(data)
                
                {
                    $(".ajax-load").hide();
                    if(data.success)
                    {
                      //$('#main-content').html('');
                      // $(".form-details").html('');
                      //var duration = timeDiff(start_time,end_time);
                      //var html = '<div class="container" id="msg-box"> <div class="logo text-center"> <img src="<?php echo base_url()?>/assets/images/logo-hd2.png" alt="anbrch-logo"> </div><div class="text-center msg-content"> <div class="icon"> <img src="<?php echo base_url()?>/assets/images/verified.png"> </div><div class="text"> <p>Thank you for your booking!<br>A confirmation has been emailed to you along with your pre-qualification results. We look forward to speaking with you soon!</p><div class="regards"> <h4>Best regards,</h4> <h3>Anbruch Team</h3> </div></div></div></div>';
                      // $('#main-content').html(html);
                       Swal.fire(
                        {
                          icon: 'success',
                          html:'<div class="container" id="msg-box"> <div class="logo text-center"> <img src="<?php echo base_url()?>/assets/images/logo-hd3.png" alt="anbrch-logo"> </div><div class="text-center msg-content"> <div class="icon"> <img src="<?php echo base_url()?>/assets/images/verified.png"> </div><div class="text"> <p>Thank you for your booking!<br>A confirmation has been emailed to you along with your pre-qualification results. We look forward to speaking with you soon!</p><div class="regards"> <h4>Best regards,</h4> <h3>Anbruch Team</h3> </div></div></div></div>',
                          confirmButtonText:'CLOSE',
                          showConfirmButton: false,
                          timer: 6000  
                           }
                        );
                       setTimeout(function(){ 
                         window.location.href = 'https://anbruch.com';
                        }, 3000);
                    }
                    else
                    {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: 'Something went wrong to perform this action',
                            customClass: {
                            popup: 'animated swing'
                            },
                            animation: false,  

                        });
                    }
                }
            });
        });
        $(document).on("click",".web-back-btn,.web-back-btn2",function(){
            window.history.back();
        });
        if($( window ).width() <= 767)
        {   
            $('.fc-day-number.fc-future,.fc-day-number.fc-today').click(function(){
                console.log($( window ).width());
                var scroll_speedometer = jQuery(".mid-bar").offset().top;
                console.log(scroll_speedometer);
                jQuery('html,body').animate({scrollTop: scroll_speedometer}, 500);
            });
            setTimeout(function(){ 
            	 var scroll_speedometer = jQuery("#right-bar1").offset().top;
                console.log(scroll_speedometer);
                jQuery('html,body').animate({scrollTop: scroll_speedometer}, 500);
            }, 
            1000);

        }
         $('.fc-day-number.fc-future,.fc-day-number.fc-today').click(function(){
          $(document).ajaxStop(function(){	
            var current_date = '<?php echo date("m/d/Y");?>';
            var selected_date = $('.time-title').text();
            if(selected_date == current_date)
            {
               var fromdt = '<?php echo date("m/d/Y h:i a");?>';
               console.log('<?php echo date_default_timezone_get();?>');
               console.log(fromdt);
               var from = new Date(Date.parse(fromdt));
               	console.log(from);
                $('.time-plates .plates').each(function(){
					var todt = $(this).attr('data-id');
					var to = new Date(Date.parse(todt));
				    console.log(to);
					if (from > to ){
					  $(this).remove();	
					  console.log("From Grater");   
					}
                });

            }
            var height = $('.time-plates').outerHeight();
             height =  height - 1;
             $('.time-plates').attr('style', 'height:'+height+'px;');
            // alert(height+'px');
           }); 
        });                                
    });
function timeDiff(startTime, endTime)
{
	// start time and end time
var startTime = moment(startTime, "HH:mm a");
var endTime = moment(endTime, "HH:mm a");

// calculate total duration
var duration = moment.duration(endTime.diff(startTime));

// duration in hours
var hours = parseInt(duration.asHours());

// duration in minutes
var minutes = parseInt(duration.asMinutes())%60;

console.log(hours + ' hour and '+ minutes+' minutes.');
 return hours + ' hour '+ minutes+' minutes';
}
</script>
</html>
<script src="<?php echo base_url();?>/static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url();?>/static/js/fullcalendar/fullcalendar-new.js"></script>
<script src="<?php echo base_url();?>/assets/js/sweetalert2.all.min.js"></script>

