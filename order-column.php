<?php
$q = strval($_GET['q']);
	$conn = mysqli_connect("localhost", "root", "Frostfiredragon1!!", "minersdb");

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

	$minerIpNextOrder = "asc";
	$macAddressNextOrder = "asc";
	$minerTypeNextOrder = "asc";
	$plocationNextOrder = "asc";
	$hashrateNextOrder = "asc";
	$maxTempNextOrder = "asc";
	$farmNameNextOrder = "asc";
	$numCardsNextOrder = "asc";
	$uptimeNextOrder = "asc";
	$poolUserNextOrder = "asc";
	$commentsNextOrder = "asc";

	$sql = "SELECT * from ".$q." ORDER BY " . $orderBy . " " . $order;"
	exit($sql);
	$result = mysqli_query($conn,$sql);
?>
<div id="txtHint">
<?php if(!empty($result))	 { ?>
	
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
<?php } ?>
</div>
