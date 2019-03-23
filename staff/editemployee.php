<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['stafflogin'])==0)
    {   
header('location:dashboard.php');
}
else{
$eid=intval($_GET['empid']);
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$otherdegree=$_POST['otherdegree']; 
$address=$_POST['address']; 
$city=$_POST['city']; 
$country=$_POST['country']; 
$mobileno=$_POST['mobileno']; 
$positions=$_POST['positions']; 
$Leavedays=$_POST['leavedays']; 
$jobstatus=$_POST['jobstatus']; 
$RegDate=$_POST['RegDate'];
$finaldob1 = explode(",",$RegDate);
$implode1 = implode(" ",$finaldob1);
$wew2 = date("d-m-Y", strtotime($implode1));
$sss=$_POST['sss'];
$pagibig=$_POST['pagibig'];
$philhealth=$_POST['philhealth'];
$tin=$_POST['tin'];
$specialleave = $_POST['specialleave'];
$vacationleave = $_POST['vacationleave'];
$sickleave = $_POST['sickleave'];
$typeofemployee = $_POST['typeofemployee'];
$annualleave = $_POST['annualleave'];
$compensitory = $_POST['compensitory'];
$maternityleave = $_POST['maternityleave'];
$paternityleave = $_POST['paternityleave'];

$sql1="INSERT INTO tblleavelogs(empid,firstname,lastname,sickleave,vacationleave,annualleave,specialleave,compensitory) VALUES(:empid,:fname,:lname,:sickleave,:vacationleave,:annualleave,:specialleave,:compensitory)";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':empid',$eid,PDO::PARAM_STR);
$query1->bindParam(':fname',$fname,PDO::PARAM_STR);
$query1->bindParam(':lname',$lname,PDO::PARAM_STR);
$query1->bindParam(':sickleave',$sickleave,PDO::PARAM_STR);  
$query1->bindParam(':vacationleave',$vacationleave,PDO::PARAM_STR);
$query1->bindParam(':annualleave',$annualleave,PDO::PARAM_STR);
$query1->bindParam(':specialleave',$specialleave,PDO::PARAM_STR);
$query1->bindParam(':compensitory',$compensitory,PDO::PARAM_STR);
$query1->execute();

$sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Other_degree=:otherdegree,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno,Positions=:positions,Leavedays=:leavedays,vacationleave=:vacationleave,annualleave=:annualleave,sickleave=:sickleave,specialleave=:specialleave,maternityleave=:maternityleave,paternityleave=:paternityleave,compensitory=:compensitory,jobstatus=:jobstatus,RegDate=:RegDate,sss=:sss,pagibig=:pagibig,philhealth=:philhealth,tin=:tin,typeofemployee=:typeofemployee where id=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':otherdegree',$otherdegree,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':positions',$positions,PDO::PARAM_STR);
$query->bindParam(':leavedays',$Leavedays,PDO::PARAM_STR);
$query->bindParam(':vacationleave',$vacationleave,PDO::PARAM_STR);
$query->bindParam(':annualleave',$annualleave,PDO::PARAM_STR);
$query->bindParam(':sickleave',$sickleave,PDO::PARAM_STR);
$query->bindParam(':specialleave',$specialleave,PDO::PARAM_STR);
$query->bindParam(':maternityleave',$maternityleave,PDO::PARAM_STR);
$query->bindParam(':paternityleave',$paternityleave,PDO::PARAM_STR);
$query->bindParam(':compensitory',$compensitory,PDO::PARAM_STR);
$query->bindParam(':jobstatus',$jobstatus,PDO::PARAM_STR);
$query->bindParam(':RegDate',$wew2,PDO::PARAM_STR);
$query->bindParam(':sss',$sss,PDO::PARAM_STR);
$query->bindParam(':pagibig',$pagibig,PDO::PARAM_STR);
$query->bindParam(':philhealth',$philhealth,PDO::PARAM_STR);
$query->bindParam(':tin',$tin,PDO::PARAM_STR);
$query->bindParam(':typeofemployee',$typeofemployee,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();



$msg="Employee record updated Successfully";

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Staff | Update Employee</title>
        <link rel="icon" href="../logo.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
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
                        <div class="page-title">Update employee</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>Update Employee Info</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$eid=intval($_GET['empid']);
$sql = "SELECT *,(sickleave + vacationleave + annualleave ) AS total from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 <div class="input-field col m6  s6">
<label for="empcode">Employee Code(Must be unique)</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" autocomplete="off" readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>

 <div class="input-field col m6  s6">
<select  name="jobstatus" autocomplete="off">
<option value="<?php echo htmlentities($result->jobstatus);?>"><?php echo htmlentities($result->jobstatus);?></option> 
<option value="Provisional">Provisional</option>          
<option value="Regular Employee">Regular Employee</option>
</select>
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
<input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" >
 </div>

 <div class="input-field col m6 s12">
<label for="sss">SSS</label>
<input id="sss" name="sss" type="text" autocomplete="off" value="<?php echo htmlentities($result->sss);?>" >
</div>

<div class="input-field col m6 s12">
<label for="pagibig">Pagibig</label>
<input id="pagibig" name="pagibig" type="text" autocomplete="off" value="<?php echo htmlentities($result->pagibig);?>" >
</div>


<div class="input-field col m6 s12">
<label for="philhealth">Philhealth</label>
<input id="philhealth" name="philhealth" type="text" autocomplete="off" value="<?php echo htmlentities($result->philhealth);?>" >
</div>

<div class="input-field col m6 s12">
<label for="tin">TIN</label>
<input id="tin" name="tin" type="text" autocomplete="off" value="<?php echo htmlentities($result->tin);?>" >
</div>

<div class="input-field col m6 s12">
<select  name="typeofemployee" autocomplete="off">
<option value="<?php echo htmlentities($result->typeofemployee);?>"><?php echo htmlentities($result->typeofemployee);?></option>                                  
<option value="Faculty">Faculty </option>
<option value="Non-teaching">Non-teaching</option>
</select>
</div>      

</div>
</div>
                                                    
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<select  name="gender" autocomplete="off">
<option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>

<div class="input-field col m6 s12">
<input id="birthdate" name="dob" class="datepicker" value="<?php echo htmlentities($result->Dob);?>" >
</div>


                                                    

<div class="input-field col m6 s12">
<select  name="department" autocomplete="off" >
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
<input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off"  >
</div>

<div class="input-field col m6 s12">
<label for="city">City/Town</label>
<input id="city" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" autocomplete="off" >
 </div>
   
<div class="input-field col m6 s12">
<label for="country">Country</label>
<input id="country" name="country" type="text"  value="<?php echo htmlentities($result->Country);?>" autocomplete="off" >
</div>

<div class="input-field col s12">
<select  name="positions" autocomplete="off" readonly >
<option value="<?php echo htmlentities($result->Positions);?>"><?php echo htmlentities($result->Positions." - "."₱".$result->salary);?></option>
<?php $sql = "SELECT pos_name from tblposition";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultt)
{   ?>                                            
<option value="<?php echo htmlentities($resultt->pos_name);?>"><?php echo htmlentities($resultt->pos_name." - "."₱".$result->salary);?></option>
<?php }} ?>
</select>
 </div>
  
 <div class="input-field col m6 s6">
