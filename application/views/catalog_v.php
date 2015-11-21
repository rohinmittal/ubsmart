
<title>Welcome to UBsMart</title>

	<div id="breadcrumbs">
	The page you are looking at is the homepage for UBsMart!!!!
	</div>
	<div id="product_related" class="clearfix" style="background: blue;">		
		<div id="filter_related">
			<fieldset>
				<legend>Sort by:</legend>
				<input type="radio" name="sort" value="asc_price">Price: Low to High<br>
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
		         echo "Sorry, no results found.";
				}
				else
				{ 
		     	 echo "Found ".$results->num_rows()." result(s) for ".$searchval;
				}
			}
			?>
			</div>
			<div id="product_list">
				
			</div>			
		</div>
		
	</div>		
