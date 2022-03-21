<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php 

$customers = getResultArray("customers", ["supplier" => 1]);

?>
<div class="white_card_body">
    <div class="card-body">

        <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=@$purchase_order->id?>">
            <div class="row">
                <div class="col-md-6">

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Purchase Order Number</label>
                        </div>
                        <div class="col-md-6">
                            <input readonly type="text" class="form-control" value="<?=@$purchase_order->purchase_order_no?>" id="purchase_order_no" name="purchase_order_no" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group required ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Client </label>
                        </div>                               
                        <div class="col-md-6">
                            <select id="client_id" name="client_id" class="form-control required dashboard-dropdown">
                                <option value="" selected="">--Selected--</option>
                                <?php foreach($customers as $row):?>
                                    <option value="<?= $row['id'];?>" <?php if($row['id'] == @$purchase_order->client_id){ echo "selected"; }?>><?= $row['company_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group required">
                        <div class="col-md-4">
                            <label for="inputEmail4">Start Date</label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="text" autocomplete="off" class="form-control required datepicker" value="<?=render_date(@$purchase_order->start_date)?>" id="start_date" name="start_date" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group required">
                        <div class="col-md-4">
                            <label for="inputEmail4">End Date</label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="text" autocomplete="off" class="form-control required datepicker" value="<?=render_date(@$purchase_order->end_date)?>" id="end_date" name="end_date" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group required">
                        <label class="col-md-4 control-label">Tax Code</label>

                        <div class="col-md-6">
                            <select  id="tax_code" name="tax_code" class="form-control required dashboard-dropdown" >>	
                                <option value="UK" <?=@$purchase_order->status=='UK'?'selected':''?>>UK</option>
                                <option value="US" <?=@$purchase_order->status=='US'?'selected':''?> >US</option>									 					
                                <option value="EU" <?=@$purchase_order->status=='EU'?'selected':''?> >EU</option>									 					
                                <option value="Rest of the world" <?=@$purchase_order->status=='Rest of the world'?'selected':''?> >Rest of the world</option>
                            </select>                             
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Currency Code</label>
                        </div>
                        <div class="col-md-6">
                            
                            <select id="currency_code" name="currency_code" class="form-control dashboard-dropdown">
                                <option value="">--Please Select--</option>
                                <option value="AUD" <?=@$purchase_order->currency_code=='AUD'?'selected':''?> >AUD</option>
                                <option value="EUR" <?=@$purchase_order->currency_code=='EUR'?'selected':''?> >EUR</option>
                                <option value="GBP" <?=@$purchase_order->currency_code=='GBP'?'selected':''?> >GBP</option>
                                <option value="INR" <?=@$purchase_order->currency_code=='INR'?'selected':''?> >INR</option>
                                <option value="USD" <?=@$purchase_order->currency_code=='USD'?'selected':''?> >USD</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Unit Price</label>
                        </div>
                        <div class="col-md-6">
                            <input  type="text" class="form-control" value="<?=@$purchase_order->unit_price?>" id="unit_price" name="unit_price" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Uint Qty</label>
                        </div>
                        <div class="col-md-6">
                            <input  type="text" class="form-control" value="<?=@$purchase_order->unit_qty?>" id="unit_qty" name="unit_qty" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Currency Exchange Rate</label>
                        </div>
                        <div class="col-md-6">
                            <input  type="text" class="form-control" value="<?=@$purchase_order->exchange_rate?>" id="exchange_rate" name="exchange_rate" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Total Without Tax</label>
                        </div>
                        <div class="col-md-6">
                            <input  type="text" class="form-control" value="<?=@$purchase_order->total_without_tax?>" id="total_without_tax" name="total_without_tax" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Total Amount</label>
                        </div>
                        <div class="col-md-6">
                            <input  type="text" class="form-control" value="<?=@$purchase_order->total_amount?>" id="total_amount" name="total_amount" placeholder="">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description"><?=@$purchase_order->description?></textarea> 
                        </div>
                    </div> 

                    <div class="row form-group">
                        <label class="col-sm-4 control-label">Comments</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="comments"><?=@$purchase_order->comments?></textarea> 
                        </div>
                    </div>
                </div>


                <div class="col-md-6">

                    <div class="row form-group required">
                        <div class="col-md-4">
                            <label for="inputEmail4">Approved By </label>
                        </div>                               
                        <div class="col-md-6">
                            <select id="approved_by" name="approved_by" class="form-control required dashboard-dropdown">
                                <option value="" selected="">--Selected--</option>
                                <?php foreach($customers as $row):?>
                                    <option value="<?= $row['id'];?>" <?php if($row['id'] == @$purchase_order->approved_by){ echo "selected"; }?>><?= $row['company_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group required">
                        <div class="col-md-4">
                            <label for="inputPassword4">Project Code </label>
                        </div>                               
                        <div class="col-md-6">
                            <select name="project_code" id="project_code" class="form-control required dashboard-dropdown">
                                <option value="">--Please Select--</option>
                                <option value="4D" <?=@$purchase_order->project_code=='4D'?'selected':''?> >4D</option>
                                <option value="CatBase" <?=@$purchase_order->project_code=='CatBase'?'selected':''?> > CatBase</option>
                                <option value="Cloud Consultancy" <?=@$purchase_order->project_code=='Cloud Consultancy'?'selected':''?> > Cloud Consultancy</option>
                                <option value="Cloud Native Engineering" <?=@$purchase_order->project_code=='Cloud Native Engineering'?'selected':''?> > Cloud Native Engineering</option>
                                <option value="Database" <?=@$purchase_order->project_code=='Database'?'selected':''?> > Database</option>
                                <option value="Domains" <?=@$purchase_order->project_code=='Domains'?'selected':''?> > Domains</option>
                                <option value="IMG2D" <?=@$purchase_order->project_code=='IMG2D'?'selected':''?> > IMG2D</option>
                                <option value="IT Consulting" <?=@$purchase_order->project_code=='IT Consulting'?'selected':''?> > IT Consulting</option>
                                <option value="Jobshout" <?=@$purchase_order->project_code=='Jobshout'?'selected':''?> > Jobshout</option>
                                <option value="Mobile App" <?=@$purchase_order->project_code=='Mobile App'?'selected':''?> > Mobile App</option>
                                <option value="Mobile Friendly Website" <?=@$purchase_order->project_code=='Mobile Friendly Website'?'selected':''?> > Mobile Friendly Website</option>
                                <option value="Nginx" <?=@$purchase_order->project_code=='Nginx'?'selected':''?> > Nginx</option>
                                <option value="Time-Based" <?=@$purchase_order->project_code=='Time-Based'?'selected':''?> > Time-Based</option>
                                <option value="TIZO" <?=@$purchase_order->project_code=='TIZO'?'selected':''?> > TIZO</option>
                                <option value="WEBSITE" <?=@$purchase_order->project_code=='WEBSITE'?'selected':''?> > WEBSITE</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputEmail4">Supplier Vat Number</label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="text" autocomplete="off" class="form-control " id="supplier_vat_no" name="supplier_vat_no" placeholder="" value="<?= @$purchase_order->supplier_vat_no?>">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputPassword4">Payment Due On</label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="text" autocomplete="off" class="form-control datepicker" id="payment_due_on" name="payment_due_on" placeholder="" value="<?=render_date(@$purchase_order->payment_due_on)?>">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputPassword4">Payment Made On Date</label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="text" autocomplete="off" class="form-control datepicker" id="payment_made_date" name="payment_made_date" placeholder="" value="<?=render_date(@$purchase_order->payment_made_date)?>">
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">
                            <label for="inputPassword4">Billing Frequency</label>
                        </div>                               
                        <div class="col-md-6">
                            <input  type="input" class="form-control" id="billing_frequency" name="billing_frequency" placeholder="" value="<?=@$purchase_order->billing_frequency?>">
                        </div>
                    </div>

                    <div class="row form-group ">

                        <div class="col-md-4">

                        </div>                               
                        <div class="col-md-6">
                            <span class="help-block">
                                <input type="checkbox" <?php if(@$purchase_order->purchase_order_inactive)echo "checked";?> name="purchase_order_inactive" id="purchase_order_inactive">
                            </span>
                            <span class="help-block">Purchase Order Inactive</span>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-4">

                        </div>                               
                        <div class="col-md-6">
                            <span class="help-block">
                                <input type="checkbox" <?php if(@$purchase_order->vat_charge)echo "checked";?> name="vat_charge" id="vat_charge">
                            </span>
                            <span class="help-block">Vat Charged</span>
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
