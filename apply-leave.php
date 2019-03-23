<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
$leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$days = (strtotime($todate) - strtotime($fromdate)) / (60 * 60 * 24);
$days++;

if ($days <= 0)
{
    $days = 1;
}


$description=$_POST['description'];  
$balance = $_POST['balance'];
$specialleave = $_POST['specialleave'];
$vacationleave = $_POST['vacationleave'];
$sickleave = $_POST['sickleave'];
$annualleave = $_POST['annualleave'];
$compensitory = $_POST['compensitory'];
$maternityleave = $_POST['maternityleave'];
$paternityleave = $_POST['paternityleave'];

$totalSL = $sickleave - $days;
if($totalSL < 0)
{
    $totalSL = 0;
}

$unpaidSL = $sickleave - $days;
if ($unpaidSL > 0)
{
    $unpaidSL = 0;
}



$totalVL = $vacationleave - $days;
if($totalVL < 0)
{
    $totalVL = 0;
}

$unpaidVL = $vacationleave - $days;
if ($unpaidVL > 0)
{
    $unpaidVL = 0;
}


$totalSP = $specialleave - $days;
if($totalSP < 0)
{
    $totalSP = 0;
}
$unpaidSP = $specialleave - $days;
if ($unpaidSP > 0)
{
    $unpaidSP = 0;
}


$totalAL = $annualleave - $days;
if($totalAL < 0)
{
    $totalAL = 0;
}
$unpaidAL = $annualleave - $days;
if ($unpaidAL > 0)
{
    $unpaidAL = 0;
}


$totalCP = $compensitory - $days;
if($totalCP < 0)
{
    $totalCP = 0;
}
$unpaidCP = $compensitory - $days;
if ($unpaidCP > 0)
{
    $unpaidCP = 0;
}


$totalML = $maternityleave - $days;
if($totalML < 0)
{
    $totalML = 0;
}
$unpaidML = $maternityleave - $days;
if ($unpaidML > 0)
{
    $unpaidML = 0;
}


$totalPL = $paternityleave - $days;
if($totalPL < 0)
{
    $totalPL = 0;
}

$unpaidPL = $paternityleave - $days;
if ($unpaidPL > 0)
{
    $unpaidPL = 0;
}

