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
	
	if ($jobTitle === "Admin"){
		$readOnly = "";
		$contentEdit = 'contenteditable="true"';
	} else {
		$readOnly = "readonly";
		$contentEdit = "";
	}
	
	require_once ("classes\cStoreStock.php");
	require_once ("classes\cModelItem.php");
	require_once ("scripts\getModelTypes.php");
	require_once ("scripts\getItemSubjectArea.php");
	require_once ("scripts\getSupplierID.php");
	
	$sql = "ItemID = " . $_GET['id'];
	$objStoreStock = new cStoreStock();
	$stockData = $objStoreStock->getTableData($sql);		
	
	$objModelItem = new cModelItem();
	$itemData = $objModelItem->getTableData($sql);
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Observer Pattern
		if ($_POST["Quantity"] < 5){
			require_once ("classes\Observer\stockWatch.php");
			require_once ("classes\Observer\dbObserver.php");

			$transCompleted = new cLowStockLevel("Quantity LOW!");
			$user1 = new dbObserver($userName);
			$transCompleted->attach($user1);
			
			$msg = "";// $userName . " just processed a sale!";		
			$transCompleted->lowStock($msg);
		}
		
		$arr;
		foreach ($_POST as $key => $value){
			$arr[$key] = $value;
			//echo $key . " => " . $value . "<br />";
		}
		
		$update = $objStoreStock->updateTableData($arr);
		//print_r($update);
		$update1 = $objModelItem->updateTableData($arr);
		//print_r($update1);

		
		header("Location: stock.php");
		
		
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
         <div class="col-lg-6 col-md-6 col-sm-6 " style="width:250px;">
          <img src="<?php echo $itemData[0]["ImageLocation"]; ?>" style="padding-bottom:20px; width: 200px; height: 220px;">
         </div>
<div class="col-lg-6 col-md-6 col-sm-6">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id="; ?>" method="post">
		<table width="100%;">	
<?php 
		
//Controller for Model-View-Controller design pattern
		foreach ($itemData as $row){
			foreach ($row as $field => $value){
				$tblData = "";
				$tblData = '<tr class="tableRow">';
				$tblData .= '<td width="30%" class="tableLeftCol">' . $field . '</td>';
				$tblData .=	'<td>&nbsp;</td>';
				$tblData .= '<td class="tableRightCol" >';
				if ($field == "ItemID"){
					$tblData .= $_GET['id'];
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="hidden" value="'.$_GET['id'].'">';
				} elseif ($field == "ModelType"){
					$tblData .= getModelTypes();
				} elseif ($field == "SubjectArea"){
					$tblData .= getItemSubjectArea();
				
				} elseif ($field == "SupplierID"){
					$tblData .= getSupplierID();
				
				}elseif ($field == "DateOfIntroduction"){
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="date" value="'.$value.'">';
				
				} elseif ($field == "ItemAvailability"){
					$tblData .= '<select name="ItemAvailability">';
					$tblData .= '<option value="0">Not Available</option>';
					$tblData .= '<option value="1" selected>Available</option>';
					$tblData .= '</select>';
				
				} else {
					$tblData .= '<input name="' . $field . '" size="50" width="100%" id="' . $field . '" type="text" value="'.$value.'">';
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
		$tblData .= '<input name="Quantity" size="50" width="100%" id="Quantity" value="'.$stockData[0]["Quantity"] .'" type="text">';
		$tblData .= '</td></tr><tr><td>&nbsp;</td></tr>';
		echo $tblData;
?>

</table>
            
         </div>


      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr>
             <!--<button type="submit" class="btn btn-primary btn-lg">Delete</button>-->
             &nbsp;&nbsp;&nbsp;
              <button type="submit" class="btn btn-success btn-lg">Update</button>

             </div>
         </div>
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