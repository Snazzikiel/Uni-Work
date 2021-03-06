<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	
	if (!isset($_GET['id'])){
		header("Location: dashboard.php");
	}
	
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cEmployee.php");
	require_once ("classes\cStore.php");
	
	if ($jobTitle === "Admin"){
		$readOnly = "";
		$contentEdit = 'contenteditable="true"';
	} else {
		$readOnly = "readonly";
		$contentEdit = "";
	}

	$sql = "EmployeeID = " . $_GET['id'];
	$objEmployee = new cEmployee();
	$employeeData = $objEmployee->getTableData($sql);		
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim's hobby shop</title>


    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/basic.css" rel="stylesheet">

    <link href="assets/css/custom.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">


    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">Tims' hobby shop</a>
            </div>

            <div class="header-right">

                <a href="message-task.php" class="btn btn-info" title="New Message"><b>5</b><i class="fa fa-envelope-o fa-2x"></i></a>
                
                

            </div>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="<?php echo $profilePic ?>" class="img-thumbnail">

                            <div class="inner-text">
                                <?php echo $userName ?>
                            <br>
                                <small><?php echo $jobTitle ?></small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="">
                        <a href="transactions.php">Transactions</a>
                         
                    </li>
                     <li>
                        <a href="customerinfo.php">Contact Information</a>
                         
                    </li>
                    <li>
                        <a href="stock.php">Stock</a>
                        
                    </li>
                     <li class="">
                        <a href="supplier.php">Suppliers</a>
                         
                    </li>
					
					<li>
                        <a class="active-menu" href="admin.php">Admin</a>
                    </li>
                                
                    <li>
                        <a href="login.php">Log Out</a>
                    </li>
                </ul>

            </div>

        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Admin Information</h1>

                    </div>
                </div>
				
<div>
     
      <div class="row pad-top-botm ">


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET['id']; ?>" method="post">
		<table width="100%;">
<?php
		//Controller for Model-View-Controller design pattern
		foreach ($employeeData as $row){
			
			foreach ($row as $field => $value){
				if ($field == "EmployeeID"){
					$tblData = "";
					$tblData = '<tr class="tableRow">';
					$tblData .= '<td width="20%" class="tableLeftCol">' . $field . '</td>';
					$tblData .=	'<td>&nbsp;</td>';
					$tblData .= '<td class="tableRightCol" >';
					$tblData .= '<input  size="50" width="100%" id="' . $field . '" type="text" value="';
					$tblData .= $value . '"readonly >';
					$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
					echo $tblData;
				} else {
					$tblData = "";
					$tblData = '<tr class="tableRow">';
					$tblData .= '<td width="20%" class="tableLeftCol">' . $field . '</td>';
					$tblData .=	'<td>&nbsp;</td>';
					$tblData .= '<td class="tableRightCol">';
					$tblData .= '<input size="50" id="' . $field . '" type="text" value="';
					$tblData .= $value . '"' .  $readOnly . '>';
					$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
					echo $tblData;
				}
				
			}
			
		}

		
?>
		</table>

     </div>
      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr>
             <!--<button type="submit" class="btn btn-primary btn-lg">Delete</button>-->
             &nbsp;&nbsp;&nbsp;
              <button type="submit" class="btn btn-success btn-lg">Update</button>
</form>
             </div>
         </div>
 </div>
				

				

	<br>
	<br>
	



                
                <hr>
                
            </div>

        </div>

    </div>


    <div id="footer-sec">
        Tim's Hobby Shop <a href="dashboard.php" target="_blank"></a>
    </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
    




</h<html></body></html>