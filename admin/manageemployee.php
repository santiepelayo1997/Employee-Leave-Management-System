<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
// code for Inactive  employee    
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update tblemployees set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:manageemployee.php');
}



//code for active employee
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update tblemployees set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:manageemployee.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Manage Employees</title>
        <link rel="icon" href="../logo.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      
        <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Manage Employes</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Employees Info</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <div class="table-responsive">
                               <table id="" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sr no</th>
                                            <th>Emp Id</th>
                                            <th>Type of Employee</th>
                                            <th>Full Name</th>
                                            <th>Date of Birth</th>
                                            <th>Bachelor School</th>
                                            <th>Year Graduated</th>
                                            <th>Other Degree</th>
                                            <th>School</th>
                                            <th>Year Graduated</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Salary</th>
                                            <th>Address</th>
                                            <th>Marital Status</th>
                                            <th>Status</th>
                                            <th>Job Status</th>
                                            <th>Status of Leave</th>
                                            <th>Date of Appointment</th>
                                            <th>Total Years in Service</th>
                                            <th>SSS</th>
                                            <th>Pagibig</th>
                                            <th>Philhealth</th>
                                            <th>Tin No</th>
                                             <th>Sick Leave Balance</th>
                                            <th>Vacation Leave Balance</th>
                                            <th>Special Leave Balance</th>
                                                <th>Maternity Leave Balance</th>
                                            <th>Paternity Leave Balance</th>
                                             <th>Annual Leave Balance</th>
                                            <th>Compensitory</th>
                                            <th>Total Leave Balance No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT * from  tblemployees";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);



$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               


    ?>      
                         <input type="hidden" name="date" value="<?php echo date("d-m-Y", strtotime($result->RegDate));?>">
                         <?php
                                            
                            ?>
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->EmpId);?></td>
                                             <td><?php echo htmlentities($result->typeofemployee);?></td>
                                            <td><?php echo htmlentities($result->FirstName);?>&nbsp;<?php echo htmlentities($result->LastName);?></td>
                                                <td><?php echo htmlentities($result->Dob);?></td>
                                                  <td><?php echo htmlentities($result->collegeschool);?></td>
                                                <td><?php echo htmlentities($result->yeargraduate);?></td>
                                                <td><?php echo htmlentities($result->Other_degree);?></td>
                                                <td><?php echo htmlentities($result->school);?></td>
                                                <td><?php echo htmlentities($result->year);?></td>
                                                <td><?php echo htmlentities($result->Department);?></td>
                                                <td><?php echo htmlentities($result->Positions);?></td>
                                                <td><?php echo htmlentities("₱".$result->salary);?></td>
                                                <td><?php echo htmlentities($result->Address);?></td>
                                                 <td><?php echo htmlentities($result->maritalstatus);?></td>
                                                <td><?php $stats=$result->Status;
                                            if($stats){
                                             ?>
                                                 <a class="waves-effect waves-green btn-flat m-b-xs">Active</a>
                                                 <?php } else { ?>
                                                 <a class="waves-effect waves-red btn-flat m-b-xs">Inactive</a>
                                                 <?php } ?> 
                                             </td>
                                        
                                            <td><?php echo htmlentities($result->jobstatus);?></td>
                                             <td><?php echo htmlentities($result->leavestatus);?></td>
                                            <td><?php echo date("d-m-Y", strtotime($result->RegDate));?></td>
                                            <td>
                                               <?php
                                                $date11 = $result->RegDate;
                                                    $date1 = date("d-m-Y", strtotime($result->RegDate));
                                                    $date2= date("d-m-Y");
                                                    $diff =  abs(strtotime($date2) - strtotime($date11)); 
                                                    echo floor($diff / (365.25*60*60*24));
                                               ?>
                                            </td>
                                            <td><?php echo htmlentities($result->sss);?></td>
                                            <td><?php echo htmlentities($result->pagibig);?></td>
                                            <td><?php echo htmlentities($result->philhealth);?></td>
                                            <td><?php echo htmlentities($result->tin);?></td>
                                            <td><?php echo htmlentities($result->sickleave);?></td>
                                            <td><?php echo htmlentities($result->vacationleave);?></td>
                                            <td><?php echo htmlentities($result->specialleave);?></td>
                                               <td><?php echo htmlentities($result->maternityleave);?></td>
                                            <td><?php echo htmlentities($result->paternityleave);?></td>
                                               <td><?php echo htmlentities($result->annualleave);?></td>
                                                  <td><?php echo htmlentities($result->compensitory);?></td>
                                            <td><?php echo htmlentities($result->Leavedays);?></td>
                                            <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>"><i class="material-icons">mode_edit</i></a>
                                        <?php if($result->Status==1)
 {?>
<a href="manageemployee.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to inactive this Employe?');"" > <i class="material-icons" title="Inactive">clear</i>
<?php } else {?>
                                            <a href="manageemployee.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to active this employee?');""><i class="material-icons" title="Active">done</i>
                                            <?php } ?> </td>
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>
        <div class="left-sidebar-hover"></div>


        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
   
        <script src="../assets/js/pages/jquery-datatable.js"></script>
             <!-- Jquery DataTable Plugin Js -->
        <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>


        
    </body>
</html>
<?php } ?>