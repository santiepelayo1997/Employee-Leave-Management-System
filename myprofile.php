<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['emplogin'];

                                $sql = "SELECT * from tblemployees where EmailId=:eid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $nome = $results['id'];
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$Positions=$_POST['Positions']; 
$address=$_POST['address']; 
$city=$_POST['city']; 
$country=$_POST['country']; 
$mobileno=$_POST['mobileno']; 
$collegeschool=$_POST['collegeschool'];
$yeargraduate=$_POST['yeargraduate'];
$otherdegree=$_POST['otherdegree'];
$school=$_POST['school'];
$year =$_POST['year'];
$jobstatus =$_POST['jobstatus'];
$sss =$_POST['sss'];
$pagibig =$_POST['pagibig'];
$philhealth =$_POST['philhealth'];
$tin =$_POST['tin'];

$sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Positions=:Positions,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno,collegeschool=:collegeschool,yeargraduate=:yeargraduate,Other_degree=:otherdegree,school=:school,year=:year,jobstatus=:jobstatus,sss=:sss,pagibig=:pagibig,philhealth=:philhealth,tin=:tin where EmailId=:eid";
$query = $dbh->prepare($sql);

$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':Positions',$Positions,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':collegeschool',$collegeschool,PDO::PARAM_STR);
$query->bindParam(':yeargraduate',$yeargraduate,PDO::PARAM_STR);
$query->bindParam(':otherdegree',$otherdegree,PDO::PARAM_STR);
$query->bindParam(':school',$school,PDO::PARAM_STR);
$query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':jobstatus',$jobstatus,PDO::PARAM_STR);
$query->bindParam(':sss',$sss,PDO::PARAM_STR);
$query->bindParam(':pagibig',$pagibig,PDO::PARAM_STR);
$query->bindParam(':philhealth',$philhealth,PDO::PARAM_STR);
$query->bindParam(':tin',$tin,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$msg="Employee record updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | My Profile</title>
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
                    <div class="col s12">
                        <div class="page-title">My Profile </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>My Profile Info</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$eid=$_SESSION['emplogin'];
$sql = "SELECT * from  tblemployees where EmailId=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 <div class="input-field col m6 s6">
<label for="empcode">Employee Code</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" autocomplete="off" readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>

 <div class="input-field col m6 s6">
        <label for="philhealth">Job Status</label>  
<input name="jobstatus" id="jobstatus" value="<?php echo htmlentities($result->jobstatus);?>" type="text" autocomplete="off" readonly>
</div>

<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name </label>
<input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
 </div>

<div class="input-field col m6 s12">
<label for="sss">SSS</label>
<input id="sss" name="sss" type="text" autocomplete="off" value="<?php echo htmlentities($result->sss);?>" required>
</div>

<div class="input-field col m6 s12">
<label for="pagibig">Pagibig</label>
<input id="pagibig" name="pagibig" type="text" value="<?php echo htmlentities($result->pagibig);?>" autocomplete="off" required>
</div>


<div class="input-field col m6 s12">
<label for="philhealth">Philhealth</label>
<input id="philhealth" name="philhealth" type="text" value="<?php echo htmlentities($result->philhealth);?>" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="tin">TIN</label>
<input id="tin" name="tin" type="text" value="<?php echo htmlentities($result->tin);?>" autocomplete="off" required>
</div>


 <div class="input-field col m6 s6">
    <label for="philhealth">Type of Employee</label>  
<input name="jobstatus" id="jobstatus" value="<?php echo htmlentities($result->typeofemployee);?>" type="text" autocomplete="off" readonly>
</div>

</div>
</div>
                                                    
<div class="col m6">
<div class="row">

<div class="input-field col m6 s12">
<select  name="gender" >
<option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>               
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>

<div class="input-field col m6 s12">

<input id="birthdate" name="dob"  class="datepicker" value="<?php echo htmlentities($result->Dob);?>">

</div>


<div class="input-field col m6 s12">
<select  name="department" autocomplete="off">
<option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
<?php $sql = "SELECT DepartmentName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultt)
{   ?>                                            
<option value="<?php echo htmlentities($resultt->DepartmentName);?>"><?php echo htmlentities($resultt->DepartmentName);?></option>
<?php }} ?>
</select>
</div>

<div class="input-field col m6 s12">
<label for="address">Address</label>
<input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="city">City/Town</label>
<input id="city" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" autocomplete="off" required>
 </div>
   
<div class="input-field col m6 s12">
<label for="country">Country</label>
<input id="country" name="country" type="text"  value="<?php echo htmlentities($result->Country);?>" autocomplete="off" required>
</div>



<div class="input-field col m12 s12">
<label for="Positions">Position</label>
<input id="Positions" name="Positions" value="<?php echo htmlentities($result->Positions);?>"  type="text" readonly>
</div>

 <div class="input-field col m6 s6">
<label for="school">College School</label>
<input id="school" name="collegeschool" type="text" autocomplete="off" value="<?php echo htmlentities($result->collegeschool);?>" required>
 </div>

 <div class="input-field col s6">
<label for="year">Year Graduated</label>
<input id="year" name="yeargraduate" type="text" maxlength="4" autocomplete="off" value="<?php echo htmlentities($result->yeargraduate);?>" required>
 </div>    
                                                    
<div class="input-field col m6 s12">

<select  name="otherdegree" autocomplete="off">
<label>Degree</label>
<option value="<?php echo htmlentities($result->Other_degree);?>"><?php echo htmlentities($result->Other_degree);?></option>
<?php $sql = "SELECT degree from tbldegree";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultt)
{   ?>                                            
<option value="<?php echo htmlentities($resultt->degree);?>"><?php echo htmlentities($resultt->degree);?></option>
<?php }} ?>

</select>
        <label for="philhealth">Other Degree</label>  
</div>
<div class="input-field col m6 s6">
<label for="school">School</label>
<input id="school" name="school" type="text" autocomplete="off" value="<?php echo htmlentities($result->school);?>" required>
 </div>

 <div class="input-field col s6">
<label for="year">Year Graduated</label>
<input id="year" name="year" type="text" maxlength="4" autocomplete="off" value="<?php echo htmlentities($result->year);?>" required>
 </div>       


<?php }}?>
                                                        
<div class="input-field col s12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn green m-b-xs">UPDATE</button>&nbsp;&nbsp;
 <a href="dashboard.php" class="waves-effect waves-light btn green m-b-xs">Back</a>                                             

</div>




                                                        </div>
                                                    </div>
                                         <h6>Seminar Info</h6>      
                                         <hr>     
   <div class="input-field col m12 s12">
           <table id="" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title of Learning and Development Interventions</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Hours</th>
                                            <th>Conducted by</th>
                                            <th>Sponsored by</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                    <?php   
                                    
                                     $sql = "SELECT * from tblseminar where empid=:eid";
                                    $query = $dbh -> prepare($sql);
                                     $query->bindParam(':eid',$nome,PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>  
                                                                            <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->title);?></td>
                                            <td><?php echo htmlentities($result->fromdate);?></td>
                                            <td><?php echo htmlentities($result->todate);?></td>
                                             <td><?php echo htmlentities($result->hours);?></td>
                                                 <td><?php echo htmlentities($result->conducted);?></td>
                                                     <td><?php echo htmlentities($result->sponsored);?></td>
                                                
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        
    </body>
</html>
<?php } ?> 