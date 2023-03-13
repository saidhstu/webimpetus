<?php require_once(APPPATH . 'Views/timeslips/list-title.php'); ?>
<div class="white_card_body ">
    <div class="QA_table ">
        <!-- table-responsive -->
        <table id="example" class="table table-listing-items tableDocument table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="30"></th>
                    <?php foreach ($fields as $field) { ?>
                        <th scope="col"><?php echo lang('Timeslips.'.$field); ?></th>
                    <?php } ?>
                    <th scope="col" width="50"><?php echo lang('Common.action');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (${$tableName} as $row) { ?>
                    <tr data-link="/<?php echo $tableName; ?>/edit/<?= $row[$identifierKey]; ?>">
                        <td class="f_s_12 f_w_400"><input type="checkbox" value="<?= $row['uuid'] ?>" class="check_all" onclick="setExportItem(this);"></td>
                        <?php foreach ($fields as $field) { ?>
                            <td class="f_s_12 f_w_400"><?= $row[$field]; ?></td>
                        <?php } ?>
                        <td class="f_s_12 f_w_400 text-right">
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                        <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href="/<?php echo $tableName; ?>/delete/<?= $row[$identifierKey]; ?>"> <i class="ti-trash"></i> Delete</a>
                                        <a class="dropdown-item" href="/<?php echo $tableName; ?>/edit/<?= $row[$identifierKey]; ?>"> <i class="fas fa-edit"></i> Edit</a>
                                        <a class="dropdown-item" href="/<?php echo $tableName; ?>/clone/<?= $row[$identifierKey]; ?>"> <i class="fas fa-copy"></i> Clone</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php require_once(APPPATH . 'Views/timeslips/footer.php'); ?>

<script>
    $('.table-listing-items  tr  td').on('click', function(e) {
        var dataClickable = $(this).parent().attr('data-link');
        if ($(this).is(':last-child') || $(this).is(':first-child')) {} else {
            if (dataClickable && dataClickable.length > 0) {
                window.location = dataClickable;
            }
        }
    });

    var exportIds = [];

    function setExportItem(this_element) {
        if (this_element.checked) {
            exportIds.push(this_element.value);
        } else {
            var index = exportIds.indexOf(this_element.value);
            if (index !== -1) {
                exportIds.splice(index, 1);
            }
        }
        $('[name="exportIds"]').val(JSON.stringify(exportIds));

        if (exportIds.length) {
            $(".time-picker").hide();
        } else {
            $(".time-picker").show();
        }
    }
</script>