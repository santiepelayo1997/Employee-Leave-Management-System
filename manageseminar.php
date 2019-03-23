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
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from  tblseminar  WHERE seminar_id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Seminar record deleted";

}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Manage Seminar</title>
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
        <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
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
                        <div class="page-title">Manage Seminar Info</div>
                    </div>
                
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
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

                 
                                <span class="card-title">Mange Seminar Info</span>
                                     <a href="addseminar.php" class="waves-effect waves-light btn green m-b-xs">Add Seminar</a>  <button type="submit"  class="waves-effect waves-light btn green m-b-xs" onclick="printDiv();" name="print">PRINT</button><br><hr>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title of Learning and Development Interventions</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Hours</th>
                                            <th>Conducted by</th>
                                            <th>Sponsored by</th>
                                            <th>Date Posted</th>
                                            <th>Action</th>
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
                                               <td><?php echo htmlentities($result->created_date);?></td>
                                                    <td><a href="editseminar.php?seminar_id=<?php echo htmlentities($result->seminar_id);?>"><i class="material-icons">mode_edit</i></a><a href="manageseminar.php?del=<?php echo htmlentities($result->seminar_id);?>" onclick="return confirm('Do you want to delete');"> <i class="material-icons">delete_forever</i></a></td>
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
        <div class="left-sidebar-hover"></div>
        
      
        <!-- Javascripts -->
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