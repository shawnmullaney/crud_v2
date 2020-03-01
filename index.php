<?php
$q = strval($_GET['q']);
if(!isset($_GET['q'])){
  $q = "airportMiners";
}

// Initialize the session 
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
	
$orderBy = "plocation";
$order = "asc";
// Create database connection using config file
include_once("config.php");
// Fetch all data from database 
$result = mysqli_query($mysqli, "SELECT * FROM ".$q.";");
?>

<html>
	<head>

    <title>Monitoring</title>		
<!--	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
-->
	<style>
	.table-content{border-top:#CCCCCC 4px solid; width:50%;}
	.table-content th {padding:5px 20px; background: #F0F0F0;vertical-align:top;cursor:pointer;} 
	.table-content td {padding:5px 20px; border-bottom: #F0F0F0 1px solid;vertical-align:top;} 
	.column-title {text-decoration:none; color:#09f;}
	</style>
	</head>
	
<body>
<form>
<select name="users" onchange="showUser(this.value)">
  <option value="">Select Location:</option>
  <option value="airportMiners">Airport</option>
  <option value="entiatMiners">Entiat</option>
  <option value="divisionMiners">Division</option>
  <option value="columbiaMiners">Columbia</option>
  </select>
</form>
<br>
<a href="add.php">Add New Miner</a><br/><br/>
<p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
<div id="txtHint">
<?php if(!empty($result))	 { ?>
<table class="table-content">
          <thead>
        <tr>
	      <th onClick="orderColumn('minerIp','asc')"><span>Miner Ip</span></th>
		  <th onClick="orderColumn('macAddress','asc')"><span>Mac</span></th>          
		  <th onClick="orderColumn('minerType','asc')"><span>Type</span></th>	  	  
	      <th onClick="orderColumn('plocation','asc')"><span>Location</span></th>
		  <th onClick="orderColumn('hashrate','asc')"><span>Hashrate</span></th>          
		  <th onClick="orderColumn('maxTemp','asc')"><span>Temp</span></th>	
	      <th onClick="orderColumn('farmName','asc')"><span>Farm</span></th>
		  <th onClick="orderColumn('numCards','asc')"><span>Cards</span></th>          
		  <th onClick="orderColumn('uptime','asc')"><span>Uptime</span></th>	
		  <th onClick="orderColumn('poolUser','asc')"><span>Worker</span></th>          
		  <th onClick="orderColumn('comments','asc')"><span>Comments</span></th>	
        </tr>
      </thead>
    <tbody>
	<?php
		while($row = mysqli_fetch_array($result)) {
	?>
        <tr>
			<td><?php echo $row["minerIp"]; ?></td>
			<td><?php echo $row["macAddress"]; ?></td>
			<td><?php echo $row["minerType"]; ?></td>
			<td><?php echo $row["plocation"]; ?></td>
			<td><?php echo $row["hashrate"]; ?></td>
			<td><?php echo $row["maxTemp"]; ?></td>
			<td><?php echo $row["farmName"]; ?></td>
			<td><?php echo $row["numCards"]; ?></td>
			<td><?php echo $row["uptime"]; ?></td>
			<td><?php echo $row["poolUser"]; ?></td>
			<td><?php echo $row["comments"]; ?></td>
			<td><a href="edit.php?id=<?php echo $row[id]?>">Edit</a> | <a href="delete.php?id=<?php echo $row[id]?>">Delete</a></td>
	</tr>
   <?php
		}
   ?>
   <tbody>
  </table>
<?php } ?>
  </div>
  </div>
  </div>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
	function showUser(str) {
	    if (str == "") {
	        document.getElementById("txtHint").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","index.php?q="+str,true);
	        xmlhttp.send();
	    }
	}
	function orderColumn(column_name,column_order) {
	$.ajax({
		url: "index.php",
		data:'orderby='+column_name+'&order='+column_order,
		type: "POST",
		/*beforeSend: function(){
			$('#links-'+id+' .btn-votes').html("<img src='LoaderIcon.gif' />");
		},*/
		success: function(data){	
			$('#demo-order-list').html(data);
		}
	});
}
</script>
</body></html>
