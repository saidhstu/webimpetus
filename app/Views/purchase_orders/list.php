<?php require_once (APPPATH.'Views/common/list-title.php'); ?>
<div class="white_card_body ">
    <div class="QA_table ">
        <!-- table-responsive -->
        <table id="example"  class="table table-listing-items tableDocument table-striped table-bordered">
            <thead>
                <tr>

                    <th scope="col">Purchase Order Number</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Client</th>
                    <th scope="col">Project Code</th>
                    <th scope="col">Payment Due Date</th>
                    <th scope="col">Total Without Vat</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Order Status</th>
                    <th scope="col" width="50">Action</th>
                </tr>
            </thead>
            <tbody> 


                <?php foreach($purchase_orders as $row):?>
                    <tr data-link=<?= "/".$tableName."/edit/".$row['id'];?> >

                        <td class="f_s_12 f_w_400"><?= $row['purchase_order_no'];?> </td>
                        <td class="f_s_12 f_w_400  "><?= render_date($row['start_date']);?></td>
                        <td class="f_s_12 f_w_400"><?= $row['company_name'];?></td>
                        <td class="f_s_12 f_w_400  "><?= $row['project_code'];?> </td>
                        <td class="f_s_12 f_w_400  "><?= render_date($row['payment_due_on']);?></td>
                        <td class="f_s_12 f_w_400  "><?= $row['total_without_tax'];?></td>
                        <td class="f_s_12 f_w_400  "><?= $row['total_amount'];?></td>
                        <td class="f_s_12 f_w_400  "><?= @$row['order_status'];?></td>

                        <td class="f_s_12 f_w_400 text-right">
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                        <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href=<?= "/".$tableName."/delete/".$row['id'];?> <i class="ti-trash"></i> Delete</a>
                                        <a class="dropdown-item" href="<?= "/".$tableName."/edit/".$row['id'];?>"> <i class="fas fa-edit"></i> Edit</a>


                                    </div>
                                </div>
                            </div>
                        </td>   

                    </tr>

                <?php endforeach;?>  


            </tbody>
        </table>
    </div>
</div>

<?php require_once (APPPATH.'Views/common/footer.php'); ?>