$status=0;
$isread=0;
$leaveSelected = $_POST['leavetype'];
switch($leaveSelected)
{
    case "Graduation Leave";
            $leaveSelected = "Special Leave";
    break;
     case "Sick Leave";
            $leaveSelected = "Sick Leave";
    break;
      case "Vacation Leave";
            $leaveSelected = "Vacation Leave";
    break;
      case "Annual Leave";
            $leaveSelected = "Annual Leave";
    break;
      case "Maternity Leave";
            $leaveSelected = "Maternity Leave";
    break;
      case "Paternity Leave";
            $leaveSelected = "Paternity Leave";
    break;
      case "Compensitory";
            $leaveSelected = "Compensitory";
    break;
      case "Enrollment Leave";
           $leaveSelected = "Special Leave";
    break;
        case "Funeral / Mourning Leave";
           $leaveSelected = "Special Leave";
    break;
        case "Wedding / Anniversary Leave";
           $leaveSelected = "Special Leave";
    break;
       case "Birthday Leave";
           $leaveSelected = "Special Leave";
    break;
        case "Hospitilization Leave";
           $leaveSelected = "Special Leave";
    break;
      case "Hospitilization Leave";
           $leaveSelected = "Special Leave";
    break;
      case "Accident Leave";
           $leaveSelected = "Special Leave";
    break;
      case "Government Transaction Leave";
           $leaveSelected = "Special Leave";
    break;
      case "Relocation Leave";
           $leaveSelected = "Special Leave";
    break;
       case "Calamity Leave";
           $leaveSelected = "Special Leave";
    break;
}


        if($fromdate > $todate)
           {
                $error=" ToDate should be greater than FromDate ";
           }
           else 
           {
         switch($leaveSelected)
            {

                case "Special Leave":
                if ($days > $specialleave)
                {
               $isDeducted = 1;
                }
                else
                {
                     $isDeducted = 0;
                }
                        $sql="update tblemployees set specialleave=:specialleave where id=:eid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':specialleave',$totalSP,PDO::PARAM_STR);
                        $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                        $query->execute();

                           
                            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidSP,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                        
                            break;

                break;
                 case "Vacation Leave":
                     if ($days > $vacationleave)
                    {
                       $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }
                            $sql="update tblemployees set vacationleave=:vacationleave where id=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':vacationleave',$totalVL,PDO::PARAM_STR);
                            $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                            $query->execute();

                        
                            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidVL,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                        
                            break;
                         
                break;
                   case "Annual Leave":
                     if ($days > $annualleave)
                    {
                         $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }
                            $sql="update tblemployees set annualleave=:annualleave where id=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':annualleave',$totalAL,PDO::PARAM_STR);
                            $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                            $query->execute();

                            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidAL,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }

                            break;
                         
                break;
                 case "Sick Leave":
                     if ($days > $sickleave)
                    {
                       $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }
                             $sql="update tblemployees set sickleave=:sickleave  where id=:eid";
                             $query = $dbh->prepare($sql);
                             $query->bindParam(':sickleave',$totalSL,PDO::PARAM_STR);
                             $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                             $query->execute();

                         $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidSL,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                        
                  break;
                   case "Maternity Leave":
                     if ($days > $maternityleave)
                    {
                        $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }
                             $sql="update tblemployees set maternityleave=:maternityleave  where id=:eid";
                             $query = $dbh->prepare($sql);
                             $query->bindParam(':maternityleave',$totalML,PDO::PARAM_STR);
                             $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                             $query->execute();

                      
                           
                            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidML,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                        
                  break;
                  case "Paternity Leave":
                     if ($days > $paternityleave)
                    {
                       $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }

                      $sql="update tblemployees set paternityleave=:paternityleave  where id=:eid";
                             $query = $dbh->prepare($sql);
                             $query->bindParam(':paternityleave',$totalPL,PDO::PARAM_STR);
                             $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                             $query->execute();

                              
                            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidPL,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                        
                        
                  break;
                   case "Compensitory":
                     if ($days > $compensitory)
                    {
                        $isDeducted = 1;
                    }
                    else
                    {
                         $isDeducted = 0;
                    }
                 
                             $sql="update tblemployees set compensitory=:compensitory  where id=:eid";
                             $query = $dbh->prepare($sql);
                             $query->bindParam(':compensitory',$totalCP,PDO::PARAM_STR);
                             $query->bindParam(':eid',$empid,PDO::PARAM_STR);
                             $query->execute();

                                $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Leavedays,Unpaidleave,Description,Status,IsRead,isDeducted,empid) VALUES(:leavetype,:fromdate,:todate,:days,:unpaidleave,:description,:status,:isread,:isdedcuted,:empid)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
                            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
                            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
                            $query->bindParam(':days',$days,PDO::PARAM_STR);
                            $query->bindParam(':unpaidleave',$unpaidCP,PDO::PARAM_STR);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':isdedcuted',$isDeducted,PDO::PARAM_STR);
                            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                            $msg="Leave applied successfully";
                            }
                            else 
                            {
                            $error="Something went wrong. Please try again";
                            }
                       
                            break;
            }
           
   }

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Apply Leave</title>
        <link rel="icon" href="logo.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
                                       <span class="stats-counter"><span class="counter"><?php echo htmlentities($nome + $annualleave .".0");?></span></span>
                                  
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
                                $sql = "SELECT SUM(vacationleave + sickleave  + annualleave) as total from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                foreach($results as $result)
                                {
                                ?>                          
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($result->total);?>
                                </span></span>
                             <?php }?>

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
                                if ($nome < 0)
                                {
                                    $nome = "0.0";
                                }

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
                        <div class="page-title">Apply for Leave</div>
                    </div>
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h3>Apply for Leave</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

                        <div>
                                <?php
                                $eid=$_SESSION['eid'];
                                $sql = "SELECT * from tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $specialleave = $results['specialleave'];
                                $vacationleave = $results['vacationleave'];
                                $sickleave = $results['sickleave'];
                                 $totalbalance = $results['total'];
                                 $annualleave = $results['annualleave'];
                                $maternityleave = $results['maternityleave'];
                                $paternityleave = $results['paternityleave'];
                                   $compensitory = $results['compensitory'];

                                ?>
                                   <input type="hidden" name="annualleave" value=" <?php echo htmlentities($annualleave);?>" >
                                          <input type="hidden" name="compensitory" value=" <?php echo htmlentities($compensitory);?>" >
                        <input type="hidden" name="specialleave" value=" <?php echo htmlentities($specialleave);?>" >
                        <input type="hidden" name="vacationleave" value=" <?php echo htmlentities($vacationleave);?>" >
                        <input type="hidden" name="sickleave" value=" <?php echo htmlentities($sickleave);?>" >
                           <input type="hidden" name="maternityleave" value=" <?php echo htmlentities($maternityleave);?>" >
                        <input type="hidden" name="paternityleave" value=" <?php echo htmlentities($paternityleave);?>" >
                          </div>

<br>

 <div class="input-field col  s12">
<select  name="leavetype" autocomplete="off" required>
<option value="">Select leave type...</option>
<option value="Compensitory">Compensitory</option>
<?php $sql = "SELECT  LeaveType from tblleavetype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>

<?php }} ?>
</select>
</div>


<div class="input-field col m6 s12">
<label for="fromdate">From  Date</label>
<input placeholder="" id="birthdate" name="fromdate" type="text"  class="datepicker"  data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col m6 s12">
<label for="todate">To Date</label>
<input placeholder="" id="birthdate" name="todate" type="text"  class="datepicker"  data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col m12 s12">
<label for="birthdate">Description</label>    

<textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
</div>
</div>
      <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn green m-b-xs">Apply</button>&nbsp;&nbsp;
       <a href="dashboard.php" class="waves-effect waves-light btn green m-b-xs">Back</a>                                             

                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
          <script src="assets/js/pages/form-input-mask.js"></script>
                <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
</html>
<?php } ?> 