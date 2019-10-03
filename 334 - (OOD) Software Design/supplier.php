<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	
	require_once ("classes\cSupplier.php");
	require_once ("classes\cContact.php");
	
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];
	if (!isset($_SESSION['userName'])){
		header("Location: login.php");
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

                <?php echo $_SESSION["observerMsg"]; ?>
                
                

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
                     <li>
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
				<label>Select from</label>
<select class="form-control" style=" width: 320px;
">
                                                <option>SupplierID</option>
                                                <option>Name</option>
                                                <option>Telephone</option>
                </select>
				<label>Enter Keyword</label>
<div class="input-group" style="
    width: 320px;
">
      <span class="form-group input-group-btn">
        <button class="btn btn-default" type="button">Search</button>
      </span>
      <input type="text" class="form-control" style="
    width: 326px;
">

    </div>
	<label>Add New Supplier</label>
		<div>
	<a href="addsupplier.php" class="btn btn-success btn-lg">Add</a>
		</div>
		<label>Add New Delivery</label>
		<div>
	<a href="addDelivery.php" class="btn btn-success btn-lg">Add</a>
		</div>
	<br/>
	<br/>
	<div class="panel panel-default">
                       
                        <div class="panel-heading">
                            Results
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SupplierID</th>
                                            <th>Name</th>
                                            <th>Address</th>
											<th>Contact</th>
                                            <th>Telephone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 

		$sql = "";
	
	
	
	$classType = false;
	$sql = "";
	$objSupplier = new cSupplier();
	$supplierTable = $objSupplier->getTableData($sql);
	
	$objContact = new cContact();
	
	
	foreach ($supplierTable as $row){
		$itemSupID = "";
		$itemName = "";
		$itemAddress = "";
		$itemTelephone = "";
		$itemContact = "";
		if ($classType){
			$tblData = '<tr class="warning">';
			//$tblData = '<tr>';
			$classType = false;
		} else {
			$tblData = '<tr class="info">';
			$classType = true;
		}
		
		foreach ($row as $data){
			$itemSupID = $row["SupplierID"];
			$itemName = $row["Name"];
			$sql = "ContactID = " . $row["ContactID"];
			$contactData = $objContact->getTableData($sql);
			$itemAddress = $contactData[0]["Address"];
			$itemTelephone = $contactData[0]["PhoneNumber"];
			$itemContact = $contactData[0]["FirstName"] . " " . $contactData[0]["LastName"];
		}
		
		$tblData .= '<td>' . $itemSupID . '</td>';
		$tblData .= '<td><a href="SupplierProfile.php?id=' . $itemSupID . '">' . $itemName . '</a></td>';
		$tblData .= '<td>' . $itemAddress . '</td>';
		$tblData .= '<td>' . $itemContact . '</td>';
		$tblData .= '<td>' . $itemTelephone . '</td>';
		$tblData .= '</tr>';
		echo $tblData;
	}
	
	

?>										

                                       		
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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