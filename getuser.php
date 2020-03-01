<!DOCTYPE html>
<html>
<head>

<form>
<select name="users" onchange="showUser(this.value)">
  <option value="">Select A Site:</option>
  <option value="airportMiners">Airport</option>
  <option value="entiatMiners">Entiat</option>
  <option value="divisionMiners">Division</option>
  <option value="columbiaMiners">Columbia</option>
  </select>
</form>
<br>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
$q = strval($_GET['q']);
if(!isset($_GET['q'])){
  $q = "airportMiners";
}
$con = mysqli_connect('localhost','root','poopoo11','minersdb');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"minersdb");
$sql="SELECT * FROM ".$q.";";
//exit( $sql );
$result = mysqli_query($con,$sql);

$orderBy = "plocation";

if(!empty($_POST["orderby"])) {
	$orderBy = $_POST["orderby"];
}
if(!empty($_POST["order"])) {
	$order = $_POST["order"];
}
 if($order == 'desc')
 {
      $order = 'asc';
 }
 else
 {
      $order = 'desc';
 }

?>

<div id="demo-order-list">
<div id="txtHint">

<table class="table-content">
	<thead>
		<tr>
		  <th onClick="orderColumn('minerIp','<?php echo $order; ?>')"><span>Miner Ip</span></th>
		  <th onClick="orderColumn('macAddress','<?php echo $order; ?>')"><span>Mac</span></th>          
		  <th onClick="orderColumn('minerType','<?php echo $order; ?>')"><span>Type</span></th>	  
		  <th onClick="orderColumn('plocation','<?php echo $order; ?>')"><span>Location</span></th>
		  <th onClick="orderColumn('hashrate','<?php echo $order; ?>')"><span>Hashrate</span></th>          
		  <th onClick="orderColumn('maxTemp','<?php echo $order; ?>')"><span>Temp</span></th>	
		  <th onClick="orderColumn('farmName','<?php echo $order; ?>')"><span>Farm</span></th>
		  <th onClick="orderColumn('numCards','<?php echo $order; ?>')"><span>Cards</span></th>          
		  <th onClick="orderColumn('uptime','<?php echo $order; ?>')"><span>Uptime</span></th>	
		  <th onClick="orderColumn('poolUser','<?php echo $order; ?>')"><span>Worker</span></th>          
		  <th onClick="orderColumn('comments','<?php echo $order; ?>')"><span>Comments</span></th>	
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
		    <td><a href="edit.php?id=$row['id']">Edit</a> | <a href="delete.php?id=$row['id']">Delete</a></td>
		</tr>
	<?php
		}
	?>
	<tbody>
</table>
</div>
<!--mysqli_close($con);-->

<script>
function orderColumn(column_name,column_order) {
	$.ajax({
		url: "getuser.php",
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
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>  
</body>
</html>
