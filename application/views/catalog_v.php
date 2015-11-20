<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Welcome to UBsMart</title>
</head>

<div id="container">

	<div id="body">
	The page you are looking at is the homepage for UBsMart!!!!<?php 
	if($searchval != "no_search_query"){echo nl2br("\nSearch results for: ".$searchval);} ?>
	</div>
	<div id="product_related">
		<div id="filter_related">
			<fieldset>
				<legend>Sort by:</legend>
				<input type="radio" name="sort" value="asc_price">Price: Low to High<br>
				<input type="radio" name="sort" value="desc_price">Price: Low to High<br>
				<input type="radio" name="sort" value="asc_tier">Price: Low to High<br>
				<input type="radio" name="sort" value="desc_tier">Price: Low to High<br>
			</fieldset>
		</div>
		<div id="product_grid">			
		</div>
	</div>		
</div>
