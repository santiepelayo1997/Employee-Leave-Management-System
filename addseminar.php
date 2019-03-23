<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
{
$empid=$_SESSION['eid'];
$title=$_POST['title'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$hours=$_POST['hours'];
$conducted=$_POST['conducted'];
$sponsored=$_POST['sponsored'];
if ($fromdate > $todate)
{
    $error="Invalid Date!";    
}
else 
{
$sql="INSERT INTO tblseminar(empid,title,fromdate,todate,hours,conducted,sponsored) VALUES(:empid,:title,:fromdate,:todate,:hours,:conducted,:sponsored)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':title',$title,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':hours',$hours,PDO::PARAM_STR);
$query->bindParam(':conducted',$conducted,PDO::PARAM_STR);
$query->bindParam(':sponsored',$sponsored,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Leave type added Successfully";
header('location:manageseminar.php');
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
                <div class="row">
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h5>Add Seminar</h5>
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

                                ?>
                        <input type="hidden" name="specialleave" value=" <?php echo htmlentities($specialleave);?>" >
                        <input type="hidden" name="vacationleave" value=" <?php echo htmlentities($vacationleave);?>" >
                        <input type="hidden" name="sickleave" value=" <?php echo htmlentities($sickleave);?>" >
                          </div>

<br>

        <div class="input-field col s12">
<input id="leavetype" type="text"  class="validate" autocomplete="off" name="title" required>
                                                <label for="leavetype">Title</label>
                                            </div>


<div class="input-field col m6 s12">
<label for="fromdate">From  Date</label>
<input placeholder="" id="birthdate" name="fromdate" type="text"  class="datepicker"  data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col m6 s12">
<label for="todate">To Date</label>
<input placeholder="" id="birthdate" name="todate" type="text"  class="datepicker"  data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col s6">
<input id="leavetype" type="text"  class="validate" autocomplete="off" name="hours" required>
 <label for="leavetype">Hours</label>
</div>
<div class="input-field col s6">
<input id="conducted" type="text"  class="validate" autocomplete="off" name="conducted" required>
 <label for="conducted">Conducted</label>
</div>
<div class="input-field col s6">
<input id="sponsored" type="text"  class="validate" autocomplete="off" name="sponsored" required>
 <label for="sponsored">Sponsored by</label>
</div>
<div class="input-field col s12">
      <button type="submit" name="add" id="add" class="waves-effect waves-light btn green m-b-xs">Add</button>&nbsp;&nbsp;
       <a href="dashboard.php" class="waves-effect waves-light btn green m-b-xs">Back</a>
       </div>                                             

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