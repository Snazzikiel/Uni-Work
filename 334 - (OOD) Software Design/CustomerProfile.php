<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	error_reporting(0);
		
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cCustomer.php");
	require_once ("classes\cContact.php");
	require_once ("classes\cClubMember.php");
	require_once ("classes\cInterest.php");
	require_once ("classes\cSale.php");
	require_once ("classes\cModelItem.php");
	
	if ($jobTitle === "Admin"){
		$readOnly = "";
		$contentEdit = 'contenteditable="true"';
	} else {
		$readOnly = "readonly";
		$contentEdit = "";
	}
	

	$sql = "CustomerID = " . $_GET['id'];
	$objInterest = new cInterest();
	$interestData = $objInterest->getTableData($sql);
	$objSale = new cSale();
	$saleData = $objSale->getTableData($sql);
	
	$objItem = new cModelItem();
	
	$objCustomer = new cCustomer();
	$customerData = $objCustomer->getTableData($sql);	
	
	$objContact = new cContact();
	$sql = "ContactID = 1";
	$contactData = $objContact->getTableData($sql);

	
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$arr;
		foreach ($_POST as $key => $value){
			$arr[$key] = $value;
			echo $key . " => " . $value . "<br />";
		}
		
		/*if (isset($_POST['btnDelete'])){
			$delete = $objContact->deleteTableData($arr);
			echo $delete;
			$delete = $objCustomer->deleteTableData($arr);
			echo "<br />" . $delete;
			$delete = $objContact->deleteTableData($arr);
			echo $delete;
			
			
			
			
		} else {
		*/
			$insert1 = $objContact->updateTableData($arr);
			$insert = $objCustomer->updateTableData($arr);
		//}
		
		header("Location: customerinfo.php");
		
		
	}
	

	
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
         <div class="col-lg-6 col-md-6 col-sm-6 " style="width:250px;">
          <img src="<?php echo $contactData[0]["ImageLocation"]; ?>" style="padding-bottom:20px; width: 200px; height: 220px;">
         </div>
<div class="col-lg-6 col-md-6 col-sm-6">
            <br>

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET['id']; ?>" method="post">	  
						   
	<div class="col-lg-6 col-md-6 col-sm-6">
		<table width="100%;">
	<?php

		//Controller for Model-View-Controller design pattern
		$id = $_GET['id'];
		foreach ($customerData as $row){
			foreach ($row as $field => $value){
					$tblData = "";
					$tblData = '<tr class="tableRow">';
					$tblData .= '<td width="20%" class="tableLeftCol">' . $field . '</td>';
					$tblData .=	'<td>&nbsp;</td>';
					$tblData .= '<td class="tableRightCol">';
					if ($field == "CustomerID"){
						$tblData .= $id;
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" type="hidden" value="'. $id . '">';
					} else {
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" value="' . $value . '" type="text"'. $readOnly . '>';
					}
					$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
					echo $tblData;
			}
		}
		
		foreach ($contactData as $row){
			
			foreach ($row as $field => $value){
					$tblData = "";
					$tblData = '<tr class="tableRow">';
					$tblData .= '<td width="20%" class="tableLeftCol">' . $field . '</td>';
					$tblData .=	'<td>&nbsp;</td>';
					$tblData .= '<td class="tableRightCol">';				
					if ($field == "ContactID"){
						$tblData .= $id;
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" type="hidden" value="'. $id . '">';
					} else {
						$tblData .= '<input size="50" name="' .$field .'" id="' . $field . '" value="' . $value . '" type="text"'. $readOnly . '>';
					}
					$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
					echo $tblData;
			}
		}
		//add interests
		$tblData = "";
		$tblData = '<tr class="tableRow">';
		$tblData .= '<td width="20%" class="tableLeftCol">Interests</td>';
		$tblData .=	'<td>&nbsp;</td>';
		$tblData .= '<td class="tableRightCol">';
		//foreach ($interestData as $row){
		//	$tblData .= $row["SubjectArea"] . "<br />";
		//}
		$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
		echo $tblData;
		
		//add Transactions
		$tblData = "";
		$tblData = '<tr class="tableRow">';
		$tblData .= '<td width="20%" class="tableLeftCol">Transactions</td>';
		$tblData .=	'<td>&nbsp;</td>';
		$tblData .= '<td class="tableRightCol">';
		foreach ($saleData as $row){
			$sql = "TransactionID = " . $row["TransactionID"];
			$transData = $objSale->getTableData($sql);
			$tblData .= "<b>Date:</b> " . $row["Date"] . "<br /><b>Amount:</b> " . $row["TotalValue"];
			$tblData .= "<br /><br />";
		}
		$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
		echo $tblData;
		
		
			
	?>
			
		</table>
		
			
           
         </div>
     </div>


      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr>
             <!--<button type="submit" name="btnDelete" class="btn btn-primary btn-lg">Delete</button>-->
             &nbsp;&nbsp;&nbsp;
              <button type="submit" name="btnUpdate" class="btn btn-success btn-lg">Update</button>

             </div>
         </div>
		 </form>   
		 
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