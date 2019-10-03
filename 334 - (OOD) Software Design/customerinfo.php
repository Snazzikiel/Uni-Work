<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
		
	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cCustomer.php");
	require_once ("classes\cContact.php");

	$sql = "CustomerID = 1";
	$objCustomer = new cCustomer();
	$customerData = $objCustomer->getTableData($sql);	
	$sql = "";
	$allCustData = $objCustomer->getTableData($sql);		
	
	$objContact = new cContact();
	$sql = "ContactID = 1";
	$contactData = $objContact->getTableData($sql);
	$sql = "";
	$allContData = $objContact->getTableData($sql);
	

	

	
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim's hobby shop</title>


    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href="assets/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

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
				<label>Select from</label>
<select class="form-control" style=" width: 320px;
">
                                                <option>CustomerID</option>
                                                <option>Full name</option>
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
	<label>Add New Customer</label>
	<br>
	<a href="addcustomer.php" class="btn btn-success btn-lg">Add</a>
	<br/>
	
	<label>Add Club Member</label>
	<br>
	<a href="addClubMember.php" class="btn btn-success btn-lg">Add</a>
	<br/>
	<label>Add Interest</label>
	<br>
	<a href="addInterest.php" class="btn btn-success btn-lg">Add</a>
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
                                            <th>CustomerID</th>
                                            <th>Full name</th>
                                            <th>Address</th>
                                            <th>Telephone</th>
											<th>Email Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

	$classType = false;
	$objCustomer = new cCustomer();
	$sql = "";
	$customerData = $objCustomer->getTableData($sql);
	

	$objContact = new cContact();
	
	//$objContact = new cContact();
	require_once ("classes\cClubMember.php");
	$objCM = new cClubMember();


	
	foreach ($customerData as $row){
		$sql = "ContactID = " . $row["CustomerID"];
		$contactData = $objContact->getTableData($sql);
		
		$itemCustID = "";
		$itemFullName = "";
		$itemAddress = "";
		$itemTelephone = "";
		$itemEmail = "";
		$itemMember = "";
		if ($classType){
			$tblData = '<tr class="warning">';
			//$tblData = '<tr>';
			$classType = false;
		} else {
			$tblData = '<tr class="info">';
			$classType = true;
		}
		
		$itemCustID = $row["CustomerID"];
		$itemFullName = $contactData[0]["FirstName"] . " " . $contactData[0]["LastName"];
		$itemAddress = $contactData[0]["Address"];
		$itemTelephone = $contactData[0]["PhoneNumber"];
		$itemEmail = $contactData[0]["Email"];
		
		if ($row["ClubMemberID"] >= 1){
			$itemMember = '<i class="fa fa-address-card" title="Club Member"></i>';
		}
		
		$tblData .= '<td>' . $itemCustID . '&nbsp;&nbsp;&nbsp;&nbsp;' . $itemMember . '</td>';
		$tblData .= '<td><a href="CustomerProfile.php?id=' . $itemCustID . '">' . $itemFullName . '</a></td>';
		$tblData .= '<td>' . $itemAddress . '</td>';
		$tblData .= '<td>' . $itemTelephone . '</td>';
		$tblData .= '<td><a href="mailto:' . $itemEmail . '">' . $itemEmail . '</a></td>';
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
    




</body></html>