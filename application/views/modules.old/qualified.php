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
}
</style>

<section class="panel">
	
  <div class="panel-body qualify_now">

		<h4 style="background: rgb(221, 221, 221);padding: 5px;">
			<?php if($qualified['selling_goods_to_canada']=='yes') { ?>
				<span>Qualified</span>                
			<?php } else if($qualified['selling_goods_to_canada']=='no') {  ?>
				<span>Not Qualified</span>
			<?php } ?>	
		</h4>
		
	<input type="hidden" name="user_id" value="<?php echo $qualified['user_id']; ?>"/>
	
	<input type="hidden" name="record_id" value="<?php echo $qualified['record_id']; ?>"/>
				 
	<div class="form-group col-lg-12" >
			
			<label for="note">1. Are you selling goods to Canada?</label>     
			<ul class="customer-info">
				<li>
					<?php if($qualified['selling_goods_to_canada']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } else if($qualified['selling_goods_to_canada']=='no') {  ?>
						<span>=> No</span>
					<?php } ?>	
				</li>	
			</ul>	
	</div>

<?php if($qualified['selling_goods_to_canada']=='yes') { ?>
		
	<div class="form-group col-lg-12" >
			
			<label for="note">2. Approximately, what are your annual $$ sales to Canada?</label>
			<ul class="customer-info">
				
				<li>
					<?php if($qualified['annual_sales_to_canada']=='less_than_100k') { ?>
						<span>=> Less than $ 100K</span>
					<?php } if($qualified['annual_sales_to_canada']=='between_100k_1m') { ?>
						<span>=> Between $ 100K - $1 million</span>
					<?php } if($qualified['annual_sales_to_canada']=='greater_than_1m') { ?>
						<span>=> Greater than $1million</span>
					<?php } if($qualified['annual_sales_to_canada']=='other') { ?>
						<span>=> Amount: $<?php echo @$qualified['annual_sales_to_canada_other_amount']; ?></span>
					<?php } ?>	
				</li>
				
			</ul>		
			
	</div>
	
	<div class="form-group col-lg-12" >
			
			<label for="note">3. Do you pay a customs broker to import those goods into Canada?</label>
			<ul class="customer-info">
				<li>
					<?php if($qualified['custom_broker_to_import_goods']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } if($qualified['custom_broker_to_import_goods']=='no') { ?>
						<span>=> No</span>
					<?php } ?>	
				</li>
			</ul>
			
	</div>
	
	<div class="form-group col-lg-12" >
			
			<label for="note">4. Are you registered for Canadian Sales Tax?</label>
			
			<ul class="customer-info">
				<li>
					<span>GST ?</span>
					<?php if($qualified['sales_tax_gst']=='yes') { ?>
						<span>=> Yes</span>
					<?php } if($qualified['sales_tax_gst']=='no') { ?>
						<span>=> No</span>
					<?php } if($qualified['sales_tax_gst']=='not_sure') { ?>
						<span>=> Not Sure</span>
					<?php } ?>							
				</li>	
			</ul>
			
			<ul class="customer-info">
				<li>
					<span>PST ?</span>
					<?php if($qualified['sales_tax_pst']=='yes') { ?>
						<span>=> Yes</span>
					<?php } if($qualified['sales_tax_pst']=='no') { ?>
						<span>=> No</span>
					<?php } if($qualified['sales_tax_pst']=='not_sure') { ?>
						<span>=> Not Sure</span>
					<?php } ?>		
				</li>		
			</ul>	
	 
			<ul class="customer-info">
				<li>
					<span>QST ?</span>
					<?php if($qualified['sales_tax_qst']=='yes') { ?>
						<span>=> Yes</span>
					<?php } if($qualified['sales_tax_qst']=='no') { ?>
						<span>=> No</span>
					<?php } if($qualified['sales_tax_qst']=='not_sure') { ?>
						<span>=> Not Sure</span>
					<?php } ?>		
				</li>	
			</ul>	
					
			<ul class="customer-info">
				<li>		
					<span>ALL SALES TAXES?</span>
						<?php if($qualified['sales_tax_all']=='yes') { ?>
						<span>=> Yes</span>
						<?php } if($qualified['sales_tax_all']=='no') { ?>
							<span>=> No</span>
						<?php } if($qualified['sales_tax_all']=='not_sure') { ?>
							<span>=> Not Sure</span>
						<?php } ?>											
					</li>
			</ul>		
			
	</div>
	
	 <div class="form-group col-lg-12" >
			
			<label for="note">5. How often do you file your Canadian Sales Tax Returns </label>
			
			<ul class="customer-info">
				<li>
					<?php if($qualified['sales_tax_returns']=='monthly') { ?>
						<span>=> Monthly</span>                
					<?php } if($qualified['sales_tax_returns']=='quarterly') { ?>
						<span>=> Quarterly</span>
					<?php } ?>	
				</li>	
			</ul>	
			
	</div>
	
	 <div class="form-group col-lg-12" >
			
			<label for="note">6. Are the accounting records for Canadian Sales stored in the USA?</label>     
			
			<ul class="customer-info">
				<li>            
					<?php if($qualified['sales_stored_in_usa']=='yes') { ?>
						<span>=> Yes</span>
					<?php } if($qualified['sales_stored_in_usa']=='no') { ?>
						<span>=> No</span>
					<?php } if($qualified['sales_stored_in_usa']=='not_sure') { ?>
						<span>=> Not Sure</span>
					<?php } ?>	
				</li>		
			</ul>	
			
	</div>
	
	 <div class="form-group col-lg-12" >
			
			<label for="note">7. Are the Canadian Sales Tax returns processed and filed from:</label>     
	
			<ul class="customer-info">
				<li>	
					<?php if($qualified['sales_tax_return_filed_from']=='usa') { ?>
						<span>=> USA</span>                
					<?php } if($qualified['sales_tax_return_filed_from']=='canada') { ?>
						<span>=> CANADA</span>
					<?php } if($qualified['sales_tax_return_filed_from']=='other') { ?>
						<span>=> <?php if($qualified['sales_tax_return_filed_from_other']!=""){ ?>
							<?php echo $qualified['sales_tax_return_filed_from_other'] ?>
						<?php } ?>						
					</span>
					<?php } ?>
				</li>	
			</ul>	
			
	</div>
	
	<div class="form-group col-lg-12" >
			
			<label for="note">8. Have you had a Canadian Tax Consultant conduct a REVERSE AUDIT of your Canadian Sales Tax (GST) in the past 4 years? </label>     
			
			<ul class="customer-info">
				<li>
					<?php if($qualified['tax_consultant_conduct']=='yes') {  ?>
						<span>=> Yes</span>                
					<?php } if($qualified['tax_consultant_conduct']=='no') { ?>
						<span>=> No</span>
					<?php } ?>	
				</li>	
			</ul>
			<?php if($qualified['tax_consultant_conduct']=='yes') {  ?>
			<ul class="customer-info">
				<li>
					<span>If yes, were there significant recoveries identified and obtained?</span>.
				</li>	
				<li>
					<?php if($qualified['tax_consultant_conduct_recoveries']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } if($qualified['tax_consultant_conduct_recoveries']=='no') { ?>
						<span>=> No</span>
					<?php } ?>		
				</li>	
			</ul>
			<?php } ?>	
	</div>
	
	<div class="form-group col-lg-12" >
			
			<label for="note">9. Have you had the Canadian Government audit your Canadian Sales Tax (GST) in the past 4 years? </label>     
			
			<ul class="customer-info">
				<li>
					<?php if($qualified['government_audit']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } if($qualified['government_audit']=='no') { ?>
						<span>=> No</span>
					<?php } ?>		
				</li>	
			</ul>

			<?php if($qualified['government_audit']=='yes') { ?>
			<ul class="customer-info">	
				<li>
					<span>If yes, were there significant areas identified and assessed?</span>.
				</li>	
				<li>
					<?php if($qualified['government_audit_areas']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } if($qualified['government_audit_areas']=='no') { ?>
						<span>=> No</span>
					<?php } ?>	
				</li>	
			</ul>
			<?php } ?>	
	</div>
	
	<div class="form-group col-lg-12" >
			
			<label for="note">10. Do you have operations in Canada? </label>     
	
			<ul class="customer-info">
				<li>
					<?php if($qualified['operation_in_canada']=='yes') { ?>
						<span>=> Yes</span>                
					<?php } if($qualified['operation_in_canada']=='no') { ?>
						<span>=> No</span>
					<?php } ?>	
				</li>	
			</ul>
			
			<?php if($qualified['operation_in_canada']=="yes"){ ?>
			<ul class="customer-info">
				<li>
					<span>If YES what types operations? <?php echo $qualified['operation_in_canada_type']; ?></span>
				</li>	
			</ul>
			<?php } ?>
			
	</div>

<?php } ?>
	
</div>
</section>

