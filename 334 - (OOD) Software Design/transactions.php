<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	
	require_once ("classes\cSale.php");
	require_once ("classes\cModelItem.php");
	
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];
	
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
                <a class="navbar-brand" href="dashboard.php">Tim's hobby shop</a>
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
                        <a class="" href="dashboard.php">Dashboard</a>
                    </li>
                    <li>
                        <a class="active-menu" href="transactions.php">Transactions</a>
                         
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
                        <h1 class="page-head-line">Transactions</h1>

                    </div>
                </div>
				<label>Select from</label>
<select class="form-control" style=" width: 320px;
">
                                                <option>Date</option>
                                                <option>CustomerID/SupplierID</option>
                                                <option>Product name</option>
                </select>
				<label>Enter Keyword</label>
<div class="input-group" style="
    width: 320px;
">
      <span class="form-group input-group-btn">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<input class="btn btn-default" type="submit" value="Search">
		</form>
      </span>
      <input type="text" class="form-control" style="
    width: 326px;
">

    </div>
	<label>Add New Transaction</label>
	<br>
	<a href="addsale.php" class="btn btn-success btn-lg">Add</a>
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
                                            <th>Date</th>
                                            <th>CustomerID/SupplierID</th>
                                            <th>Products transacted</th>
                                            <th>Discount</th>
											<th>Tx Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
	$classType = false;
	
	$sale = new cSale();
	$sql = "";
	$saleData = $sale->getTableData($sql);
	
	$itemDesc = new cModelItem();
	
	
	foreach ($saleData as $row){
		$itemDate = "";
		$itemCust = "";
		$itemID = "";
		$itemDisc = "";
		$itemVal = "";
		if ($classType){
			$tblData = '<tr class="warning">';
			$classType = false;
		} else {
			$tblData = '<tr class="info">';
			$classType = true;
		}
		
		foreach ($row as $column => $item){	
			switch($column){
				case "Date": 
					$itemDate = $item; 
					break;
				case "CustomerID": 
					$itemCust = $item; 
					break;
				case "ItemID": 
					//$itemID = $item; 
					$sql = "ItemID = " . $item;
					$itemData = $itemDesc->getTableData($sql);
					if ($row["Quantity"] > 1){
						$itemID = $itemData[0]["Name"] . " (x" . $row["Quantity"] . ")";
					} else {
						$itemID = $itemData[0]["Name"];
					}
					break;
				case "Discount": 
					$itemDisc = $item; 
					break;
				case "TotalValue": 
					$itemVal = $item; 
					break;
				default: 
					break;
			}
		}
		$tblData .= '<td>' . $itemDate . '</td>';
		$tblData .= '<td>' . $itemCust . '</td>';
		$tblData .= '<td>' . $itemID . '</td>';
		$tblData .= '<td>' . $itemDisc . '</td>';
		$tblData .= '<td>' . $itemVal . '</td>';
		$tblData .= '<td><i class="fa fa-envelope-o fa-2x" title="Email Receipt">';
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