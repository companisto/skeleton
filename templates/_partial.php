<h3>Partial = <?=$user_name?></h3>

<?php ob_start(); ?>
	<script>
		console.log("Script from partial.php file");
	</script>
<?php
	$js_code = ob_get_clean();
	$this->addDataCollection("script_inline", $js_code);
?>