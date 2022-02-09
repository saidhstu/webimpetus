<?php require_once (APPPATH.'Views/common/list-title.php'); ?>

<div class="white_card_body ">
    <div class="QA_table ">
        <!-- table-responsive -->
        <table id="example"  class="table tableDocument table-striped table-bordered">
            <thead>
                <tr>
                    
                    <th scope="col">Id</th>
                    <th scope="col">UUID</th>
                    <th scope="col">Service</th>
                    <th scope="col">Name</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Note</th>
                        <!--th scope="col">Status</th-->
                        
                    <th scope="col" width="50">Action</th>
                    </tr>
            </thead>
            <tbody>                                        
            
            <?php foreach($domains as $row):?> 
            <tr >
                
                    <td class="f_s_12 f_w_400"><a href="/domains/edit/<?= $row['id'];?>"><?= $row['id'];?></a>
                </td>
                <td class="f_s_12 f_w_400"><a href="/domains/edit/<?= $row['id'];?>"><?= $row['uuid'];?> </a>
                
                <td class="f_s_12 f_w_400"><a href="/domains/edit/<?= $row['id'];?>"><?= $row['sname'];?> </a>
                
                </td>
                <td class="f_s_12 f_w_400 text_color_1 "><a href="/domains/edit/<?= $row['id'];?>"><?= $row['name'];?></a>
                </td>
                <td class="f_s_12 f_w_400 text_color_1 ">
                    <?php if(!empty($row['image_logo'])) { //header('Content-type: image/jpeg'); ?>
                    <img src="<?= $row['image_logo']?>" width="200px">
                <?php } ?>
                </td>
                <td class="f_s_12 f_w_400 text_color_1 ">
                        <p class="pd10"> <?= $row['notes'];?> </p>
                </td>
                
                <td class="f_s_12 f_w_400 text-right">
                    <div class="header_more_tool">
                    
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="ti-more-alt"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                
                                <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href="/domains/delete/<?= $row['id'];?>"> <i class="ti-trash"></i> Delete</a>
                                <a class="dropdown-item" href="/domains/edit/<?= $row['id'];?>"> <i class="fas fa-edit"></i> Edit</a>
                                
                                
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