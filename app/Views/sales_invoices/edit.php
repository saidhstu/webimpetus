<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php 
$customers = getResultArray("customers");
$templates = getResultArray("templates");
 ?>
    <div class="white_card_body">
        <div class="card-body">
            
            <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <input type="hidden" value="<?=@$sales_invoice->id?>" name="id">
            <div class="row">
				<div class="col-xs-12 col-md-12">
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Invoice Details</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Internal Notes & Other Details</a>
					  
							
						</div>
					</nav>
					<div class="tab-content py-3 px-3 px-sm-0 col-md-12" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="row">
								<div class="col-md-6">

                                    <div class="form-group ">
                                        <label for="inputEmail4">Invoice Number*</label>
                                        <input readonly type="text" class="form-control" value="<?=@$sales_invoice->invoice_number?>" id="invoice_number" name="invoice_number" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputEmail4">Terms*</label>
                                        <select name="terms" id="terms" class="form-control dashboard-dropdown">
                                            <option value="">--Please Select--</option>
                                            <option value="Net 15" <?=@$sales_invoice->terms=='Net 15'?'selected':''?> >Net 15</option>
                                            <option value="Net 20" <?=@$sales_invoice->terms=='Net 20'?'selected':''?> >Net 20</option>
                                            <option value="Net 30" <?=@$sales_invoice->terms=='Net 30'?'selected':''?> >Net 30</option>
                                            <option value="Upon receipt" <?=@$sales_invoice->terms=='Upon receipt'?'selected':''?> >Upon receipt</option>
                                            <option value="Due On Receipt" <?=@$sales_invoice->terms=='Due On Receipt'?'selected':''?> >Due On Receipt</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputEmail4">Client*</label>
                                        <select id="client_id" name="client_id" class="form-control required dashboard-dropdown">
                                            <option value="" selected="">--Selected--</option>
                                            <?php foreach($customers as $row):?>
                                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$sales_invoice->client_id){ echo "selected"; }?>><?= $row['company_name'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputEmail4">Bill To</label>
                                       <textarea name="bill_to" class="form-control"><?=@$sales_invoice->bill_to?></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputEmail4">Order By</label>
                                        <input type="text" class="form-control" value="<?=@$sales_invoice->order_by?>" id="order_by" name="order_by" placeholder="">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="inputEmail4">Notes</label>
                                        <input type="text" class="form-control" id="notes" name="notes" placeholder="" value="<?=@$sales_invoice->notes?>">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="inputPassword4">Project Code</label>
                                        <select name="project_code" id="project_code" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="4D" <?=@$sales_invoice->project_code=='4D'?'selected':''?> >4D</option>
                                            <option value="CatBase" <?=@$sales_invoice->project_code=='CatBase'?'selected':''?> > CatBase</option>
                                            <option value="Cloud Consultancy" <?=@$sales_invoice->project_code=='Cloud Consultancy'?'selected':''?> > Cloud Consultancy</option>
                                            <option value="Cloud Native Engineering" <?=@$sales_invoice->project_code=='Cloud Native Engineering'?'selected':''?> > Cloud Native Engineering</option>
                                            <option value="Database" <?=@$sales_invoice->project_code=='Database'?'selected':''?> > Database</option>
                                            <option value="Domains" <?=@$sales_invoice->project_code=='Domains'?'selected':''?> > Domains</option>
                                            <option value="IMG2D" <?=@$sales_invoice->project_code=='IMG2D'?'selected':''?> > IMG2D</option>
                                            <option value="IT Consulting" <?=@$sales_invoice->project_code=='IT Consulting'?'selected':''?> > IT Consulting</option>
                                            <option value="Jobshout" <?=@$sales_invoice->project_code=='Jobshout'?'selected':''?> > Jobshout</option>
                                            <option value="Mobile App" <?=@$sales_invoice->project_code=='Mobile App'?'selected':''?> > Mobile App</option>
                                            <option value="Mobile Friendly Website" <?=@$sales_invoice->project_code=='Mobile Friendly Website'?'selected':''?> > Mobile Friendly Website</option>
                                            <option value="Nginx" <?=@$sales_invoice->project_code=='Nginx'?'selected':''?> > Nginx</option>
                                            <option value="Time-Based" <?=@$sales_invoice->project_code=='Time-Based'?'selected':''?> > Time-Based</option>
                                            <option value="TIZO" <?=@$sales_invoice->project_code=='TIZO'?'selected':''?> > TIZO</option>
                                            <option value="WEBSITE" <?=@$sales_invoice->project_code=='WEBSITE'?'selected':''?> > WEBSITE</option>
                                        </select>
                                    </div>

                                  
								</div>


                                <div class="col-md-6">

                                    <div class="form-group ">
                                        <label for="inputEmail4">Date*</label>
                                        <input type="date" class="form-control" value="<?=@$sales_invoice->date?>" id="title" name="date" placeholder="">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="inputEmail4">Due Date*</label>
                                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="" value="<?=@$sales_invoice->due_date?>">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="inputPassword4">Balance Outstanding</label>
                                        <input type="input" class="form-control" id="balance_due" name="balance_due" placeholder="" value="<?=@$sales_invoice->balance_due?>">
                                      
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPassword4">Status</label>
                                        <select name="status" id="status" class="form-control dashboard-dropdown">
                                            <option value="">--Please Select--</option>
                                            <option value="Invoiced" <?=@$sales_invoice->status=='Invoiced'?'selected':''?>  >Invoiced</option>
                                            <option value="Paid" <?=@$sales_invoice->status=='Paid'?'selected':''?> >Paid</option>
                                            <option value="Bad debt" <?=@$sales_invoice->status=='Bad debt'?'selected':''?> >Bad debt</option>
                                            <option value="Needs chasing" <?=@$sales_invoice->status=='Needs chasing'?'selected':''?> >Needs chasing</option>
                                            <option value="Credit" <?=@$sales_invoice->status=='Credit'?'selected':''?> >Credit</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPassword4">Grand Total</label>
                                        <input type="total" class="form-control" id="total" name="total" placeholder="" value="<?=@$sales_invoice->total?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPassword4">Total Paid</label>
                                        <input type="total_paid" class="form-control" id="total_paid" name="total_paid" placeholder="" value="<?=@$sales_invoice->total_paid?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPassword4">Paid Date</label>
                                        <input type="date" class="form-control" id="paid_date" name="paid_date" placeholder="" value="<?=@$sales_invoice->paid_date?>">
                                    </div>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="row">
								
								
								<div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Invoice Pin or Passcode(For Paying Online)</label>
                                        <input type="input" class="form-control" id="payment_pin_or_passcode" name="payment_pin_or_passcode" placeholder="" value="<?=@$sales_invoice->payment_pin_or_passcode?>">
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Tax Rate</label>
                                        <input type="number" class="form-control" id="invoice_tax_rate" name="invoice_tax_rate" placeholder="" value="<?=@$sales_invoice->invoice_tax_rate?>">
                                    </div>

                                    
                                    
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Template</label>
                                        <select name="inv_template" id="inv_template" class="form-control dashboard-dropdown">
                                            <option value="">--Please Select--</option>
											<option value="TimeBilling" <?=@$sales_invoice->inv_template=='TimeBilling'?'selected':''?> >TimeBilling</option>
											<option value="Monthly Contract" <?=@$sales_invoice->inv_template=='Monthly Contract'?'selected':''?> >Monthly Contract</option>
											<option value="Day Rate" <?=@$sales_invoice->inv_template=='"Day Rate'?'selected':''?> >Day Rate</option>
										</select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Print Template Code</label>
                                        <select id="print_template_code" name="print_template_code" class="form-control required dashboard-dropdown">
                                            <option value="" selected="">--Please Selected--</option>
                                            <?php foreach($templates as $row):?>
                                            <option value="<?= $row['id'];?>" <?php if($row['id'] == @$sales_invoice->print_template_code){ echo "selected"; }?>><?= $row['code'];?></option>
                                            <?php endforeach;?>
                                        </select> 
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Internal Notes</label>
                                        <textarea class="form-control" name="internal_notes"><?=@$sales_invoice->internal_notes?></textarea> 
                                    </div>
                                
								</div>
								<div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Customer ref or PO</label>
                                        <input type="text" class="form-control" id="inv_customer_ref_po" name="inv_customer_ref_po" placeholder="" value="<?=@$sales_invoice->inv_customer_ref_po?>">
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Customer Currency Code</label>
                                        <select id="currency_code" name="currency_code" class="form-control dashboard-dropdown">
                                            <option value="">--Please Select--</option>
                                            <option value="AUD" <?=@$sales_invoice->currency_code=='AUD'?'selected':''?> >AUD</option>
                                            <option value="EUR" <?=@$sales_invoice->currency_code=='EUR'?'selected':''?> >EUR</option>
                                            <option value="GBP" <?=@$sales_invoice->currency_code=='GBP'?'selected':''?> >GBP</option>
                                            <option value="INR" <?=@$sales_invoice->currency_code=='INR'?'selected':''?> >INR</option>
                                            <option value="USD" <?=@$sales_invoice->currency_code=='USD'?'selected':''?> >USD</option>
										</select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Base Currency Code</label>
                                        <input type="text" class="form-control" id="base_currency_code" name="base_currency_code" placeholder="" value="<?=@$sales_invoice->base_currency_code?>">
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Exchange Customer Currency to Base Currency</label>
                                        <input type="text" class="form-control" id="inv_exchange_rate" name="inv_exchange_rate" placeholder="" value="<?=@$sales_invoice->inv_exchange_rate?>">
                                        
                                    </div>
								</div>
								
								
							</div>
						</div>
						
						
					</div>
					
				</div>
			</div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
   
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<!-- main content part end -->

<script>
$(document).on("click", ".form-check-input", function(){
    if($(this).prop("checked") == false){
        $(this).val(0);
    }else{
        $(this).val(1);
    }
});
</script>
