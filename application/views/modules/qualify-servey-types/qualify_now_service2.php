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

			<label for="note">1. Lorem Ipsum is simply dummy text ?</label>
			 
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
				
				<label for="note">2. It is a long established fact that a reader?</label>
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
		
				<label for="note">3. What is Lorem Ipsum?</label>
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
				
				<label for="note">4. There are many variations of passages of Lorem Ipsum available? </label>             
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

