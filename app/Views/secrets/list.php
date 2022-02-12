<?php require_once (APPPATH.'Views/common/list-title.php'); ?>

<div class="white_card_body ">
    <div class="QA_table ">
        <!-- table-responsive -->
        <table id="example" cellpadding="5" class="table tableDocument table-striped table-bordered">
            <thead>
                <tr>
                    
                    <th scope="col">Id</th>
                    <th scope="col">Key name</th>
                    
                    <th scope="col">Services</th>
                    
                    <th scope="col">created at</th>
                    <?php if(!empty($_SESSION['role'])){ ?><th scope="col" width="50">Action</th><?php } ?>
                </tr>
            </thead>
            <tbody>                                        
            
            <?php foreach($content as $row): ?>
            <tr data-href="/secrets/edit/<?= $row['id'];?>">
                
                <td class="f_s_12 f_w_100"> <a href="/secrets/edit/<?= $row['id'];?>"><?= $row['id'];?> </a></td>
                <td class="f_s_12 f_w_200"><a href="/secrets/edit/<?= $row['id'];?>"><?= $row['key_name'];?></a></td>
                <td class="f_s_12 f_w_100"><a href="/secrets/edit/<?= $row['id'];?>"><?= $row['name'];?></a></td>
                
                <?php /* ?><td class="f_s_12 f_w_400 <!--?=$row['status']==0?'text_color_1':'text_color_2'?--> "><?=$row['status']==0?'XXXXXXXXX':$row['key_value']?>
                </td>
                <td class="f_s_12 f_w_400  ">
                <?php if(!empty($row['image_logo'])) { ?>
                    <img src="<?='data:image/jpeg;base64,'.$row['image_logo']?>" width="200px">
                <?php } ?>
                </a>
                </td> */ ?>
                                                        
                <td class="f_s_12 f_w_400 text_color_1 ">
                <a href="/secrets/edit/<?= $row['id'];?>"><p class="pd10"> <?= $row['created'];?></p></a>
                </td>
                <?php if(!empty($_SESSION['role'])){ ?> <td class="f_s_12 f_w_400 text-right">
                    <div class="header_more_tool">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="ti-more-alt"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                
                                <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href="/secrets/delete/<?= $row['id'];?>"> <i class="ti-trash"></i> Delete</a>
                                <a class="dropdown-item" href="/secrets/edit/<?= $row['id'];?>"> <i class="fas fa-edit"></i> Edit</a>
                                
                                
                            </div>
                        </div>
                    </div>
                </td>   
                <?php } ?>                                        
            </tr>
            
            <?php endforeach;?>  

            </tbody>
        </table>
    </div>
</div>

<?php require_once (APPPATH.'Views/common/footer.php'); ?>