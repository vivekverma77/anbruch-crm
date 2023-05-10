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
<section class="panel">
  <div class="panel-body qualify_now">     
		
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
		<input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>
  
		<div class="form-group col-lg-12 first_que" id="q1">

			<label for="note">1. Are you selling goods to Canada?</label>
			 
			<ul class="customer-info">
				<li>
					<input type="radio" name="selling_goods_to_canada" class="form-control"  value='yes' checked><span>Yes</span>                
				</li>
				<li>
					<input type="radio" name="selling_goods_to_canada" class="form-control"  value='no'><span>No</span>
				</li>	
			</ul>

			<!--button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button-->
			<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
			<button class="btn btn-success btn-xs btnSubmit" type="submit" style="display:none;float: right;">Submit</button>
 
		</div>
  
		<div class="form-group col-lg-12 questiondiv"  id="q2">
				
				<label for="note">2. Approximately, what are your annual $ sales to Canada?</label>
				<ul class="customer-info">
					<li>
						<input type="radio" name="annual_sales_to_canada" class="form-control"  value='less_than_100k'checked ><span>Less than $ 100K</span>
					</li>	
					<li>
						<input type="radio" name="annual_sales_to_canada" class="form-control"  value='between_100k_1m'><span>Between $ 100K - $1 million</span>
					</li>	
					<li>
						<input type="radio" name="annual_sales_to_canada" class="form-control"  value='greater_than_1m'><span>> $1million</span>
					</li>	
					<li>
						<input type="radio" name="annual_sales_to_canada" class="form-control"  value='other'><span>Other amount: $ <input type="text" name="annual_sales_to_canada_other_amount" placeholder="Enter amount"></span>
					</li>
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button" data-id="q2" >Next</button>
				
		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q3">
		
				<label for="note">3. Do you pay a customs broker to import those goods into Canada?</label>
				<ul class="customer-info">
					<li>
						<input type="radio" name="custom_broker_to_import_goods" class="form-control"  value='yes'checked ><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="custom_broker_to_import_goods" class="form-control"  value='no'><span>No</span>
					</li>
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>

		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q4">
				
				<label for="note">4. Are you registered for Canadian Sales Tax?</label>

				<div class="row">
					<div class="col-sm-3">
					  <ul class="customer-info">
					  	<li> <b>GST ?</b> </li>
						<li>
						  <input type="radio" name="sales_tax_gst" class="form-control"  value='yes' checked><span>Yes</span>
						</li>	
						<li>
						  <input type="radio" name="sales_tax_gst" class="form-control"  value='no'><span>No</span>
						</li>
						<li>
						  <input type="radio" name="sales_tax_gst" class="form-control"  value='not_sure'><span>Not Sure</span>
						</li>							
					  </ul>
					</div>
					<div class="col-sm-3">
					  <ul class="customer-info">
					  	<li><b>PST ?</b></li>
						<li>
						  <input type="radio" name="sales_tax_pst" class="form-control"  value='yes' checked><span>Yes</span>
						</li>
						<li>
							<input type="radio" name="sales_tax_pst" class="form-control"  value='no'><span>No</span>
						</li>
						<li>
							<input type="radio" name="sales_tax_pst" class="form-control"  value='not_sure'><span>Not Sure</span>
						</li>
					  </ul>
					</div>
					<div class="col-sm-3">
					  
					  <ul class="customer-info">
					  	<li> <b>QST ?</b> </li>
						<li>
						  <input type="radio" name="sales_tax_qst" class="form-control"  value='yes' checked><span>Yes</span>
						</li>	
						<li>	
						  <input type="radio" name="sales_tax_qst" class="form-control"  value='no'><span>No</span>
						</li>
						<li>
						  <input type="radio" name="sales_tax_qst" class="form-control"  value='not_sure'><span>Not Sure</span>
						</li>		
					  </ul>
					</div>
					<div class="col-sm-3">
					  <ul class="customer-info">
					  	<li> <b>ALL SALES TAXES?</b> </li>
						<li>
						  <input type="radio" name="sales_tax_all" class="form-control"  value='yes' checked><span>Yes</span>
						</li>	
						<li>
						  <input type="radio" name="sales_tax_all" class="form-control"  value='no'><span>No</span>
						</li>
						<li>
						  <input type="radio" name="sales_tax_all" class="form-control"  value='not_sure'><span>Not Sure</span>
						</li>		
					  </ul>
					</div>
				</div>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				
		</div>

		<div class="form-group col-lg-12 questiondiv"  id="q5">
				
				<label for="note">5. How often do you file your Canadian Sales Tax Returns </label>                
				<ul class="customer-info">
					<li>
						<input type="radio" name="sales_tax_returns" class="form-control"  value='monthly' checked><span>Monthly?</span>                
					</li>	
					<li>
						<input type="radio" name="sales_tax_returns" class="form-control"  value='quarterly'><span>Quarterly?</span>
					</li>	
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				
		</div>

		<div class="form-group col-lg-12 questiondiv"  id="q6">
				
				<label for="note">6. Are the accounting records for Canadian Sales stored in the USA?</label>						
				<ul class="customer-info">
					<li>            
						<input type="radio" name="sales_stored_in_usa" class="form-control"  value='yes' checked><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="sales_stored_in_usa" class="form-control"  value='no'><span>No</span>
					</li>
					<li>
						<input type="radio" name="sales_stored_in_usa" class="form-control"  value='not_sure'><span>Not Sure</span>
					</li>		
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
				
		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q7">
				
				<label for="note">7. Are the Canadian Sales Tax returns processed and filed from:</label>               
				<ul class="customer-info">
					<li>	
						<input type="radio" name="sales_tax_return_filed_from" class="form-control"  value='usa' checked><span>USA</span>                
					</li>	
					<li>
						<input type="radio" name="sales_tax_return_filed_from" class="form-control"  value='canada'><span>CANADA</span>
					</li>	
					<li>
						<input type="radio" name="sales_tax_return_filed_from" class="form-control"  value='other'><span>Other: <input type="text" name="sales_tax_return_filed_from_other" placeholder="Enter other source"></span>
					</li>	
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button" data-id="q7" >Next</button>
				
		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q8">
				
				<label for="note">8. Have you had a Canadian Tax Consultant conduct a REVERSE AUDIT of your Canadian Sales Tax (GST) in the past 4 years? </label>     								
				<ul class="customer-info">
					<li>
						<input type="radio" name="tax_consultant_conduct" class="form-control"  value='yes' checked><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="tax_consultant_conduct" class="form-control"  value='no'><span>No</span>
					</li>	
				</ul>
				
				<ul class="customer-info recoveries">
					<li>
						<span>If yes, were there significant recoveries identified and obtained?</span>.
					</li>	
					<li>
						<input type="radio" name="tax_consultant_conduct_recoveries" class="form-control"  value='yes' checked><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="tax_consultant_conduct_recoveries" class="form-control"  value='no'><span>No</span>
					</li>	
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
		
		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q9">
				
				<label for="note">9. Have you had the Canadian Government audit your Canadian Sales Tax (GST) in the past 4 years? </label>     								
				<ul class="customer-info">
					<li>
						<input type="radio" name="government_audit" class="form-control"  value='yes' checked><span>Yes</span>   
					</li>	
					<li>
						<input type="radio" name="government_audit" class="form-control"  value='no'><span>No</span>
					</li>	
				</ul>
				
				<ul class="customer-info areas">	
					<li>
						<span>If yes, were there significant areas identified and assessed?</span>.
					</li>	
					<li>
						<input type="radio" name="government_audit_areas" class="form-control"  value='yes' checked><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="government_audit_areas" class="form-control"  value='no'><span>No</span>
					</li>	
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<button class="btn btn-success btn-xs btnNext" type="button">Next</button>
	 
		</div>
		
		<div class="form-group col-lg-12 questiondiv"  id="q10">
				
				<label for="note">10. Do you have operations in Canada? </label>             
				<ul class="customer-info">
					<li>
						<input type="radio" name="operation_in_canada" class="form-control"  value='yes' checked><span>Yes</span>                
					</li>	
					<li>
						<input type="radio" name="operation_in_canada" class="form-control"  value='no'><span>No</span>
					</li>	
				</ul>
				
				<ul class="customer-info operations">
					<li>
						<span>If YES what types operations? <input type="text" name="operation_in_canada_type" placeholder="Enter operations types" ></span>
					</li>	
				</ul>

				<button class="btn btn-success btn-xs btnPrevious" type="button">Previous</button>
				<!--button class="btn btn-success btn-xs btnNext" type="button">Next</button-->
				<button class="btn btn-success btn-xs btnSubmit2" type="submit" style="display:block;float: right;">Submit</button>
	
		</div>

   
  </div>

</section>

