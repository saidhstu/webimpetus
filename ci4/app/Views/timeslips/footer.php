                      
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Timeslipt Pdf</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?php echo base_url("timeslips/exportPDF"); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Employee</label>
                <select name="employee" class="form-control" id="exampleFormControlSelect1">
                <option value="-1" selected>All</option>
                <?php foreach(@$employees as $employee){?>
                    <option value="<?php echo $employee["id"]; ?>"><?php echo $employee["name"];?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                    <label for="monthpicker">Month</label>
                    <select class="form-control" id="monthpicker" name="monthpicker">
                    </select>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                    <label for="monthpicker">Year</label>
                    <select class="form-control" id="yearpicker" name="yearpicker">
                    </select>
                </div>
                </div>

            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  type="submit"  class="btn btn-primary" >Export PDF </button>
        </div>
        </form>
        </div>
    </div>
</div>

<?php require_once (APPPATH.'Views/common/scripts.php'); ?>
<!-- footer part -->
<?php require_once (APPPATH.'Views/common/footer_copyright.php'); ?>

</section>
   <script type="text/javascript">
    let startYear = 2000;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--)
    {
      $('#yearpicker').append($('<option />').val(i).html(i));
    }

    let startMonth = 1;
    let endMonth = 12;
    for (i = startMonth; i <= endMonth; i++)
    {
        j = ('0'+i).slice(-2);
      $('#monthpicker').append($('<option />').val(j).html(j));
    }


    </script>