<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
		
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cClubMember.php");
	require_once ("classes\cCustomer.php");
	require_once ("scripts\getCustomerIDs.php");
	require_once ("scripts\getMemberTypes.php");


	$sql = "ClubMemberID = 1";
	$objCM = new cClubMember();
	$objCust = new cCustomer();
	$memberData = $objCM->getTableData($sql);
	$sql = "";
	$allData = $objCM->getTableData($sql);
	
		

	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$arr;
		foreach ($_POST as $key => $value){
			$arr[$key] = $value;
			//echo $key . " " . $value;
		}
		
		$insert1 = $objCM->insertTableData($arr);
		//$insert2 = $objCust->updateTableData($arr);
		//echo $insert2;
		header("Location: customerinfo.php");
		
		
	}
	

	
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim's hobby shop</title>


    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/basic.css" rel="stylesheet">
	
	<link href="assets/css/bootstrap-fileupload.min.css" rel="stylesheet">

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
                        <a class="active-menu" href="customerinfo.php">Contact Information</a>
                         
                    </li>
                    <li>
                        <a href="stock.php">Stock</a>
                        
                    </li>
                     <li class="">
                        <a href="supplier.php">Suppliers</a>
                         
                    </li>
					
					<li>
                        <?php if ($jobTitle == "Admin"){ ?><a href="admin.php">Admin</a><?php } ?>
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
                        <h1 class="page-head-line">Contact Information</h1>

                    </div>
                </div>
				
<div>
     
      <div class="row pad-top-botm ">


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">	  
						   
	<div class="col-lg-6 col-md-6 col-sm-6">
		<table width="100%;">
	<?php
	
		//get new CustomerID
		$newCustID = "";
		$newCustID = max(array_column($allData, 'ClubMemberID')) + 1;
	
		//Controller for Model-View-Controller design pattern
		foreach ($memberData as $row){
			foreach ($row as $field => $value){
					$tblData = "";
					$tblData = '<tr class="tableRow">';
					$tblData .= '<td width="20%" class="tableLeftCol">' . $field . '</td>';
					$tblData .=	'<td>&nbsp;</td>';
					$tblData .= '<td class="tableRightCol">';				
					if ($field == "ClubMemberID"){
						$tblData .= $newCustID;
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" type="hidden" value="'. $newCustID . '">';
					} elseif ($field == "CustomerID"){
						$tblData .= getCustomerIDs();
					} elseif ($field == "DateOfJoining"){
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" type="date">';
					} elseif ($field == "MemberStatus"){
						$tblData .= getMemberTypes();
					} else {
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" type="text">';
					}
					$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
					echo $tblData;
			}
		}
		

	?>
			<tr>
				<td><input class="btn btn-sm btn-success" type="submit" value="Add" style="width: 82px;height: 42px;margin-left: 0px;"></td>
			</tr>
		</table>
	 </div>
 </form>
				

				

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