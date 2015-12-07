<title>Welcome to UBsMart</title>

	<div id="breadcrumbs">
	<br>
	</div>
	<div id="product_related" class="clearfix" style="background: blue;">		
		<div id="filter_related">
			<fieldset>
				<legend>Sort by:</legend>
				<input type="radio" name="sort" value="asc_price" onclick="location.href='<?php echo base_url("catalog/execute_search/price/asc/".$filter); ?>'">Price: Low to High<br>
				<input type="radio" name="sort" value="desc_price" onclick="location.href='<?php echo base_url("catalog/execute_search/price/desc/".$filter); ?>'">Price: High to Low<br>
				<input type="radio" name="sort" value="asc_tier" onclick="location.href='<?php echo base_url("catalog/execute_search/tier/asc/".$filter); ?>'">Tier: Low to High<br>
				<input type="radio" name="sort" value="desc_tier" onclick="location.href='<?php echo base_url("catalog/execute_search/tier/desc/".$filter); ?>'">Tier: High to Low<br>
			</fieldset>
			<br>
			<fieldset>
				<legend>Filter by:</legend>
				<input type="checkbox" id="TierA" value="a" onclick="updatefilter()" <?php echo (strpos($filter, 'a') !== FALSE ? 'checked' : ''); ?>>Tier A<br>
				<input type="checkbox" id="TierB" value="b" onclick="updatefilter()" <?php echo (strpos($filter, 'b') !== FALSE ? 'checked' : ''); ?>>Tier B<br>
				<input type="checkbox" id="TierC" value="c" onclick="updatefilter()" <?php echo (strpos($filter, 'c') !== FALSE ? 'checked' : ''); ?>>Tier C<br>
				<input type="checkbox" id="TierD" value="d" onclick="updatefilter()" <?php echo (strpos($filter, 'd') !== FALSE ? 'checked' : ''); ?>>Tier D<br>
				<input type="checkbox" id="TierE" value="e" onclick="updatefilter()" <?php echo (strpos($filter, 'e') !== FALSE ? 'checked' : ''); ?>>Tier E<br>
			</fieldset>			
		</div>
		<div id="product_grid">
			<div id="search_result_numrows" style="font-size:small;">
			<?php
			if($searchval != "no_search_query")
			{
				if ($results==NULL)
				{
		         echo "Sorry, no results found for '$searchval'.";
				}
				else
				{ 
		     	 echo "Found $results_num result(s) for '$searchval'.";
				}
			}
			else {
				//Displaying latest prods
				echo "Latest products uploaded on UBsMart!";
				echo '<div class="prow clearfix" id="product_list" >';
				$lprods=$resultsForLatestProd;
				 foreach ($lprods as $lprod):
				 	$s=base_url("/p_images/");
					$s2="seee"; 
				 	echo '<div onclick="location.href=\''.base_url("catalog/product_display/".$lprod->product_id).'\'"><img class="pimg" src="'.$s.'/'.$lprod->product_id.'/'.$lprod->pic1.'"/>
				 	<hr noshade size="1.5">'.'<p style="margin-top:-1.5%">'.				 	
				 	'Name: '.$lprod->pname.'<br>'.
				 	'Price: '.$lprod->price.'<br>'.
				 	'Tier: '.$lprod->tier.'<br>'.
				 	'Avg SmartPrice: '.$lprod->smart_price.
				 	'</p>'.
				 	'</div>';
				 endforeach;	 
				 echo '</div>';				 				
			}
			?>
			</div>
			<?php
			if($searchval != "no_search_query")
			{
				if ($results!=NULL)
				{
		         echo '<div class="prow clearfix" id="product_list" >';
				 $products=$results->result();
				 foreach ($products as $prod):
				 	$s=base_url("/p_images/");
				 	echo '<div onclick="location.href=\''.base_url("catalog/product_display/".$prod->product_id).'\'"><img class="pimg" src="'.$s.'/'.$prod->product_id.'/'.$prod->pic1.'"/>
				 	<hr noshade size="1.5">'.'<p style="margin-top:-1.5%">'.				 	
				 	'Name: '.$prod->pname.'<br>'.
				 	'Price: '.$prod->price.'<br>'.
				 	'Tier: '.$prod->tier.'<br>'.
				 	'Avg SmartPrice: '.$prod->smart_price.
				 	'</p>'.
				 	'</div>';
				 endforeach;	 
				 echo '</div>';	 
				}
			}			
			
			?>
			
			<?php 
			if($searchval != "no_search_query")
			{
				if (strlen($pagination)): ?>
				<div id="pagination">
					Pages: <?php echo $pagination; ?>
				</div>
			<?php endif; 
			}
			?>
			</div>			
					
		</div>
		
