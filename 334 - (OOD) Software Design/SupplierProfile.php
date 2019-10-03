<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	
	if (!isset($_GET['id'])){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cSupplier.php");
	require_once ("classes\cContact.php");
	require_once ("classes\cModelItem.php");
	require_once ("scripts\getContactID.php");
	
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];
	
	if ($jobTitle === "Admin"){
		$readOnly = "";
		$contentEdit = 'contenteditable="true"';
	} else {
		$readOnly = "readonly";
		$contentEdit = "";
	}

	$sql = "SupplierID = " . $_GET['id'];
	$objSupplier = new cSupplier();
	$supplierTable = $objSupplier->getTableData($sql);
	
	$objModelItem = new cModelItem();
	$sql = "";
	$modelItems = $objModelItem->getTableData($sql);
	
	$objContact = new cContact();
	$sql = "ContactID = " . $_GET['id'];
	$contactData = $objContact->getTableData($sql);
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$arr;
		foreach ($_POST as $key => $value){
			$arr[$key] = $value;
			echo $key . " => " . $value . "<br />";
		}
		
		$insert1 = $objSupplier->updateTableData($arr);
		
		header("Location: supplier.php");
		
		
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
                        <a href="customerinfo.php">Contact Information</a>
                         
                    </li>
                    <li>
                        <a href="stock.php">Stock</a>
                        
                    </li>
                     <li class="">
                        <a class="active-menu" href="supplier.php">Suppliers</a>
                         
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
                        <h1 class="page-head-line">Supplier Information</h1>

                    </div>
                </div>
				
<div>
     
      <div class="row pad-top-botm ">
         <div class="col-lg-6 col-md-6 col-sm-6 " style="width:250px;">
          <img src="<?php echo $contactData[0]["ImageLocation"]; ?>" style="padding-bottom:20px; width: 200px; height: 220px;">
         </div>
<div class="col-lg-6 col-md-6 col-sm-6">


	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET['id']; ?>" method="post">
		<table width="100%;">
<?php
		//Controller for Model-View-Controller design pattern
		foreach ($supplierTable as $row){
			foreach ($row as $field => $value){
				$tblData = "";
				$tblData = '<tr class="tableRow">';
				$tblData .= '<td width="30%" class="tableLeftCol">' . $field . '</td>';
				$tblData .=	'<td>&nbsp;</td>';
				$tblData .= '<td class="tableRightCol" >';
				if ($field == "SupplierID"){
					$tblData .= $_GET['id'];
					$tblData .= '<input  size="50" name="' .$field .'" id="' . $field . ' width="100%" value="' . $_GET['id'] . '" type="hidden">';
				} elseif ($field == "ContactID"){
					$tblData .= getContactIDs();
				} else {
					$tblData .= '<input  size="50" name="' .$field .'" id="' . $field . ' width="100%" type="text" value="'.$value.'">';
					
				}
				$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
				echo $tblData;
			}
		}
?>
			<tr><td>&nbsp;</td></tr>
			<tr class="tableRow">
				<td class="tableLeftCol">Product List</td>
				<td>&nbsp;</td>
				<td class="tableRightCol">
					<?php 
						$productList = "<table>";
						$productList .= "<tr>";
						$productList .= "<th>Name</th>";
						$productList .= "<th>ModelType</th>";
						$productList .= "<th>Area</th>";
						$productList .= "<th>Buy Price</th>";
						$productList .= "<th>Item Av.</th>";
						$productList .= "</tr><tr>";
						foreach($modelItems as $item){
							$productList .= "<tr>";
							$productList .= "<td>" . $item["Name"] . "</td>";
							$productList .= "<td>" . $item["ModelType"] . "</td>";
							$productList .= "<td>" . $item["SubjectArea"] . "</td>";
							$productList .= "<td>" . $item["BuyPrice"] . "</td>";
							if ($item["ItemAvailability"]){
								$productList .= "<td>Yes</td>";
							} else {
								$productList .= "<td>No</td>";
							}
							
							$productList .= "</tr>";
						}
						$productList .= "</table>";
						echo $productList;
					?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
	
		
           
         </div>
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