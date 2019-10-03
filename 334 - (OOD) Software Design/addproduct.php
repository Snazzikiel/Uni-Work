<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
		
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];
	

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cStoreStock.php");
	require_once ("classes\cStore.php");
	require_once ("classes\cModelItem.php");
	require_once ("scripts\getModelTypes.php");
	require_once ("scripts\getItemSubjectArea.php");
	require_once ("scripts\getStoreID.php");
	require_once ("scripts\getSupplierID.php");
	
	$sql = "StoreID = 1";
	$objStore = new cStore();
	$storeData = $objStore->getTableData($sql);		
	
	$objStock = new cStoreStock();

	$sql = "ItemID = 1";
	$objItem = new cModelItem();
	$itemData = $objItem->getTableData($sql);
	
	$sql = "";
	$allStore = $objStore->getTableData($sql);
	$allItems = $objItem->getTableData($sql);
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$arr;
		foreach ($_POST as $key => $value){
			$arr[$key] = $value;
			echo $key . " " . $value;
		}
		
		
		$insert1 = $objItem->insertTableData($arr);
		//echo $insert1;
		$insert = $objStock->insertTableData($arr);
		//echo $insert;
		header("Location: stock.php");
		
		
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
                        <a href="customerinfo.php">Contact Information</a>
                         
                    </li>
                    <li>
                        <a class="active-menu" href="stock.php">Stock</a>
                        
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
                        <h1 class="page-head-line">Stock Information</h1>

                    </div>
                </div>
				
<div>
     
      <div class="row pad-top-botm ">
	  						   
<div class="col-lg-6 col-md-6 col-sm-6">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id="; ?>" method="post">
		<table width="100%;">
<?php

		$newStoreID = "";
		$newStockID = "";
		$newItemID = "";
		
		$newStoreID = max(array_column($allStore, 'StoreID')) + 1;
		$newItemID = max(array_column($allItems, 'ItemID')) + 1;
		
		
		
		//Controller for Model-View-Controller design pattern
		foreach ($itemData as $row){
			foreach ($row as $field => $value){
				$tblData = "";
				$tblData = '<tr class="tableRow">';
				$tblData .= '<td width="30%" class="tableLeftCol">' . $field . '</td>';
				$tblData .=	'<td>&nbsp;</td>';
				$tblData .= '<td class="tableRightCol" >';
				if ($field == "ItemID"){
					$tblData .= $newItemID;
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="hidden" value="'.$newItemID.'">';
				} elseif ($field == "ModelType"){
					$tblData .= getModelTypes();
				} elseif ($field == "SubjectArea"){
					$tblData .= getItemSubjectArea();
				
				} elseif ($field == "SupplierID"){
					$tblData .= getSupplierID();
				
				}elseif ($field == "DateOfIntroduction"){
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="date">';
				
				} elseif ($field == "ItemAvailability"){
					$tblData .= '<select name="ItemAvailability">';
					$tblData .= '<option value="0">Not Available</option>';
					$tblData .= '<option value="1" selected>Available</option>';
					$tblData .= '</select>';
				
				} else {
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="text">';
				}
				$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
				echo $tblData;
			}
		}
		$tblData = "";
		$tblData = '<tr class="tableRow">';
		$tblData .= '<td width="30%" class="tableLeftCol">Quantity</td>';
		$tblData .=	'<td>&nbsp;</td>';
		$tblData .= '<td class="tableRightCol" >';
		$tblData .= '<input name="Quantity" size="50" width="100%" id="Quantity" type="text">';
		$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
		echo $tblData;
		$tblData = "";
		$tblData = '<tr class="tableRow">';
		$tblData .= '<td width="30%" class="tableLeftCol">StoreID</td>';
		$tblData .=	'<td>&nbsp;</td>';
		$tblData .= '<td class="tableRightCol" >';
		$tblData .= getStoreID();
		$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
		echo $tblData;


		
?>
</table>

     </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
             <hr>
                <input class="btn btn-sm btn-success" type="submit" value="Add" style="width: 82px;height: 42px;margin-left: 0px;">
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