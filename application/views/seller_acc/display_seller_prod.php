<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Products Bought - UBsMart</title>
</head>

<?php if (isset($allProducts)) {?>
<br>
<table border="1" style="width:100%; text-align:center">
	<tr>
		<th> Product ID </th>
		<th> Product Name </th>
		<th> Product Price </th>
		<th> Category </th>
		<th> Sub Category </th>
		<th> Status </th>
		<th> Order ID </th>
		<th> Buyer Name </th>
		<th> Buyer Confirmation </th>
		<th> Seller Confirmation </th>
		
	</tr>
	<?php 
	echo "there";
	echo $sure;
	echo $allProducts->num_rows();
	foreach ($allProducts->result() as $row) { ?>
	<tr>
		<td>
			<?php echo $row->product_id; ?>
		</td>
		<td>
			<?php echo $row->pname; ?>
		</td>
		<td>
			<?php echo $row->price; ?>
		</td>
		<td>
			<?php echo $row->category; ?>
		</td>
		<td>
			<?php echo $row->subcategory; ?>
		</td>
		<td>
			<?php echo $row->is_sold; ?>
		</td>
		
			<?php 
				foreach($orders->result() as $row2)
				{
					if($row2->product_id==$row->product_id)
					{
							?>
							<td>
							<?php echo $row2->order_id; ?>
							</td>	
							<td>
							<?php echo $row2->buyer_name; ?>
							</td>
							<td>
							<?php if($row2->buyer_conf == 1) {
							echo "Confirmed";
							}
							else {
							echo "Pending";
							}
							?>
							</td>
							<td>
							<?php
							if($row2->seller_conf==0)
							{
								echo form_open('seller_acc/seller_handover');
								echo form_hidden('orderID', $row2->order_id);
								echo form_submit('submit','Click to Confirm'); 
								echo form_close();
							}
							else {
							echo "Confirmed";
							}
							?>
							</td>
							<?php
					}
					
				} 
			?>
		
	</tr>
	<?php } ?>
</table>

<?php } else { ?>
<b>No product History.</b>
<?php } ?>
