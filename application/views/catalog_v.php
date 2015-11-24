
<title>Welcome to UBsMart</title>

	<div id="breadcrumbs">
	The page you are looking at is the homepage for UBsMart!!!!
	</div>
	<div id="product_related" class="clearfix" style="background: blue;">		
		<div id="filter_related">
			<fieldset>
				<legend>Sort by:</legend>
				<input type="radio" name="sort" value="asc_price" onclick='alert("<?php echo anchor('catalog/execute_search/price/asc'); ?>");'>Price: Low to High<br>
				<input type="radio" name="sort" value="desc_price">Price: Low to High<br>
				<input type="radio" name="sort" value="asc_tier">Price: Low to High<br>
				<input type="radio" name="sort" value="desc_tier">Price: Low to High<br>
			</fieldset>
			<br>
			<fieldset>
				<legend>Filter by:</legend>
				<input type="checkbox" name="TierA" value="ta">Tier A<br>
				<input type="checkbox" name="TierB" value="tb">Tier B<br>
				<input type="checkbox" name="TierC" value="tc">Tier C<br>
				<input type="checkbox" name="TierD" value="td">Tier D<br>
				<input type="checkbox" name="TierE" value="te">Tier E<br>
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
				echo 'Will display featured prods here!';
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
				 	echo '<div><img class="pimg" src="'.$s.'/'.$prod->product_id.'/'.$prod->pic1.'"/>
				 	<hr noshade size="1.5" style="margin-top:-0.25%">'.'<p style="margin-top:-1.5%">'.				 	
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
	</div>		
