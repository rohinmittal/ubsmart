<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Products Bought - UBsMart</title>
</head>

<?php if (isset($query_result)) {?>
<br>
<table border="1" style="width:100%; text-align:center">
	<tr>
		<th> Order ID </th>
		<th> Order Date </th>
		<th> Product Name </th>
		<th> Category </th>
		<th> Price </th>
	</tr>
	<?php foreach ($query_result->result() as $row) { ?>
	<tr>
		<?php $productDetails = $this->membership_model->productDetailsFromProductID($row->product_id); ?>
		<td>
			<?php echo $row->order_id; ?>
		</td>
		<td>
			<?php echo $row->order_date; ?>
		</td>
		<td>
			<?php echo $productDetails->pname; ?>
		</td>
		<td>
			<?php echo $productDetails->subcategory; ?>
		</td>
		<td>
			<?php echo $productDetails->price; ?>
		</td>
	</tr>
	<?php } ?>
</table>

<?php } else { ?>
<b>No product History.</b>
<?php } ?>
