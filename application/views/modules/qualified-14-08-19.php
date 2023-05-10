<style>
.customer-info input[type="radio"] {
	width: auto;
	margin: 0;
	vertical-align: middle;
	margin-right: 4px;
	display: inline-block;
}
.customer-info {
	padding-left:18px;
    list-style:square;
}
</style>

<section class="panel" style="border:0;">
	
  <div class="panel-body qualify_now">

  			
  		<div class="tab-title">
  			<?php foreach ($qualified as $key => $qualifiedData){?>			  	   	
					<input type="hidden" name="user_id" value="<?php echo $qualifiedData['user_id']; ?>"/>
					<input type="hidden" name="record_id" value="<?php echo $qualifiedData['record_id']; ?>"/>
				<?php if($qualifiedData['questions'] == 'Are you selling goods to Canada' &&  $qualifiedData['answers']== 'Yes'){?>
					<span>Qualified For <?php echo $qualifiedData['survey_name']?> Survey</span> 
				<?php }else{?>
					<span>Not Qualified</span>
				<?php }break;?>				
	  		  <?php	}?>
  			 <span class="toggle-tab" data-toggle="collapse" data-target="#collapse-qualified"> <i class="fa fa-minus-circle"></i> </span>
  		</div>
			
		
	
<div id="collapse-qualified" class="collapse in">
	<?php foreach ($qualified as $key => $qualifiedData){	
	?>	
	<div class="form-group col-lg-12" >
		<strong><?php echo $qualifiedData['questions'].' ?' ?></strong>
		
		<?php if(!empty($qualifiedData['cat_1_question'])){?>
			<ul class="customer-info">
				<li>
					<span><?php echo $qualifiedData['cat_1_question'] ?></span>
						<span><?php echo $qualifiedData['cat_1_ans'] ?></span>
				</li>	
			</ul>

		<?php }?>

		<?php if(!empty($qualifiedData['cat_2_question'])){?>
			<ul class="customer-info">
				<li>
					<span><?php echo $qualifiedData['cat_2_question']?></span>
						<span><?php echo $qualifiedData['cat_2_ans']?></span>
				</li>	
			</ul>

		<?php }?>

		<?php if(!empty($qualifiedData['cat_3_question'])){?>

		<ul class="customer-info">
				<li>
					<span><?php echo $qualifiedData['cat_3_question']?></span>
						<span><?php echo $qualifiedData['cat_3_ans']?></span>
				</li>	
			</ul>
		<?php }?>

		<?php if(!empty($qualifiedData['cat_4_question'])){?>
		<ul class="customer-info">
				<li>
					<span><?php echo $qualifiedData['cat_4_question']?></span>
						<span><?php echo $qualifiedData['cat_4_ans']?></span>
				</li>	
			</ul>
		<?php }?>
		
		<?php if(!empty($qualifiedData['sub_question'])){?>
			<ul class="customer-info">
				<li>
					<?php echo $qualifiedData['answers']?>
				</li>
			</ul>	
			<?php if($qualifiedData['answers']=='Yes'){?>
			<ul class="customer-info">	
				<li>
					<span><?php echo $qualifiedData['sub_question']?></span>.
				</li>	
				<li>
					<?php echo $qualifiedData['sub_question_ans']?>
				</li>	
			</ul>
			<?php }?>
		<?php } 

		if(empty($qualifiedData['cat_1_question']) && empty($qualifiedData['sub_question']) ){?>
			<ul class="customer-info">
				<li>
					<?php echo $qualifiedData['answers']?>
				</li>	
	
			</ul>	
		<?php }?>	
	</div>

	<?php if($qualifiedData['questions']=='Are you selling goods to Canada' && $qualifiedData['answers'] == 'No')break; }?>
	
</div> 

</div>
</section>

