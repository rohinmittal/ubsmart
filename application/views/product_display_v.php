<title>Welcome to UBsMart</title>
	<div id="breadcrumbs">
	Product details page!
	</div>
	<div id="parentdiv" class="clearfix">
		<div id="product_details" class="clearfix">		
			<div class="gallerycontainer" style="">
				<?php
				$s=base_url("/p_images/");
				$pd=$prod_details->result();
				$add_pd=$add_details->result(); 
				echo '<div>';
				echo '<img id="largeimg" src="'.$s.'/'.$pd[0]->product_id.'/'.$pd[0]->pic1.'"/>';
				echo '</div>';							
				echo '<img class="thumbnail" id="p1" onclick="updateImage(\'p1\')" src="'.$s.'/'.$pd[0]->product_id.'/'.$pd[0]->pic1.'"/>';
				echo '<img class="thumbnail" id="p2" onclick="updateImage(\'p2\')" src="'.$s.'/'.$pd[0]->product_id.'/'.$pd[0]->pic2.'"/>';
				echo '<img class="thumbnail" id="p3" onclick="updateImage(\'p3\')" src="'.$s.'/'.$pd[0]->product_id.'/'.$pd[0]->pic3.'"/>';?>
			</div>
			<div id="product_description">
				<h1 style="margin-top: 2%"><?php echo $pd[0]->pname ?></h1>
				<?php echo '<p style="margin-left:2%;">'.				 	
				 	'Name: '.$pd[0]->pname.'<br>'.
				 	'Price: '.$pd[0]->price.'<br>'.
				 	'Tier: '.$pd[0]->tier.'<br>'.
				 	'Avg SmartPrice: '.$pd[0]->smart_price.'<br>'.
					'Min SmartPrice: '.$minSP.'<br>'.
					'Max SmartPrice: '.$maxSP;
					switch ($pd[0]->subcategory)
					{
						case "Cellphones":
							//echo '<br>'.'<br>'.'Cellphone details: '.$add_pd[0]->pid.' '.$pd[0]->product_id.'<br>';
							echo '<br>'.'<br>'.'Cellphone details: '.'<br>';
							echo 'IMEI: '.$add_pd[0]->imei.'<br>';
							echo 'Charger Included: ';
							echo ($add_pd[0]->is_charger) == 0 ? 'No' : 'Yes';
							echo '<br>';
							echo 'Headset Included: ';
							echo ($add_pd[0]->is_headset) == 0 ? 'No' : 'Yes';
							echo '<br>';
							break;
						case "Laptops":
							//echo '<br>'.'<br>'.'Laptop details: '.$add_pd[0]->pid.' '.$pd[0]->product_id.'<br>';
							echo '<br>'.'<br>'.'Laptop details: '.'<br>';
							echo 'Serial Number: '.$add_pd[0]->serial.'<br>';
							echo 'Charger Included: ';
							echo ($add_pd[0]->is_charger) == 0 ? 'No' : 'Yes';
							echo '<br>';
							break;
						case "Tables":
							//echo '<br>'.'<br>'.'Table details: '.$add_pd[0]->pid.' '.$pd[0]->product_id.'<br>';
							echo '<br>'.'<br>'.'Table details: '.'<br>';
							echo 'Material of the table: '.$add_pd[0]->material.'<br>';
							echo 'Dimensions of the table in inches (LxBxH): '.$add_pd[0]->dimensions.'<br>';
							break;
						case "Chairs":
							//echo '<br>'.'<br>'.'Chair details: '.$add_pd[0]->pid.' '.$pd[0]->product_id.'<br>';
							echo '<br>'.'<br>'.'Chair details: '.'<br>';
							echo 'Material of the chair: '.$add_pd[0]->material.'<br>';
							echo 'Dimensions of the chair in inches  (LxBxH): '.$add_pd[0]->dimensions.'<br>';
							break;
					}

					echo '<br>'.'Seller: '.$pd[0]->seller;
					$isowner=($pd[0]->is_sowner) == 1 ? '' : 'NOT';
					echo '<br>'.'Seller is '.$isowner.'the firsthand buyer of the product.';
					echo '<br>'.'Product condition: ';
					switch ($pd[0]->p_condition)
					{
						case 'f':
							if($pd[0]->category == 'Electronics')
							{
								echo 'Near flawless with minor scratches'; 	
							}
							else {
								echo 'Has only slight wear and tear';
							}
							break;
						case 'a':
							if($pd[0]->category == 'Electronics')
							{
								echo 'Good working condition, has some scratches'; 	
							}
							else {
								echo 'Has moderate wear and tear';
							}
							break;
						case 'b':
							if($pd[0]->category == 'Electronics')
							{
								echo 'Below average, has severe wear and tear'; 	
							}
							else {
								echo 'Has severe wear and tear';
							}
							break;
					}
					
					echo '<fieldset style="margin-left: 2%;
						margin-right: 2%;
						padding-top: 1.5%;
    					padding-bottom: 1.5%;
    					font-size: small;
    					padding-left: 1.5%;
    					padding-right: 1.5;">';
					echo '<legend>Product Description</legend>';
					echo $pd[0]->p_desc;
					echo '</fieldset>';			
														
					echo '</p>';
					if($vwBalance >= $pd[0]->price)
					{
					echo form_open('catalog/product_buy/'.$pd[0]->product_id.'/'.$pd[0]->price,"id='prod_buycancel'");
					echo form_submit('submit','Buy', 'id="buy"');
					?>
					<button id="not_buy" onclick="goBack()">Cancel</button>
					<?php
					echo form_close();
					}
					else {
					?>
					<div id="prod_buycancel">
					<button id="cannot_buy" onclick="no_bal()">Buy</button>
					<button id="not_buy" onclick="goBack()">Cancel</button>
					</div>
					<?php
					}
					
					
					echo '<br>'; 
				?>
													
			</div>					
		</div>
	</div>