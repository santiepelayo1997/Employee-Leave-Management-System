<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
// Code for change password 
if(isset($_POST['update']))
    {

$lid=intval($_GET['seminar_id']);

$title=$_POST['title'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$hours=$_POST['hours'];

if ($fromdate > $todate)
{
    $error="Invalid Date!";    
}
else
{
$con="update tblseminar set title=:title,fromdate=:fromdate,todate=:todate,hours=:hours where seminar_id=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':title', $title, PDO::PARAM_STR);
$chngpwd1-> bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
$chngpwd1-> bindParam(':todate', $todate, PDO::PARAM_STR);
$chngpwd1-> bindParam(':hours', $hours, PDO::PARAM_STR);
$chngpwd1-> bindParam(':username', $lid, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Seminar Information is succesfully changed";
header('location:manageseminar.php');
}

}
else {
$error="Invalid Details Please Check Carefully";    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Update Seminar</title>
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
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                                <h5>Update Seminar</h5>
                                <div class="row">
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


<?php
$lid=intval($_GET['seminar_id']);
$sql = "SELECT * from tblseminar where seminar_id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  


                                        <div class="row">
                                 <div class="input-field col s12">
<input id="leavetype" type="text"  value="<?php echo htmlentities($result->title);?>" class="validate" autocomplete="off" name="title" required>
                                                <label for="leavetype">Title</label>
                                            </div>

<div class="input-field col m6 s12">
<label for="fromdate">From  Date</label>
<input placeholder="" id="birthdate" name="fromdate" value="<?php echo htmlentities($result->fromdate);?>" type="text"  class="datepicker" value="" data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col m6 s12">
<label for="todate">To Date</label>
<input placeholder="" id="birthdate" name="todate" type="text" value="<?php echo htmlentities($result->todate);?>" class="datepicker"  data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col s6">
<input id="leavetype" type="text"  class="validate" autocomplete="off" value="<?php echo htmlentities($result->hours);?>" name="hours" required>
 <label for="leavetype">Hours</label>
</div>

<?php }} ?>

<div class="input-field col s12">
      <button type="submit" name="update" id="update" class="waves-effect waves-light btn green m-b-xs">Update</button>&nbsp;&nbsp;
       <a href="manageseminar.php" class="waves-effect waves-light btn green m-b-xs">Back</a>
       </div>    



                                        </div>
                                       
                                    </form>
                                </div>
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
        
    </body>
</html>
<?php } ?> 