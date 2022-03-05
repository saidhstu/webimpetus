<?php require_once (APPPATH.'Views/common/list-title.php'); ?>
    <div class="white_card_body ">
        <div class="QA_table ">
            <!-- table-responsive -->
            <table id="example"  class="table table-listing-items tableDocument table-striped table-bordered">
                <thead>
                    <tr>
                        
                        <th scope="col">File</th>
                        <th scope="col">Client</th>
                        <th scope="col">Created</th>
                        <th scope="col">Modified</th>

                        <th scope="col" width="50">Action</th>
                        <th scope="col" width="500">Preview</th>
                    </tr>
                </thead>
                <tbody>                                        
                
                <?php foreach($documents as $row):?>
                <tr data-link=<?= "/".$tableName."/edit/".$row['id'];?> >

                    <td class="f_s_12 f_w_400 open-file" ><?= $row['file'];?></td>
                    <td class="f_s_12 f_w_400"><?= $row['company_name'];?></td>
                    <td class="f_s_12 f_w_400"><?= render_date(strtotime($row['created_at']));?></td>
                    <td class="f_s_12 f_w_400"><?= render_date(strtotime($row['modified_at']));?></td>




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
                    <td class="f_s_12 f_w_400 preview-file" ></td>
                                                        
                </tr>
                
                <?php endforeach;?>  
   
                    
                </tbody>
            </table>
        </div>
    </div>

<?php require_once (APPPATH.'Views/documents/footer.php'); ?>

<script>

$('.table-listing-items  tr  td').on('click' , function(e) {
	  
      var dataClickable = $(this).parent().attr('data-link');
      if($(this).is(':last-child') || $(this).is(':first-child')){
      }else{
          if(dataClickable && dataClickable.length > 0){
               
              window.location = dataClickable;
            }
      }
          
  });
  
$(document).on("click", ".open-file", function(e){ 

    e.preventDefault();

    var filePath = $(this).text();

    $.ajax({
            url: baseUrl + "/documents/renderFile",
            data:{ totalAmount:totalAmount, mainTableId:mainTableId, totalHour:totalHour, totalAmountWithTax:totalAmountWithTax, total_tax  :tax},
            method:'post',
            success:function(res){
     
    
            }
        })
    var html = '<embed src="https://drive.google.com/viewerng/viewer?embedded=true&url='+filePath+'" width="700" height="500">';

    $(this).closest('tr').find('.preview-file').text(html);

})
  
</script>