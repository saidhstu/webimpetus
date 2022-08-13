<!DOCTYPE html>
<html>
<head>
<title>Timeslips</title>
</head>
<body>
       
        <table  border="0" cellpadding="5" style="font-family: Arial; font-size: 13px; width:100%;">
            <thead></thead>
             <tbody>
                    <tr>
                        <td> <h1> Timeslips </h1></td>
                        <td></td>
                        <td>Timeslip period</td>
                        <td></td>
          
                    </tr>

                    <tr>
                        <td>  Project name</td>
                        <td></td>
                        <td>Date</td>
                        <td></td>
          
                    </tr>
                    <tr>
                        <td> Consultant Name</td>
                        <td><?php echo $employeeData->first_name." ".$employeeData->surname; ?></td>
                        <td>Timeslips date</td>
                        <td><?php echo date("d-m-Y", time()); ?></td>
          
                    </tr>
                    <tr>
                        <td>Consultant Email </td>
                        <td><?php echo $employeeData->email; ?></td>
                        <td>Total</td>
                        <td></td>
          
                    </tr>
                    <tr>
                    
                    </tr>
       
                </tbody>

        </table>

        <table  border="0" cellpadding="5" cellspacing="5"   style="font-family: Arial; font-size: 13px; width:100%;">
        <thead>
            <tr>
            <th align="left" width="15%"> Task Name </th>
            <th align="left"  width="20%"> Employee Name </th>
            <th align="left"  width="20%"> Start Date</th>
            <th align="left"  width="15%"> End Date</th>
            <th align="left" width="30%"> Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($timeslips as $timeslip) { ?>
            <tr>
                <td>
                    <?= $timeslip["tasks_name"]; ?>
                </td>
      
                <td>
                    <?= $timeslip["employee_first_name"]." ". $timeslip["employee_surname"]; ?>
                </td>
      
                <td>
                    <?= date("d-m-Y", $timeslip["slip_start_date"]); ?>
                </td>
                <td>
                    <?= date("d-m-Y", $timeslip["slip_end_date"]); ?>
                </td>
      
                <td>
                    <?= $timeslip["slip_description"]; ?>
                </td>
      
            </tr>
            <?php } ?>
        </tbody>
        
    </table>
</body>
</html