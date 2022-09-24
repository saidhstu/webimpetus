<?php require_once(APPPATH . 'Views/common/list-title.php');
$status = ["Estimate", "Quote", "Ordered", "Acknowledged", "Authorised", "Delivered", "Completed", "Proforma Invoice"];
?>
<div class="white_card_body ">
    <div class="QA_table ">
        <!-- table-responsive -->
        <table id="example" class="table table-listing-items tableDocument table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Order No</th>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Client</th>
                    <th scope="col">Project</th>
                    <th scope="col">Total</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Paid Date</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="50">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchase_orders as $row) : ?>
                    <tr data-link=<?= "/" . $tableName . "/edit/" . $row['id']; ?>>
                        <td class="f_s_12 f_w_400"><?= $row['id']; ?>
                        </td>
                        <td class="f_s_12 f_w_400"><?= $row['order_number']; ?>
                        </td>
                        <td class="f_s_12 f_w_400  "><?= render_date($row['date']); ?> </td>
                        <td class="f_s_12 f_w_400  "><?= $row['company_name']; ?> </td>
                        <td class="f_s_12 f_w_400  "><?= $row['project_code']; ?> </td>
                        <td class="f_s_12 f_w_400  "><?= $row['total']; ?> </td>
                        <td class="f_s_12 f_w_400  "><?= $row['balance_due']; ?> </td>
                        <td class="f_s_12 f_w_400  "><?= render_date($row['paid_date']); ?> </td>
                        <td class="f_s_12 f_w_400  "><?= $status[$row['status']]; ?> </td>
                        <td class="f_s_12 f_w_400 text-right">
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                        <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href=<?= "/" . $tableName . "/delete/" . $row['id']; ?> <i class="ti-trash"></i> Delete</a>
                                        <a class="dropdown-item" href="<?= "/" . $tableName . "/edit/" . $row['id']; ?>"> <i class="fas fa-edit"></i> Edit</a>
                                        <a class="dropdown-item" href="<?= "/" . $tableName . "/exportPDF/" . $row['id']; ?>"> <i class="ti-printer"></i> Print PDF</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once(APPPATH . 'Views/common/footer.php'); ?>