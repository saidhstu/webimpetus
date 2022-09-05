<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Timeslips</title>
    <style>
       tr:nth-child(even) {
         background-color: #f2f2f2;
        }
  </style>

  </head>
  <body>
    <hr class="line-title">
       <table  border="0" cellpadding="5" style="font-family: Arial; font-size: 13px; width:100%;">
            <thead></thead>
             <tbody>
                    <tr>
                        <td> <h1><b>MONTHLY TIMESHEET </b> </h1></td>
                        <td></td>
                        <td></td>
                        <td></td>
          
                    </tr>

                    <tr>
                        <td>  Project name</td>
                        <td>HD4D</td>
                        <td>Timeslip date</td>
                        <td><?php echo date("d-m-Y", time()); ?></td>
          
                    </tr>
                    <tr>
                        <td> Consultant Name</td>
                        <td><?php echo $employeeData->first_name." ".$employeeData->surname; ?></td>
                        <td>Timeslip period</td>
                        <td><?php echo date("d-m-Y",strtotime("+30 days") ); ?></td>
          
                    </tr>
                    <tr>
                        <td>Consultant Email </td>
                        <td><?php echo $employeeData->email; ?></td>
                        <td>Total Hours</td>
                        <td> </td>
          
                    </tr>
                    <tr>
                    
                    </tr>
       
                </tbody>

        </table>
        <hr class="line-title">
        <table   style="font-family: Arial; font-size: 13px; width:100%;" class="table table-striped ">
          <thead >
            <tr style="background-color: #c0c0c0;">
              <th align="left" width="5%"> Week </th>    
              <th align="left" width="10%"> Task Name </th>
              <th align="left"  width="20%"> Employee Name </th>
              <th align="left"  width="10%"> Date</th>
              <th align="left"  width="10%"> Start</th>
              <th align="left"  width="10%"> End</th>
              <th align="left" width="30%"> Description</th>
              <th align="left" width="5%"> Hours</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($timeslips as $timeslip) { ?>
                
            <tr>
                <td>
                    <?= $timeslip["week_no"];  ?>
                </td>

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
                    <?=  $timeslip["slip_timer_started"]; ?>
                </td>

                <td>
                    <?=  $timeslip["slip_timer_end"]; ?>
                </td>
      
                <td>
                    <?= $timeslip["slip_description"]; ?>
                </td>

                <td>
                    <?= $timeslip["slip_hours"]; ?>
                </td>
               
                
      
            </tr>

                   
            <?php } ?>
          </tbody>
        
        </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>