<label for="school">College School</label>
<input id="school" name="collegeschool" type="text" autocomplete="off" value="<?php echo htmlentities($result->collegeschool);?>" readonly>
 </div>

 <div class="input-field col s6">
<label for="year">Year Graduated</label>
<input id="year" name="yeargraduate" type="text" maxlength="4" autocomplete="off" value="<?php echo htmlentities($result->yeargraduate);?>" readonly>
 </div>    



<div class="input-field col m6 s12">
<select  name="otherdegree" autocomplete="off" readonly>
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
<label for="year">Other Degree</label>
</div>


 <div class="input-field col s6">
<label for="year">Degree Year</label>
<input id="year" name="year" type="text" maxlength="4" autocomplete="off" value="<?php echo htmlentities($result->year);?>" required>
 </div>    

<div class="input-field col m6 s6">
<label for="RegDate">Date of Appointment</label>
<input id="RegDate" name="RegDate" type="text" class="datepicker" value="<?php echo htmlentities($result->RegDate);?>"  autocomplete="off" >
</div>
   
<div class="input-field col m6 s12">
<label for="leavedays">Sick Leave</label>
<input id="leavedays" name="sickleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->sickleave);?>" autocomplete="off" >
</div>

   
<div class="input-field col m6 s12">
<label for="leavedays">Vacation Leave</label>
<input id="leavedays" name="vacationleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->vacationleave);?>" autocomplete="off" >
</div>

<div class="input-field col m6 s12">
<label for="leavedays">Special Leave</label>
<input id="leavedays" name="specialleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->specialleave);?>" autocomplete="off" >
</div>

<div class="input-field col m6 s12">
<label for="annualleave">Annual Leave</label>
<input id="annualleave" name="annualleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->annualleave);?>" autocomplete="off" >
</div>
   
   <div class="input-field col m6 s12">
<label for="maternityleave">Maternity Leave</label>
<input id="maternityleave" name="maternityleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->maternityleave);?>" autocomplete="off" >
</div>

<div class="input-field col m6 s12">
<label for="paternityleave">Paternity Leave</label>
<input id="paternityleave" name="paternityleave" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->paternityleave);?>" autocomplete="off" >
</div>

<div class="input-field col m6 s12">
<label for="compensitory">Compensitory</label>
<input id="compensitory" name="compensitory" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->compensitory);?>" autocomplete="off" >
</div>

<div class="input-field col m6 s12">
<label for="leavedays">Total Leave</label>
<input id="leavedays" name="leavedays" type="text"  maxlength="4" min="0"  value="<?php echo htmlentities($result->total);?>" autocomplete="off" readonly>
</div>

<?php }}?>
                                                        
<div class="input-field col s12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn green m-b-xs">UPDATE</button>&nbsp;&nbsp;
 <a href="dashboard.php" class="waves-effect waves-light btn green m-b-xs">Back</a>  


</div>

                                                        </div>
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
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 