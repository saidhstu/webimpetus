<?php require_once (APPPATH.'Views/common/list-title.php'); ?>

<div class="white_card_body ">
    <div class="projects_table">
        <!-- table-responsive -->
        <table id="projectsTable"  class="table table-listing-items tableProjects table-striped table-bordered">
            <thead>
                <tr>
                    
                    <th scope="col">Id</th>
                    <th scope="col">UUID</th>
                    <th scope="col">Client ID</th>
                    <th scope="col">Project name</th>     
                    <th scope="col">Start date</th> 											
                    <th scope="col">Budget</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Deadline date</th>
                    <th scope="col">Project incharge</th>
                    <th scope="col">Project active</th>
                    <th scope="col" width="50">Action</th>
                </tr>
            </thead>
            <tbody>                                        
            
            <?php foreach($projects as $row) { ?>  
                <tr data-link="/projects/edit/<?= $row['id'];?>">                                     
                    <td class="f_s_12 f_w_400"><?= $row['id'];?>
                    </td>
                    <td class="f_s_12 f_w_400"><?= $row['uuid'];?> 
                    </td>
                    <td class="f_s_12 f_w_400 "><?= $row['client_id'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['project_name'];?>
                    </td>
                    
                    <td class="f_s_12 f_w_400"><?= $row['start_date'];?> 
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['budget'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['rate'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['currency'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['deadline_date'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['project_incharge'];?>
                    </td>
                    <td class="f_s_12 f_w_400  "><?= $row['project_active'];?>
                    </td>
                    <td class="f_s_12 f_w_400 text-right">
                        <div class="header_more_tool">
                            <div class="dropdown">
                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    
                                    <a class="dropdown-item" onclick="return confirm('Are you sure want to delete?');" href="/projects/delete/<?= $row['id'];?>"> <i class="ti-trash"></i> Delete</a>
                                    <a class="dropdown-item" href="/projects/edit/<?= $row['id'];?>"> <i class="fas fa-edit"></i> Edit</a>
                                    
                                    
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

<?php require_once (APPPATH.'Views/common/footer.php'); ?>
