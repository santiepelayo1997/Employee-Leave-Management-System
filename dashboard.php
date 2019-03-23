<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Dashboard</title>
        <link rel="icon" href="logo.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">
        <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        	
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
           <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>


       <main class="mn-inner">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Total Vacation Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['vacationleave'];
                                   $annualleave = $results['annualleave'];

                                //$empcount=$query->rowCount();
                                ?>                          
                               <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome + $annualleave.'.0');?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                       <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                            
                                <span class="card-title">Total Sick Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT sickleave from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['sickleave'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                     <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                            
                                <span class="card-title">Total Special Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['specialleave'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                         <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                            
                                <span class="card-title">Total Maternity Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['maternityleave'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                            <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                            
                                <span class="card-title">Total Paternity Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['paternityleave'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                        <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Total Leave Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['Leavedays'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                             
                            </div>
                                    <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                            <div class="col s12 m12 l3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                            
                                <span class="card-title">Total Compensitory Balance</span>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['compensitory'];

                                //$empcount=$query->rowCount();
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome);?></span></span>
                                  
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="green determinate" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                     <div class="row">
                    <div class="col s12">
                        <div class="page-title">Leave History</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Leave History</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="120">Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                             <th>Description</th>
                                             <th width="120">Posting Date</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT LeaveType,ToDate,FromDate,Description,PostingDate,AdminRemarkDate,AdminRemark,Status from tblleaves where empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->ToDate);?></td>
                                            <td><?php echo htmlentities($result->FromDate);?></td>
                                           <td><?php echo htmlentities($result->Description);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                               
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
          
        </div>

        

        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>