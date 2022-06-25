<?php require_once (APPPATH.'Views/common/edit-title.php'); ?>
<?php 
$customers = getResultArray("customers", ["supplier" => 1]);
$templates = getResultArray("templates");
$items = getWithOutUuidResultArray("purchase_order_items", ["purchase_orders_id" => @$purchase_order->id], false);
// $notes = getResultArray("purchase_order_notes", ["purchase_orders_id" => @$purchase_order->id], false);
// pre($items);
$status = ["Estimate", "Quote","Ordered","Acknowledged","Authorised","Delivered","Completed","Proforma Invoice"];
?>

<div class="white_card_body">
    <div class="card-body">

        <form id="addcustomer" method="post" action=<?php echo "/".$tableName."/update";?> enctype="multipart/form-data">
            <input type="hidden" value="<?=@$purchase_order->id?>" name="id" id="mainTableId">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Order Details</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> Other Details</a>
                          


                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0 col-md-12" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="row form-group row-space ">
                                        <div class="col-md-4">
                                            <label for="inputEmail4">Order Number</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input readonly type="text" autocomplete="off" class="form-control" value="<?=@$purchase_order->order_number?>" id="order_number" name="order_number" placeholder="">
                                        </div>
                                    </div>
                                    
                                    <div class="row form-group row-space required">
                                        <div class="col-md-4">
                                            <label for="inputEmail4">Supplier  </label>
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
                                    <div class="row form-group row-space ">
                                        <div class="col-md-4">
                                            <label for="inputEmail4">Bill To </label>
                                        </div>                               
                                        <div class="col-md-6">
                                            <textarea name="bill_to" class="form-control"><?=@$purchase_order->bill_to?></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group row-space ">
                                        <div class="col-md-4">
                                            <label for="inputEmail4">Order By </label>
                                        </div>                               
                                        <div class="col-md-6">
                                            <input type="text" autocomplete="off" class="form-control" value="<?=@$purchase_order->order_by?>" id="order_by" name="order_by" placeholder="">
                                        </div>
                                    </div>

                                    <div class="row form-group row-space ">
                                        <div class="col-md-4">
                                            <label for="inputEmail4">Comments </label>
                                        </div>                               
                                        <div class="col-md-6">
                                            <textarea name="comments" id="comments" class="form-control" cols="15" rows="5">
                                                <?=@$purchase_order->comments?>
                                            </textarea>
                                           
                                        </div>
                                    </div>

                                   

                                    
                                    <div class="row form-group row-space ">
                                        <div class="col-md-4">
                                        <label for="inputPassword4">Print Template Code</label>
                                        </div>                               
                                        <div class="col-md-6">
                                        <select id="template" name="template" class="form-control  dashboard-dropdown">
                                            <option value="" selected="">--Please Selected--</option>
                                            <?php foreach($templates as $row):?>
                                                <option value="<?= $row['id'];?>" <?php if($row['id'] == @$purchase_order->template){ echo "selected"; }?>><?= $row['code'];?></option>
                                            <?php endforeach;?>
                                        </select> 
                                    </div>
                                    </div>


                                    <div class="row form-group ">
                                        <div class="col-md-4">
                                            <label for="inputPassword4">Project Code </label>
                                        </div>                               
                                        <div class="col-md-6">
                                            <select name="project_code" id="project_code" class="form-control dashboard-dropdown">
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

                                </div>


                                <div class="col-md-6">

                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                        <label for="inputEmail4">Date</label>
                                    </div>                               
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" autocomplete="off" class="form-control datepicker" value="<?=render_date(@$purchase_order->date)?>" id="date" name="date" placeholder="">
                                    </div>
                                </div>

                               

                                <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                        <label for="inputPassword4">Balance Outstanding</label>
                                    </div>                               
                                    <div class="col-md-6">
                                        <input readonly type="input" class="form-control" id="balance_due" name="balance_due" placeholder="" value="<?=@$purchase_order->balance_due?>">
                                    </div>
                                </div>

                                <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                        <label for="inputPassword4">Status</label>
                                    </div>                               
                                    <div class="col-md-6">
                                        <select name="status" id="status" class="form-control dashboard-dropdown">
                                        <?php foreach($status as $key => $value):?>
                                                <option value="<?= $key;?>" <?php if($key == @$purchase_order->status){ echo "selected"; }?>><?= $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                               

                                <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                        <label for="inputPassword4">Grand Total</label>
                                    </div>                               
                                    <div class="col-md-6">
                                        <input readonly type="total" class="form-control" id="total" name="total" placeholder="" value="<?=@$purchase_order->total?>">
                                    </div>
                                </div>
                               
                                <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                        <label for="inputPassword4">Paid Date</label>
                                    </div>                               
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" class="form-control datepicker" id="paid_date" name="paid_date" placeholder="" value="<?=render_date(@$purchase_order->paid_date)?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12"> 
                             
                                <div class=" table-responsive table-full-width">
                                    <div class="table-responsive" style="border:none;">
                                        <table class="table table-striped  table-bordered table-hover custom-tbl-st" id="table-breakpoint" style="background-color: rgb(255, 255, 255); border-radius: 4px;">
                                            <tbody>
                                                <tr class="item">
                                                    <th data-th="Item"><span class="bt-content">Item</span></th>
                                                    <th data-th="Description"><span class="bt-content">Description</span></th>
                                                    <th data-th="Rate"><span class="bt-content">Rate</span></th>
                                                    <th data-th="qty"><span class="bt-content">qty</span></th>
                                                    <th data-th="discount"><span class="bt-content">Discount</span></th>
                                                    <th data-th="Amount"><span class="bt-content">Amount</span></th>
                                                    <th class="td_edit" data-th="Edit/Save"><span class="bt-content">Edit/Save</span></th>
                                                    <th class="td_remove" data-th="Cancel/Remove"><span class="bt-content">Cancel/Remove</span></th>
                                                </tr>
                                                
                                             

                                                <?php foreach( $items as $eachItems){?>
                                                    <tr class="item-row" id="<?= $eachItems->id?>">
                                                        <td class="item-id" data-th="Item"><span class="bt-content"><div class="delete-wpr"><span class="item_id"><?= $eachItems->id?></span>
                                                            <input name="item_id[]" type="hidden" value="<?= $eachItems->id?>">
                                                        </div></span></td>
                                                        <td data-th="Description"><span class="bt-content">
                                                            <span class="s_description" style="display: inline;"><?= $eachItems->description?></span>
                                                            <textarea class="description form-control" style="display: none;"><?= $eachItems->description?></textarea>
                                                        </span></td>
                                                        <td data-th="Rate"><span class="bt-content">
                                                            <span class="s_rate" style="display: inline;"><?= $eachItems->rate?></span>
                                                            <input type="text" autocomplete="off" class="rate num form-control" style="display: none;width:100%" value="<?= $eachItems->rate?>">
                                                        </span></td>
                                                        <td data-th="Qty"><span class="bt-content">
                                                            <span class="s_qty" style="display: inline;"><?= $eachItems->qty?></span>
                                                            <input type="text" autocomplete="off" class="qty num form-control" style="display: none;" value="<?= $eachItems->qty?>">
                                                        </span></td>
                                                        <td data-th="Discount"><span class="bt-content">
                                                            <span class="s_discount" style="display: inline;"><?= $eachItems->discount?></span>
                                                            <input type="text" autocomplete="off" class="discount num form-control" style="display: none;" value="<?= $eachItems->discount?>">
                                                        </span></td>
                                                        <td data-th="Amount"><span class="bt-content">
                                                            <span class="price"><?= $eachItems->amount?></span>
                                                           
                                                        </span></td>
                                                        
                                                        <td class="td_edit" data-th="Edit/Save"><span class="bt-content">
                                                            
                                                            <a href="javascript:void(0)" class="editlink" title="Edit" style=""><i class="fa fa-edit"></i></a>
                                                            
                                                            <a href="javascript:void(0)" class="savelink" style="display:none" title="" aria-describedby="ui-tooltip-1"><i class="fa fa-save"></i></a>
                                                            
                                                            
                                                            
                                                        </span></td>	
                                                        <td class="td_remove" data-th="Cancel/Remove"><span class="bt-content">
                                                            <a href="javascript:void(0)" class="removelink" title="Rmove" style=""><i class="fa fa-trash"></i></a>
                                                            <a href="javascript:void(0)" class="cancellink" style="" title="Cancel"><i class="fa fa-remove"></i></a>
                                                        </span></td>
                                                        
                                                    </tr> 
                                                <?php }?>





                                            </tbody>
                                        </table>	
                                    </div>
                                </div>

                                <div class="row form-group row-space hidden-xs" style="margin-bottom:5px;margin-left: 5px;">
                                    <button type="button" class="btn btn-primary btn-color margin-right-5 btn-sm" id="addrow" style="float:right;">+ Add a new item</button>
                                </div>






                              
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Total Qty</label>
                                    <div class="col-sm-3"><input name="total_qty" class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->total_qty?>" id="total_qty" readonly=""></div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Order Subtotal</label>
                                    <div class="col-sm-3"><input class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->subtotal?>" name="subtotal" id="subtotal" readonly=""></div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Discount (%)</label>
                                    <div class="col-sm-3"><input class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->discount?>" name="discount" id="totalDiscount" readonly=""></div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Total Due</label>
                                    <div class="col-sm-3"><input class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->total_due?>" name="total_due" id="total_due" readonly=""></div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Tax Code</label>
                                    
                                    <div class="col-sm-3">
                                        <select id="tax_code" name="tax_code" class="form-control">	
                                            <option value="UK" selected="">UK</option>
                                        </select>                             
                                    </div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Total Tax</label>
                                    <div class="col-sm-3"><input name="total_tax" class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->total_tax?>" id="total_tax" readonly=""></div>
                                </div>
                                <div class="row form-group row-space">
                                    <label class="col-sm-2 control-label">Total Due With Tax</label>
                                    <div class="col-sm-3"><input name="total_due_with_tax" class="form-control" type="text" autocomplete="off" value="<?=@$purchase_order->total_due_with_tax?>" id="total_due_with_tax" readonly=""></div>
                                </div>

                                

                            </div>


                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">


                            <div class="form-group col-md-6">
                             

                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                    <label for="inputEmail4">Customer ref or PO</label>
                                    </div>                               
                                    <div class="col-md-6">
                                    <input type="text" autocomplete="off" class="form-control" id="customer_ref_po" name="customer_ref_po" placeholder="" value="<?=@$purchase_order->customer_ref_po?>">
                                </div>
                                </div>
                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                    <label for="inputEmail4">Tax Rate</label>
                                    </div>                               
                                    <div class="col-md-6">
                                    <input type="number" class="form-control" id="tax_rate" name="tax_rate" placeholder="" value="<?=@$purchase_order->tax_rate?>">
                                </div>
                                </div>

                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                    <label for="inputEmail4">Customer Currency Code</label>
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


                            </div>
                            <div class="form-group col-md-6">
                              

                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                    <label for="inputPassword4">Base Currency Code</label>
                                    </div>                               
                                    <div class="col-md-6">
                                    <input type="text" autocomplete="off" class="form-control" id="base_currency_code" name="base_currency_code" placeholder="" value="<?=@$purchase_order->base_currency_code?>">

                                </div>
                                </div>
                                 <div class="row form-group row-space ">
                                    <div class="col-md-4">
                                    <label for="inputPassword4">Exchange Customer Currency to Base Currency</label>
                                    </div>                               
                                    <div class="col-md-6">
                                    <input type="text" autocomplete="off" class="form-control" id="exchange_rate" name="exchange_rate" placeholder="" value="<?=@$purchase_order->exchange_rate?>">

                                </div>
                                </div>
                            </div>


                        </div>
                    </div>



                </div>

            </div>


            <div class="col-xs-12 col-md-12">
            </div>

        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>

<style>
    .row-space{
        margin-top:25px;
        margin-bottom:25px;
    }
</style>
<?php require_once (APPPATH.'Views/common/footer.php'); ?>
<script src="/assets/js/purchase_orders.js"></script>
<!-- main content part end -->

<script>
    var baseUrl = "<?php echo base_url();?>";
    $(document).on("click", ".form-check-input", function(){
        if($(this).prop("checked") == false){
            $(this).val(0);
        }else{
            $(this).val(1);
        }
    });

    $(document).on("change", "#client_id", fillupBillToAddress);
</script>
