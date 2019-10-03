<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	session_start();
	

	$jobTitle = $_SESSION['userData']['JobTitle'];
	$userName = $_SESSION['userName'];
	$profilePic = $_SESSION['userData']['ImageLocation'];

	if ($jobTitle != "Admin"){
		header("Location: dashboard.php");
	}
	
	require_once ("classes\cEmployee.php");
	require_once ("classes\cContact.php");
	$objEmployee = new cEmployee();
	$objContact = new cContact();
	$sql = "";
	$employeeData = $objEmployee->getTableData($sql);
	$customer = $objContact->getTableData($sql);
	$totalNews = max(array_column($customer, 'ContactID')) + 1;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
			echo '<script language="javascript">';
			echo 'alert("Newsletter has bee successfully sent  to' . $totalNews . ' email accounts.")';
			echo '</script>';
		
		
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
                        <a href="supplier.php">Suppliers</a>
                         
                    </li>
					
					<li>
                        <a class ="active-menu" href="admin.php">Admin</a>
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
                        <h1 class="page-head-line">Admin Information</h1>

                    </div>
                </div>
				<label>Select from</label>
<select class="form-control" style=" width: 320px;
">
                                                <option>AdminID</option>
                                                <option>Username</option>
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
	<label>Add New Admin</label>
		<div>
	<a href="addadmin.php" class="btn btn-success btn-lg">Add</a>
		</div>
		<br>
		<label>Newsletter Check</label>
			<div>
                <span class="btn btn-file btn-default">
                                    <span class="fileupload-new">Select file</span>
                                    <input type="file">
                                </span>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id="; ?>" method="post">				
					<input type="submit" value="Upload" class="btn btn-success btn-lg" id="upload">
				</form>
				
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
                                            <th>Employee ID</th>
                                            <th>Full Name</th>
                                            <th>Role</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 

	$classType = false;
	
	

	
	foreach ($employeeData as $row){
		$sql = "ContactID = " . $row["ContactID"];
		$contactInfo = $objContact->getTableData($sql);
		
		$employeeID = "";
		$fullName = "";
		$role = "";
		$location = "";
		$itemMember = "";
		
		if ($classType){
			$tblData = '<tr class="warning">';
			//$tblData = '<tr>';
			$classType = false;
		} else {
			$tblData = '<tr class="info">';
			$classType = true;
		}
		
		//foreach ($row as $data){
			$employeeID = $row["EmployeeID"];
			$fullName = $contactInfo[0]["FirstName"] . " " . $contactInfo[0]["LastName"];
			$role = $row["JobTitle"];
			$location = $contactInfo[0]["Address"];
			if ($row["JobTitle"] == "Admin"){
				$itemMember = '<i class="fa fa-star" aria-hidden="true" title="Admin User"></i>';
			} 
		//}
		
		$tblData .= '<td>' . $employeeID . '&nbsp;&nbsp;&nbsp;&nbsp;' . $itemMember . '</td>';
		$tblData .= '<td><a href="EmployeeProfile.php?id=' . $employeeID . '">' . $fullName . '</a></td>';
		$tblData .= '<td>' . $role . '</td>';
		$tblData .= '<td>' . $location . '</td>';
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
	
<script>
//document.getElementById("upload").addEventListener("click", function() {
//  alert("The number of newsletter subscription is: ");
//});
</script>

    




</h<html></body></html>