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
	require_once ("classes\cModelItem.php");;
	
	$sql = "";
	$objStoreStock = new cStoreStock();
	$stockData = $objStoreStock->getTableData($sql);		
	
	$objModelItem = new cModelItem();
	$objStore = new cStore();
	
	
	
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
                        <a class="active-menu" href="stock.php">Stock</a>
                        
                    </li>
                     <li>
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
                        <h1 class="page-head-line">Stock</h1>

                    </div>
                </div>
				<label>Select From</label>
<select class="form-control" style=" width: 320px;
">
                                                <option>Model Name</option>
                                                <option>Model Type</option>
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
	<label>Add New Product</label>
	<div>
	<a href="addproduct.php" class="btn btn-success btn-lg">Add</a>
	</div>
	<br/>
	<br/>
<div class="row text-center pad-row">
<?php 
	foreach($stockData as $row){
		
		
		$sql = "StoreID = " . $row["StoreID"];
		$storeData = $objStore->getTableData($sql);

		$sql = "ItemID = " . $row["ItemID"];
		$itemData = $objModelItem->getTableData($sql);

	

?>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4><?php echo $itemData[0]["Name"] ?></h4>
                        </div>
                        <div class="panel-body">
							<div class="round-body">
                                <div>
									<button type="button" class="btn btn-sm btn-primary" style="
										width: 87px;
										margin-right: 10px;
									">Model#</button>
               <strong>  <?php echo $itemData[0]["ItemID"] ?></strong>
                                </div>
                                <div>
									<button type="button" class="btn btn-sm btn-primary" style="
										margin-right: 8px;
									">Model Type</button>
               <strong>  <?php echo $itemData[0]["ModelType"] ?></strong>
                                </div>
                                <div>
									<button type="button" class="btn btn-sm btn-primary" style="
										width: 87px;
										margin-right: 25px;
									">Stock Level</button>
               <strong>  <?php echo $row["Quantity"] ?></strong>
                                </div>
								<div>
									<button type="button" class="btn btn-sm btn-primary" style="
										width: 87px;
										margin-left: 10px;
									">Price</button>
               <strong>  <?php echo $itemData[0]["BuyPrice"] ?></strong>
                                </div>
								<br/>
                            </div>
                            <a href="stockItem.php?id=<?php echo $row["ItemID"]; ?>" class="btn btn-success btn-lg btn-block">Select</a>
                        </div>
                    </div>

                </div>
	<?php } ?>
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