<?php require_once (APPPATH.'Views/common/list-title.php'); ?>
    <div class="white_card_body ">
        <div class="QA_table ">
            <!-- table-responsive -->
            <table id="example"  class="table tableDocument table-bordered table-hover">
                <thead>
                    <tr>
                        
                        <th scope="col">Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Title</th>
                        <th scope="col">Email</th>
                        <th scope="col" width="50">Action</th>
                    </tr>
                </thead>
                <tbody>                                        
                
                <?php foreach($contacts as $row):?>
                <tr data-href="contacts/edit/<?= $row['id'];?>">
                    
                    <td class="f_s_12 f_w_400"><a href="contacts/edit/<?= $row['id'];?>"><?= $row['id'];?></a>
                    </td>
                    <td class="f_s_12 f_w_400"><a href="contacts/edit/<?= $row['id'];?>"><?= $row['first_name'];?> </a>
                    </td>
                    <td class="f_s_12 f_w_400 text_color_1 "><a href="contacts/edit/<?= $row['id'];?>"><?= $row['surname'];?></a>
                    </td>
                    <td class="f_s_12 f_w_400  "><a href="contacts/edit/<?= $row['id'];?>"> <?= $row['title'];?>
                    </a>
                    </td>
                    <td class="f_s_12 f_w_400 text_color_1 ">
                            <p class="pd10"> <?= $row['email'];?></p>
                    </td>
                    <td class="f_s_12 f_w_400 text-right">
                        <div class="header_more_tool">
                            <div class="dropdown">
                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    
                                    <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href="/contacts/delete/<?= $row['id'];?>"> <i class="ti-trash"></i> Delete</a>
                                    <a class="dropdown-item" href="/contacts/edit/<?= $row['id'];?>"> <i class="fas fa-edit"></i> Edit</a>
                                    
                                    
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