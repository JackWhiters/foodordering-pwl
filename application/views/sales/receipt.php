<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Receipt</title>
</head>
<style>
	table{
		width: 100%;
		border-collapse: collapse;
	}
	body *{
		font-size: 12px;
	}
	p{
		margin:unset; 
	}
	.text-right{
		text-align: right;
	}
	.text-left{
		text-align: left;
	}
	hr{
		border-top:unset ;
		border-width: 2px;
	    border-color: black;
	    border-bottom-style: dashed;
	}
</style>
<?php 
	$order = $this->db->query("SELECT * FROM orders where id = $id")->row();
	$sales = $this->db->query("SELECT * FROM sales where order_id = $id")->row();
	$queue = $this->db->query("SELECT * FROM queue_list where order_id = $id")->row();
?>
<body>
	<p><center><?php echo $_SESSION['system']['name'] ?></center></p>
	<p><center><?php echo $_SESSION['system']['address'] ?></center></p><br>
	<p>Reference ID: <?php echo $order->ref_id ?></p>
	<hr>
	<table>
		<thead>
			<tr>
				<th class="text-left">QTY</th>
				<th class="text-left">Order</th>
				<th class="text-right">Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$items = $this->db->query("SELECT o.*,p.name as pname FROM order_list o inner join product p on p.id = o.product_id where o.order_id = $id");
				foreach($items->result_array() as $row):
			?>
			<tr>
				<td><?php echo number_format($row['qty']) ?></td>
				<td><?php echo ($row['pname']).($row['qty'] > 1 ? " <small>@(".(number_format($row['price'])).')</small>' : '') ?></td>
				<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2" class="text-left">Total Amount</th>
				<th class="text-right"><?php echo number_format($order->total_amount,2) ?></th>
			</tr>
			<tr>
				<th colspan="2" class="text-left">Tendered Amount</th>
				<th class="text-right"><?php echo number_format($sales->amount_tendered,2) ?></th>
			</tr>
			<tr>
				<th colspan="2" class="text-left">Change</th>
				<th class="text-right"><?php echo number_format($sales->amount_tendered - $order->total_amount,2) ?></th>
			</tr>
		</tfoot>
	</table>
	<hr>
	<h4>
		<center><b>Queue No.</b></center>
	</h4>
	<h6><center><b><?php echo $queue->queue ?></b></center></h6>
	<p><center>This receipt is UNOFFICIAL.</center></p>
</body>
</html>