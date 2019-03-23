<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

// code for update the read notification status
$isread=1;
$did=intval($_GET['leaveid']);  
date_default_timezone_set('Asia/Kolkata');

$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql="update tblleaves set IsRead=:isread where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();

// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$idHidden=$_POST['idHidden'];
$description=$_POST['description'];
$status=$_POST['status']; 
$Leavedays=$_POST['Leavedays'];

date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql="update tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();


if ($_POST['status'] === '1') {
$sql1="update tblemployees set Leavedays = Leavedays - :Leavedays where EmpId=:idHidden";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':Leavedays',$Leavedays,PDO::PARAM_STR);
$query1->bindParam(':idHidden',$idHidden,PDO::PARAM_STR);
$query1->execute();
}


$msg="Leave updated Successfully";
}



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Leave Details </title>
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
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
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
                        <div class="page-title" style="font-size:24px;">Leave Details</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Leave Details</span>
<script>
    function printDiv() {
        var divToPrint = document.getElementById('example');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
   }
</script>
<style> @media only print
{
    footer, header, .sidebar{ display:none; }
    tr , td 
    {
      font-size:130px;
    }

}  </style>

                   <button type="submit" class="waves-effect waves-light btn green"  onclick="printDiv();" name="print" style="border-radius:20px;width:100px;height:35px;">PRINT</button><br><hr>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table " border="1" cellpadding="2">
                                 
                                    <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate ,tblleaves.Leavedays, tblleaves.Unpaidleave ,tblleaves.isDeducted   from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td style="font-size:16px;"> <b>Employe Name :</b></td>
                                         
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank">
                                                <?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                              <td style="font-size:16px;"><b>Emp Id :</b></td>
                                              <td><?php echo htmlentities($result->EmpId);?></td>
                                              <td style="font-size:16px;"><b>Gender :</b></td>
                                              <td><?php echo htmlentities($result->Gender);?></td>
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Emp Email id :</b></td>
                                            <td><?php echo htmlentities($result->EmailId);?></td>
                                             <td style="font-size:16px;"><b>Emp Contact No. :</b></td>
                                            <td><?php echo htmlentities($result->Phonenumber);?></td>
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>

                                           <tr>
                                             <td style="font-size:16px;"><b>Leave Type :</b></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                             <td style="font-size:16px;"><b>Leave Date . :</b></td>
                                            <td>From <?php echo htmlentities($result->FromDate);?> to <?php echo htmlentities($result->ToDate);?></td>
                                            <td style="font-size:16px;"><b>Posting Date</b></td>
                                           <td><?php echo htmlentities($result->PostingDate);?></td>
                                        </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Employe Leave Description : </b></td>
                                            <td><?php echo htmlentities($result->Description);?></td>

                                             <td style="font-size:16px;"><b>Total Leave Days :</b></td>
                                            <td><?php echo htmlentities($result->Leavedays);?></td>
                                     
                                        <td style="font-size:16px;"><b>Total Unpaid Leave Days :</b></td>
                                            <td><?php echo htmlentities(abs($result->Unpaidleave));?></td>


                                     
                                          
                                        </tr>
                                        <?php 
                                        if ($result->isDeducted == "1") 
                                          {
                                          echo "
                                        <tr>
                                             <td style=\"font-size:15px;color:red\" ><b>Note: Deducted to Salary</b></td>
                                        </tr>";

                                          } 
                                          else
                                          {

                                          }
                                          ?>

<tr>

 </tr>
<?php 
if($stats==0)
{

?>
<tr>
 <td colspan="5">
 <!-- <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take&nbsp;Action</a> -->
<form name="adminaction" method="post">
<div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
    <div class="modal-content" style="width:90%">
        <h4>Leave take action</h4>
               <input type="hidden" name="idHidden" value="<?php echo htmlentities($result->EmpId);?>">
               <input type="hidden" name="Leavedays" value="<?php echo htmlentities($result->Leavedays);?>">

                                        <select class="browser-default" name="status" required="">
                                            <option value="">Choose your option</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Not Approved</option>
                                        </select></p>
                                        <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
    </div>
    <div class="modal-footer" style="width:90%">
       <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
    </div>

</div>   

 </td>
</tr>
<?php } ?>
   </form>                                     </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>
        <div class="left-sidebar-hover"></div>
            <!-- Javascripts -->
            <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>

        
    </body>
</html>
<?php } ?>