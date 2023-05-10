<style>
.customer-info input[type="radio"] {
	width: auto;
	margin: 0;
	vertical-align: middle;
	margin-right: 4px;
	display: inline-block;
}
.customer-info {
	list-style: none;
	margin-bottom: 20px;
}
.questiondiv{
		display:none;
	}
</style>
<section class="panel questions">
		
  
  <div class="panel-body qualify_now surveyQ1" style="display:none">     		
	<form id="frmQualify" role="form" action="<?php echo base_url()."Modules/setQualifyData"?>/?cm=<?php echo $current_module; ?>" method="post">	
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
		<input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>		
	<input  name = 'size' value = "<?php echo sizeof($surveyQ1)?>" type="hidden"/>
	<?php  $size = sizeof($surveyQ1)-1;	
		for($i= 0 ; $i<sizeof($surveyQ1);$i++){
			$questionNo = $i+1;
			if($i==$size){?>
			<div class="form-group col-lg-12 questiondiv">

					<label for="note"><?php  echo $questionNo .' '. $surveyQ1[$i]['questions'].' ?';?> </label>  
					<input type="hidden" name ="ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['questions']?>">           
					<ul class="customer-info">	
						<?php if(!empty($surveyQ1[$i]['op_1']) && isset($surveyQ1[$i]['op_1'])){?>	
						
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_1']?>'><span><?php echo $surveyQ1[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_2']) && isset($surveyQ1[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>"  name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ1[$i]['op_2']?>'><span><?php echo $surveyQ1[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_3']) && isset($surveyQ1[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_3']?>'><span><?php echo $surveyQ1[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_4']) && isset($surveyQ1[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_4']?>'><span><?php echo $surveyQ1[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['others']) && isset($surveyQ1[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans"/><span><?php echo $surveyQ1[$i]['others']?></span><input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value = '' disabled>                
						</li>
						
					<?php }?>	
					</ul>		
				<div class="row">	
				<?php if(!empty($surveyQ1[$i]['cat_1']) && isset($surveyQ1[$i]['cat_1']) ){ ?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_1']?>">      
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_1_op_1']) && isset($surveyQ1[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_op_2']) && isset($surveyQ1[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ1[$i]['ques_<?php echo $questionNo;?>_ans']) && isset($surveyQ1[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['others']?>'><span><?php echo $surveyQ1[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_2']) && isset($surveyQ1[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_2_op_1']) && isset($surveyQ1[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_1']?>'><span><?php echo $surveyQ1[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_2_op_2']) && isset($surveyQ1[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ1[$i]['cat_2_others']) && isset($surveyQ1[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_others']?>'><span><?php echo $surveyQ1[$i]['cat_2_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>					
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ1[$i]['cat_3']) && isset($surveyQ1[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_3_op_1']) && isset($surveyQ1[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_3_op_2']) && isset($surveyQ1[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ1[$i]['cat_3_others']) && isset($surveyQ1[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_others']?>'><span><?php echo $surveyQ1[$i]['cat_3_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_4']) && isset($surveyQ1[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_4_op_1']) && isset($surveyQ1[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_1']?>'><span><?php echo $surveyQ1[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_op_2']) && isset($surveyQ1[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ1[$i]['cat_4_others']) && isset($surveyQ1[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_others']?>'><span><?php echo $surveyQ1[$i]['cat_4_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>	
			<?php if(!empty($surveyQ1[$i]['sub_question']) && isset($surveyQ1[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>" >
					<li>
						<span><?php echo $surveyQ1[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ1[$i]['sub_op_1']) && isset($surveyQ1[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_1']?>'><span><?php echo $surveyQ1[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ1[$i]['sub_op_2']) && isset($surveyQ1[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_2']?>'><span><?php echo $surveyQ1[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ1[$i]['sub_op_others']) && isset($surveyQ1[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_others']?>'><span><?php echo $surveyQ1[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<input  name = 'cat_id' value = "<?php echo $surveyQ1[$i]['cat_id']?>" type="hidden"/>		
				<button class="btn btn-success btn-xs btnSubmit" type="submit" style="float:right;">Submit</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>

			<?php }elseif($i>0){?>




			<div class="form-group col-lg-12 questiondiv">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ1[$i]['questions'].' ?';?> </label> 
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['questions']?>">                       
					<ul class="customer-info">
						<?php if(!empty($surveyQ1[$i]['op_1']) && isset($surveyQ1[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_1']?>'><span><?php echo $surveyQ1[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_2']) && isset($surveyQ1[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ1[$i]['op_2']?>'><span><?php echo $surveyQ1[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_3']) && isset($surveyQ1[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_3']?>'><span><?php echo $surveyQ1[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_4']) && isset($surveyQ1[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_4']?>'><span><?php echo $surveyQ1[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['others']) && isset($surveyQ1[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ1[$i]['others']?>:</span><input type="text" name="ques_others_<?php echo $questionNo?>" value='' placeholder="Enter Data" disabled>                
						</li>	
					<?php }?>		
					</ul>

				<div class="row">		
					<?php if(!empty($surveyQ1[$i]['cat_1']) && isset($surveyQ1[$i]['cat_1'])){?>
					<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_1_op_1']) && isset($surveyQ1[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_1']?>' checked ><span><?php echo $surveyQ1[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_op_2']) && isset($surveyQ1[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ1[$i]['cat_1_others']) && isset($surveyQ1[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_others']?>'><span><?php echo $surveyQ1[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_2']) && isset($surveyQ1[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_2_op_1']) && isset($surveyQ1[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_op_2']) && isset($surveyQ1[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_2_others']) && isset($surveyQ1[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_others']?>'><span><?php echo $surveyQ1[$i]['cat_2_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ1[$i]['cat_3']) && isset($surveyQ1[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_3_op_1']) && isset($surveyQ1[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_3_op_2']) && isset($surveyQ1[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_3_others']) && isset($surveyQ1[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_others']?>'><span><?php echo $surveyQ1[$i]['cat_3_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_4']) && isset($surveyQ1[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_4_op_1']) && isset($surveyQ1[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_4_op_2']) && isset($surveyQ1[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_4_others']) && isset($surveyQ1[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_others']?>'><span><?php echo $surveyQ1[$i]['cat_4_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>

			<?php if(!empty($surveyQ1[$i]['sub_question']) && isset($surveyQ1[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ1[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ1[$i]['sub_op_1']) && isset($surveyQ1[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_1']?>'><span><?php echo $surveyQ1[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ1[$i]['sub_op_2']) && isset($surveyQ1[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_2']?>'><span><?php echo $surveyQ1[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ1[$i]['sub_op_others']) && isset($surveyQ1[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_others']?>'><span><?php echo $surveyQ1[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>
			<?php }else{?>
				<div class="form-group col-lg-12">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ1[$i]['questions'].' ?';?> </label>  
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['questions']?>">                      
					<ul class="customer-info">
					<?php if(!empty($surveyQ1[$i]['op_1']) && isset($surveyQ1[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_1']?>'><span><?php echo $surveyQ1[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_2']) && isset($surveyQ1[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ1[$i]['op_2']?>'><span><?php echo $surveyQ1[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_3']) && isset($surveyQ1[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_3']?>'><span><?php echo $surveyQ1[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['op_4']) && isset($surveyQ1[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['op_4']?>'><span><?php echo $surveyQ1[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ1[$i]['others']) && isset($surveyQ1[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ1[$i]['others']?></span> <input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value='' disabled>                
						</li>	
					<?php }?>	
					</ul>


				<div class="row">	
				<?php if(!empty($surveyQ1[$i]['cat_1']) && isset($surveyQ1[$i]['cat_1'])){?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_1_op_1']) && isset($surveyQ1[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_op_2']) && isset($surveyQ1[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_1_others']) && isset($surveyQ1[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_1_others']?>'><span><?php echo $surveyQ1[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_2']) && isset($surveyQ1[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_2_op_1']) && isset($surveyQ1[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_2_op_2']) && isset($surveyQ1[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	

								<?php if(!empty($surveyQ1[$i]['cat_2_others']) && isset($surveyQ1[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_2_others']?>'><span><?php echo $surveyQ1[$i]['cat_2_others']?></span>
								</li>
								<?php }?>	

							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

			<?php if(!empty($surveyQ1[$i]['cat_3']) && isset($surveyQ1[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_3_op_1']) && isset($surveyQ1[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_3_op_2']) && isset($surveyQ1[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_3_others']) && isset($surveyQ1[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_3_others']?>'><span><?php echo $surveyQ1[$i]['cat_3_others']?></span>
								</li>
								<?php }?>						
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ1[$i]['cat_4']) && isset($surveyQ1[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ1[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ1[$i]['cat_4_op_1']) && isset($surveyQ1[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ1[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_4_op_2']) && isset($surveyQ1[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ1[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ1[$i]['cat_4_others']) && isset($surveyQ1[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ1[$i]['cat_4_others']?>'><span><?php echo $surveyQ1[$i]['cat_4_others']?></span>
								</li>
								<?php }?>
													
							</ul>	
						</li>						
					</ul>
					</div>
				<?php }?>
				</div>


				<?php if(!empty($surveyQ1[$i]['sub_question']) && isset($surveyQ1[$i]['sub_question'])){?>
				<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ1[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ1[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ1[$i]['sub_op_1']) && isset($surveyQ1[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_1']?>'><span><?php echo $surveyQ1[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ1[$i]['sub_op_2']) && isset($surveyQ1[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_2']?>'><span><?php echo $surveyQ1[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>


					<?php if(!empty($surveyQ1[$i]['sub_op_others']) && isset($surveyQ1[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ1[$i]['sub_op_others']?><'><span><?php echo $surveyQ1[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>
				
						<button class="btn btn-success btn-xs btnNext" id="next" type="button">Next</button>	
						<button class="btn btn-success btn-xs btnSubmit" id="submit" type="submit" style="float:right; display:none;">Submit</button>
				
				</div>							
			<?php }
		}?>		
	</form>	
	</div>









<!-- Categorie Two Start -->

<div class="panel-body qualify_now surveyQ2" style="display:none"> 
<form id="frmQualify" role="form" action="<?php echo base_url()."Modules/setQualifyData"?>/?cm=<?php echo $current_module; ?>" method="post">	 
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
		<input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>		   		
	<input  name = 'size' value = "<?php echo sizeof($surveyQ2)?>" type="hidden"/>
		<?php  $size = sizeof($surveyQ2)-1;	
		for($i= 0 ; $i<sizeof($surveyQ2);$i++){
			$questionNo = $i+1;
			if($i==$size){?>
			<div class="form-group col-lg-12 questiondiv">

					<label for="note"><?php  echo $questionNo .' '. $surveyQ2[$i]['questions'].' ?';?> </label>  
					<input type="hidden" name ="ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['questions']?>">           
					<ul class="customer-info">	
						<?php if(!empty($surveyQ2[$i]['op_1']) && isset($surveyQ2[$i]['op_1'])){?>	
						
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_1']?>'><span><?php echo $surveyQ2[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_2']) && isset($surveyQ2[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>"  name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ2[$i]['op_2']?>'><span><?php echo $surveyQ2[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_3']) && isset($surveyQ2[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_3']?>'><span><?php echo $surveyQ2[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_4']) && isset($surveyQ2[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_4']?>'><span><?php echo $surveyQ2[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['others']) && isset($surveyQ2[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans"/><span><?php echo $surveyQ2[$i]['others']?></span><input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value = '' disabled>                
						</li>
						
					<?php }?>	
					</ul>		
				<div class="row">	
				<?php if(!empty($surveyQ2[$i]['cat_1']) && isset($surveyQ2[$i]['cat_1']) ){ ?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_1']?>">      
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_1_op_1']) && isset($surveyQ2[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_op_2']) && isset($surveyQ2[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ2[$i]['ques_<?php echo $questionNo;?>_ans']) && isset($surveyQ2[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['others']?>'><span><?php echo $surveyQ2[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_2']) && isset($surveyQ2[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_2_op_1']) && isset($surveyQ2[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_1']?>'><span><?php echo $surveyQ2[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_2_op_2']) && isset($surveyQ2[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ2[$i]['cat_2_others']) && isset($surveyQ2[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_others']?>'><span><?php echo $surveyQ2[$i]['cat_2_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>					
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ2[$i]['cat_3']) && isset($surveyQ2[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_3_op_1']) && isset($surveyQ2[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_3_op_2']) && isset($surveyQ2[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ2[$i]['cat_3_others']) && isset($surveyQ2[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_others']?>'><span><?php echo $surveyQ2[$i]['cat_3_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_4']) && isset($surveyQ2[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_4_op_1']) && isset($surveyQ2[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_1']?>'><span><?php echo $surveyQ2[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_op_2']) && isset($surveyQ2[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ2[$i]['cat_4_others']) && isset($surveyQ2[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_others']?>'><span><?php echo $surveyQ2[$i]['cat_4_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>	
			<?php if(!empty($surveyQ2[$i]['sub_question']) && isset($surveyQ2[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>" >
					<li>
						<span><?php echo $surveyQ2[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ2[$i]['sub_op_1']) && isset($surveyQ2[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_1']?>'><span><?php echo $surveyQ2[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ2[$i]['sub_op_2']) && isset($surveyQ2[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_2']?>'><span><?php echo $surveyQ2[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ2[$i]['sub_op_others']) && isset($surveyQ2[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_others']?>'><span><?php echo $surveyQ2[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<input  name = 'cat_id' value = "<?php echo $surveyQ2[$i]['cat_id']?>" type="hidden"/>		
				<button class="btn btn-success btn-xs btnSubmit" type="submit" style="float:right;">Submit</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>

			<?php }elseif($i>0){?>




			<div class="form-group col-lg-12 questiondiv">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ2[$i]['questions'].' ?';?> </label> 
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['questions']?>">                       
					<ul class="customer-info">
						<?php if(!empty($surveyQ2[$i]['op_1']) && isset($surveyQ2[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_1']?>'><span><?php echo $surveyQ2[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_2']) && isset($surveyQ2[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ2[$i]['op_2']?>'><span><?php echo $surveyQ2[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_3']) && isset($surveyQ2[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_3']?>'><span><?php echo $surveyQ2[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_4']) && isset($surveyQ2[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_4']?>'><span><?php echo $surveyQ2[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['others']) && isset($surveyQ2[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ2[$i]['others']?>:</span><input type="text" name="ques_others_<?php echo $questionNo?>" value='' placeholder="Enter Data" disabled>                
						</li>	
					<?php }?>		
					</ul>

				<div class="row">		
					<?php if(!empty($surveyQ2[$i]['cat_1']) && isset($surveyQ2[$i]['cat_1'])){?>
					<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_1_op_1']) && isset($surveyQ2[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_1']?>' checked ><span><?php echo $surveyQ2[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_op_2']) && isset($surveyQ2[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ2[$i]['cat_1_others']) && isset($surveyQ2[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_others']?>'><span><?php echo $surveyQ2[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_2']) && isset($surveyQ2[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_2_op_1']) && isset($surveyQ2[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_op_2']) && isset($surveyQ2[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_2_others']) && isset($surveyQ2[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_others']?>'><span><?php echo $surveyQ2[$i]['cat_2_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ2[$i]['cat_3']) && isset($surveyQ2[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_3_op_1']) && isset($surveyQ2[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_3_op_2']) && isset($surveyQ2[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_3_others']) && isset($surveyQ2[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_others']?>'><span><?php echo $surveyQ2[$i]['cat_3_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_4']) && isset($surveyQ2[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_4_op_1']) && isset($surveyQ2[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_4_op_2']) && isset($surveyQ2[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_4_others']) && isset($surveyQ2[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_others']?>'><span><?php echo $surveyQ2[$i]['cat_4_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>

			<?php if(!empty($surveyQ2[$i]['sub_question']) && isset($surveyQ2[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ2[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ2[$i]['sub_op_1']) && isset($surveyQ2[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_1']?>'><span><?php echo $surveyQ2[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ2[$i]['sub_op_2']) && isset($surveyQ2[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_2']?>'><span><?php echo $surveyQ2[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ2[$i]['sub_op_others']) && isset($surveyQ2[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_others']?>'><span><?php echo $surveyQ2[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>
			<?php }else{?>
				<div class="form-group col-lg-12">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ2[$i]['questions'].' ?';?> </label>  
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['questions']?>">                      
					<ul class="customer-info">
					<?php if(!empty($surveyQ2[$i]['op_1']) && isset($surveyQ2[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_1']?>'><span><?php echo $surveyQ2[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_2']) && isset($surveyQ2[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ2[$i]['op_2']?>'><span><?php echo $surveyQ2[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_3']) && isset($surveyQ2[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_3']?>'><span><?php echo $surveyQ2[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['op_4']) && isset($surveyQ2[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['op_4']?>'><span><?php echo $surveyQ2[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ2[$i]['others']) && isset($surveyQ2[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ2[$i]['others']?></span> <input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value='' disabled>                
						</li>	
					<?php }?>	
					</ul>


				<div class="row">	
				<?php if(!empty($surveyQ2[$i]['cat_1']) && isset($surveyQ2[$i]['cat_1'])){?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_1_op_1']) && isset($surveyQ2[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_op_2']) && isset($surveyQ2[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_1_others']) && isset($surveyQ2[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_1_others']?>'><span><?php echo $surveyQ2[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_2']) && isset($surveyQ2[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_2_op_1']) && isset($surveyQ2[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_2_op_2']) && isset($surveyQ2[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	

								<?php if(!empty($surveyQ2[$i]['cat_2_others']) && isset($surveyQ2[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_2_others']?>'><span><?php echo $surveyQ2[$i]['cat_2_others']?></span>
								</li>
								<?php }?>	

							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

			<?php if(!empty($surveyQ2[$i]['cat_3']) && isset($surveyQ2[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_3_op_1']) && isset($surveyQ2[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_3_op_2']) && isset($surveyQ2[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_3_others']) && isset($surveyQ2[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_3_others']?>'><span><?php echo $surveyQ2[$i]['cat_3_others']?></span>
								</li>
								<?php }?>						
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ2[$i]['cat_4']) && isset($surveyQ2[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ2[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ2[$i]['cat_4_op_1']) && isset($surveyQ2[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ2[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_4_op_2']) && isset($surveyQ2[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ2[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ2[$i]['cat_4_others']) && isset($surveyQ2[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ2[$i]['cat_4_others']?>'><span><?php echo $surveyQ2[$i]['cat_4_others']?></span>
								</li>
								<?php }?>
													
							</ul>	
						</li>						
					</ul>
					</div>
				<?php }?>
				</div>


				<?php if(!empty($surveyQ2[$i]['sub_question']) && isset($surveyQ2[$i]['sub_question'])){?>
				<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ2[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ2[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ2[$i]['sub_op_1']) && isset($surveyQ2[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_1']?>'><span><?php echo $surveyQ2[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ2[$i]['sub_op_2']) && isset($surveyQ2[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_2']?>'><span><?php echo $surveyQ2[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>


					<?php if(!empty($surveyQ2[$i]['sub_op_others']) && isset($surveyQ2[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ2[$i]['sub_op_others']?><'><span><?php echo $surveyQ2[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>
				
						<button class="btn btn-success btn-xs btnNext" id="next" type="button">Next</button>	
						<button class="btn btn-success btn-xs btnSubmit" id="submit" type="submit" style="float:right; display:none;">Submit</button>
				
				</div>							
			<?php }
		}?>	
	</form>
	</div>		
<!-- Categorie Two End -->

   <!-- Cat Three -->
		<div class="panel-body qualify_now surveyQ3" style="display:none">     		
		<form id="frmQualify" role="form" action="<?php echo base_url()."Modules/setQualifyData"?>/?cm=<?php echo $current_module;?>" method="post">	 
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
		<input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>		   		
	<input  name = 'size' value = "<?php echo sizeof($surveyQ3)?>" type="hidden"/>
		<?php  $size = sizeof($surveyQ3)-1;	
		for($i= 0 ; $i<sizeof($surveyQ3);$i++){
			$questionNo = $i+1;
			if($i==$size){?>
			<div class="form-group col-lg-12 questiondiv">

					<label for="note"><?php  echo $questionNo .' '. $surveyQ3[$i]['questions'].' ?';?> </label>  
					<input type="hidden" name ="ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['questions']?>">           
					<ul class="customer-info">	
						<?php if(!empty($surveyQ3[$i]['op_1']) && isset($surveyQ3[$i]['op_1'])){?>	
						
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_1']?>'><span><?php echo $surveyQ3[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_2']) && isset($surveyQ3[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>"  name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ3[$i]['op_2']?>'><span><?php echo $surveyQ3[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_3']) && isset($surveyQ3[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_3']?>'><span><?php echo $surveyQ3[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_4']) && isset($surveyQ3[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_4']?>'><span><?php echo $surveyQ3[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['others']) && isset($surveyQ3[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans"/><span><?php echo $surveyQ3[$i]['others']?></span><input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value = '' disabled>                
						</li>
						
					<?php }?>	
					</ul>		
				<div class="row">	
				<?php if(!empty($surveyQ3[$i]['cat_1']) && isset($surveyQ3[$i]['cat_1']) ){ ?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_1']?>">      
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_1_op_1']) && isset($surveyQ3[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_op_2']) && isset($surveyQ3[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ3[$i]['ques_<?php echo $questionNo;?>_ans']) && isset($surveyQ3[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['others']?>'><span><?php echo $surveyQ3[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_2']) && isset($surveyQ3[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_2_op_1']) && isset($surveyQ3[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_1']?>'><span><?php echo $surveyQ3[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_2_op_2']) && isset($surveyQ3[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ3[$i]['cat_2_others']) && isset($surveyQ3[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_others']?>'><span><?php echo $surveyQ3[$i]['cat_2_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>					
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ3[$i]['cat_3']) && isset($surveyQ3[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_3_op_1']) && isset($surveyQ3[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_3_op_2']) && isset($surveyQ3[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>	
								<?php if(!empty($surveyQ3[$i]['cat_3_others']) && isset($surveyQ3[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_others']?>'><span><?php echo $surveyQ3[$i]['cat_3_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_4']) && isset($surveyQ3[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_4_op_1']) && isset($surveyQ3[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_1']?>'><span><?php echo $surveyQ3[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_op_2']) && isset($surveyQ3[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ3[$i]['cat_4_others']) && isset($surveyQ3[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_others']?>'><span><?php echo $surveyQ3[$i]['cat_4_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>	
			<?php if(!empty($surveyQ3[$i]['sub_question']) && isset($surveyQ3[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>" >
					<li>
						<span><?php echo $surveyQ3[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ3[$i]['sub_op_1']) && isset($surveyQ3[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_1']?>'><span><?php echo $surveyQ3[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ3[$i]['sub_op_2']) && isset($surveyQ3[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_2']?>'><span><?php echo $surveyQ3[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ3[$i]['sub_op_others']) && isset($surveyQ3[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_others']?>'><span><?php echo $surveyQ3[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<input  name = 'cat_id' value = "<?php echo $surveyQ3[$i]['cat_id']?>" type="hidden"/>		
				<button class="btn btn-success btn-xs btnSubmit" type="submit" style="float:right;">Submit</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>

			<?php }elseif($i>0){?>




			<div class="form-group col-lg-12 questiondiv">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ3[$i]['questions'].' ?';?> </label> 
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['questions']?>">                       
					<ul class="customer-info">
						<?php if(!empty($surveyQ3[$i]['op_1']) && isset($surveyQ3[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_1']?>'><span><?php echo $surveyQ3[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_2']) && isset($surveyQ3[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ3[$i]['op_2']?>'><span><?php echo $surveyQ3[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_3']) && isset($surveyQ3[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_3']?>'><span><?php echo $surveyQ3[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_4']) && isset($surveyQ3[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_4']?>'><span><?php echo $surveyQ3[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['others']) && isset($surveyQ3[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ3[$i]['others']?>:</span><input type="text" name="ques_others_<?php echo $questionNo?>" value='' placeholder="Enter Data" disabled>                
						</li>	
					<?php }?>		
					</ul>

				<div class="row">		
					<?php if(!empty($surveyQ3[$i]['cat_1']) && isset($surveyQ3[$i]['cat_1'])){?>
					<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_1_op_1']) && isset($surveyQ3[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_1']?>' checked ><span><?php echo $surveyQ3[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_op_2']) && isset($surveyQ3[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>
								<?php if(!empty($surveyQ3[$i]['cat_1_others']) && isset($surveyQ3[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_others']?>'><span><?php echo $surveyQ3[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_2']) && isset($surveyQ3[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_2_op_1']) && isset($surveyQ3[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_op_2']) && isset($surveyQ3[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_2_others']) && isset($surveyQ3[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_others']?>'><span><?php echo $surveyQ3[$i]['cat_2_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>

			<?php if(!empty($surveyQ3[$i]['cat_3']) && isset($surveyQ3[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_3_op_1']) && isset($surveyQ3[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_3_op_2']) && isset($surveyQ3[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_3_others']) && isset($surveyQ3[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_others']?>'><span><?php echo $surveyQ3[$i]['cat_3_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_4']) && isset($surveyQ3[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_4_op_1']) && isset($surveyQ3[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_4_op_2']) && isset($surveyQ3[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_4_others']) && isset($surveyQ3[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_others']?>'><span><?php echo $surveyQ3[$i]['cat_4_others']?></span>
								</li>
								<?php }?>				
							</ul>	
						</li>
						
					</ul>
					</div>	
				<?php }?>
			</div>

			<?php if(!empty($surveyQ3[$i]['sub_question']) && isset($surveyQ3[$i]['sub_question'])){?>
			<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ3[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ3[$i]['sub_op_1']) && isset($surveyQ3[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_1']?>'><span><?php echo $surveyQ3[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ3[$i]['sub_op_2']) && isset($surveyQ3[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_2']?>'><span><?php echo $surveyQ3[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>

					
					<?php if(!empty($surveyQ3[$i]['sub_op_others']) && isset($surveyQ3[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_others']?>'><span><?php echo $surveyQ3[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>	
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>			
			</div>
			<?php }else{?>
				<div class="form-group col-lg-12">
					<label for="note"><?php  echo $questionNo .' '. $surveyQ3[$i]['questions'].' ?';?> </label>  
						<input type="hidden" name = "ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['questions']?>">                      
					<ul class="customer-info">
					<?php if(!empty($surveyQ3[$i]['op_1']) && isset($surveyQ3[$i]['op_1'])){?>		
						<li>
							<input type="radio" id= "op_1_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_1']?>'><span><?php echo $surveyQ3[$i]['op_1']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_2']) && isset($surveyQ3[$i]['op_2'])){?>		
						<li>
							<input type="radio" id= "op_2_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control sub-opt"  value='<?php echo $surveyQ3[$i]['op_2']?>'><span><?php echo $surveyQ3[$i]['op_2']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_3']) && isset($surveyQ3[$i]['op_3'])){?>		
						<li>
							<input type="radio" id= "op_3_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_3']?>'><span><?php echo $surveyQ3[$i]['op_3']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['op_4']) && isset($surveyQ3[$i]['op_4'])){?>		
						<li>
							<input type="radio" id= "op_4_<?php echo $questionNo;?>" name="ques_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['op_4']?>'><span><?php echo $surveyQ3[$i]['op_4']?></span>                
						</li>	
					<?php }?>	
					<?php if(!empty($surveyQ3[$i]['others']) && isset($surveyQ3[$i]['others'])){?>		
						<li>
							<input type="radio" class="others" name="ques_<?php echo $questionNo;?>_ans" /><span><?php echo $surveyQ3[$i]['others']?></span> <input type="text" name="ques_others_<?php echo $questionNo?>" class=""  value='' disabled>                
						</li>	
					<?php }?>	
					</ul>


				<div class="row">	
				<?php if(!empty($surveyQ3[$i]['cat_1']) && isset($surveyQ3[$i]['cat_1'])){?>
				<input type="hidden" name ="cat_G_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_1']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_1']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_1_op_1']) && isset($surveyQ3[$i]['cat_1_op_1'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_1_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_op_2']) && isset($surveyQ3[$i]['cat_1_op_2'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_1_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_1_others']) && isset($surveyQ3[$i]['cat_1_others'])){?>
								<li>
									<input type="radio" name="cat_G_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_1_others']?>'><span><?php echo $surveyQ3[$i]['cat_1_others']?></span>
								</li>
								<?php }?>					
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_2']) && isset($surveyQ3[$i]['cat_2'])){?>
				<input type="hidden" name ="cat_P_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_2']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_2']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_2_op_1']) && isset($surveyQ3[$i]['cat_2_op_1'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_2_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_2_op_2']) && isset($surveyQ3[$i]['cat_2_op_2'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_2_op_2']?></span>
								</li>
								<?php }?>	

								<?php if(!empty($surveyQ3[$i]['cat_2_others']) && isset($surveyQ3[$i]['cat_2_others'])){?>
								<li>
									<input type="radio" name="cat_P_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_2_others']?>'><span><?php echo $surveyQ3[$i]['cat_2_others']?></span>
								</li>
								<?php }?>	

							</ul>	
						</li>	
					
					</ul>
					</div>
				<?php }?>

			<?php if(!empty($surveyQ3[$i]['cat_3']) && isset($surveyQ3[$i]['cat_3'])){?>
			<input type="hidden" name ="cat_Q_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_3']?>">
					<div class="col-sm-3">
					<ul class="customer-info">
						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_3']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_3_op_1']) && isset($surveyQ3[$i]['cat_3_op_1'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_3_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_3_op_2']) && isset($surveyQ3[$i]['cat_3_op_2'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_3_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_3_others']) && isset($surveyQ3[$i]['cat_3_others'])){?>
								<li>
									<input type="radio" name="cat_Q_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_3_others']?>'><span><?php echo $surveyQ3[$i]['cat_3_others']?></span>
								</li>
								<?php }?>						
							</ul>	
						</li>	
					</ul>
					</div>
				<?php }?>

				<?php if(!empty($surveyQ3[$i]['cat_4']) && isset($surveyQ3[$i]['cat_4'])){?>
				<input type="hidden" name ="cat_A_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['cat_4']?>">
					<div class="col-sm-3">
					<ul class="customer-info">						
						<li>
							<span><b><?php echo $surveyQ3[$i]['cat_4']?></b></span>
							<ul class="customer-info">
								<?php if(!empty($surveyQ3[$i]['cat_4_op_1']) && isset($surveyQ3[$i]['cat_4_op_1'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_1']?>' checked><span><?php echo $surveyQ3[$i]['cat_4_op_1']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_4_op_2']) && isset($surveyQ3[$i]['cat_4_op_2'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_op_2']?>'><span><?php echo $surveyQ3[$i]['cat_4_op_2']?></span>
								</li>
								<?php }?>

								<?php if(!empty($surveyQ3[$i]['cat_4_others']) && isset($surveyQ3[$i]['cat_4_others'])){?>
								<li>
									<input type="radio" name="cat_A_ans<?php echo $questionNo;?>" class="form-control"  value='<?php echo $surveyQ3[$i]['cat_4_others']?>'><span><?php echo $surveyQ3[$i]['cat_4_others']?></span>
								</li>
								<?php }?>
													
							</ul>	
						</li>						
					</ul>
					</div>
				<?php }?>
				</div>


				<?php if(!empty($surveyQ3[$i]['sub_question']) && isset($surveyQ3[$i]['sub_question'])){?>
				<input name="sub_ques_<?php echo $questionNo;?>" value="<?php echo $surveyQ3[$i]['sub_question']?>" type="hidden"/>
				<ul class="customer-info recoveries" id="sub_cat_<?php echo $questionNo?>">
					<li>
						<span><?php echo $surveyQ3[$i]['sub_question']?></span>.
					</li>	
					<?php if(!empty($surveyQ3[$i]['sub_op_1']) && isset($surveyQ3[$i]['sub_op_1'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_1']?>'><span><?php echo $surveyQ3[$i]['sub_op_1']?></span>                
					</li>	
					<?php }?>

					<?php if(!empty($surveyQ3[$i]['sub_op_2']) && isset($surveyQ3[$i]['sub_op_2'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_2']?>'><span><?php echo $surveyQ3[$i]['sub_op_2']?></span>
					</li>	
					<?php }?>


					<?php if(!empty($surveyQ3[$i]['sub_op_others']) && isset($surveyQ3[$i]['sub_op_others'])){?>
					<li>
						<input type="radio" name="sub_que_<?php echo $questionNo;?>_ans" class="form-control"  value='<?php echo $surveyQ3[$i]['sub_op_others']?><'><span><?php echo $surveyQ3[$i]['sub_op_others']?></span>
					</li>	
					<?php }?>
				</ul>	
				<?php }?>
				
						<button class="btn btn-success btn-xs btnNext" id="next" type="button">Next</button>	
						<button class="btn btn-success btn-xs btnSubmit" id="submit" type="submit" style="float:right; display:none;">Submit</button>
				
				</div>							
			<?php }
		}?>	
	</form>	
		</div>
</section>


<script>
$(document).ready(function(){
        $("input[type='radio']").click(function(){
            var radioValue = $("#op_2_1:checked").val(); 
            if(radioValue){
           		$('#next').css('display', 'none');
           		$('#submit').css('display', 'block');
           	     }else{
            	 $('#next').css('display', 'block');
           		$('#submit').css('display', 'none');
            	
            }
        });

/*
        $("input[type='radio']").click(function(){
            var radioValue = $("#op_2_10:checked").val(); 
            if(radioValue){
            	$('#sub_cat_11').css('display', 'none');           		
              }else{
              	$('#sub_cat_11').css('display', 'block');      	            	
            }
        });

        $("input[type='radio']").click(function(){
            var radioValue = $("#op_2_11:checked").val(); 
            if(radioValue){
            	$('#sub_cat_12').css('display', 'none');           		
              }else{
              	$('#sub_cat_12').css('display', 'block');      	            	
            }
        });
    
*/

   $("input[type='radio']").click(function(){
    	var value = ($(this).val());
    	if($(this).parent().parent().siblings().hasClass('recoveries') && $(this).val() == 'No'){    
    			$(this).parent().parent().siblings('.recoveries').css('display', 'none'); 
    		}
    		else{
    			$('.recoveries').css('display', 'block');
    			$(this).parent().parent().siblings('.recoveries').css('display', 'block');
    		} 

    	if($(this).hasClass('others')){
    			$(this).next().next("input[type='text']").prop('disabled',false);
    		}
    		else{
    			$(this).parent().siblings().children("input[type='text']").val('');
    			$(this).parent().siblings().children("input[type='text']").prop('disabled',true);
    		}        
    	});
		$('.btnNext').on('click',function(){
			var class_status = $(this).parent().children().children().siblings().children().hasClass('others');
			var id = 1;
			if(class_status){
				var hasClassDisabled = $('.others').next().next("input[type='text']");
				if(!hasClassDisabled.prop('disabled') && hasClassDisabled.val() == ''){
					id = 0;
					alert('Please Enter other value');
				}
				else{
					id = 1;
				}
			}
			if(id){
				$(this).parent().next('.form-group').show();
				$(this).parent().hide();	
			}
		});

		$('.btnPrevious').on('click',function(){
			$(this).parent().prev('.form-group').show();
			$(this).parent().hide();
		});

    });
</script>



