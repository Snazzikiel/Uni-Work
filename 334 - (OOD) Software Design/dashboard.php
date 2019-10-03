<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	
	
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];	
	
	if (!isset($_SESSION['userName'])){
		header("Location: login.php");
	}
	
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim's hobby shop</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href="assets/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link href="assets/css/basic.css" rel="stylesheet">

    <link href="assets/css/custom.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>
<body style="">
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
				<span id="message-board" style="color: red"><?php echo $_SESSION["observerMsg"]; ?></span>
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
                        <a class="active-menu" href="dashboard.php">Dashboard</a>
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
					        <a href="dashboard.php">
                        <h1 class="page-head-line">DASHBOARD</h1>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="customerinfo.php">
                                <i class="fa fa-address-card fa-5x"></i>
                                <h5>Contact Information <h5>
                            </a>
                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="stock.php">
                                <i class="fas fa-boxes fa-5x"></i>
                                <h5>Stock</h5>
                            </a>
                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="supplier.php">
                                <i class="fas fa-truck-moving fa-5x"></i>
                                <h5>Supplier Information</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="transactions.php">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5>Transaction History</h5>
                            </a>
                        </div>
                    </div>
                        <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="transactions.php">
                                <i class="fas fa-archive fa-5x"></i>
                                <h5>Find Product</h5>
                            </a>
                        </div>
                    </div>
					<?php
						if ($jobTitle == "Admin"){
						?>
							<div class="col-md-4">
								<div class="main-box mb-red">
									<a href="admin.php">
										<i class="fas fa-user-cog fa-5x"></i>
										<h5>Admin Console</h5>
									</a>
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
    




</body></html>