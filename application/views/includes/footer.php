<div id="footer"style="background: #AAC4C5; text-align: center">	
<br>About UBsMart<br>
About SmartPrice<br>
Our Promise<br>
Contact Us <br><br>
</div>	
<br>
<script type="text/javascript">
	<?php if (isset($searchval)){ ?>
	var searchval = '<?php echo $searchval; ?>';
	<?php } ?>
	<?php if (isset($sort_by)){ ?>
	var sort_by = '<?php echo $sort_by; ?>';
    var sort_order = '<?php echo $sort_order; ?>';
    var filter = '<?php echo $filter; ?>';
    var baseurl= '<?php echo base_url(); ?>';
	<?php } ?>		
</script>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
	<script src="<?php echo base_url();?>js/home.js" type='text/javascript'></script>
	<!--<?php echo "<script type='text/javascript'>alert('$searchval')</script>"; ?>-->
</body>
</html>