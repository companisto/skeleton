<section class="ed-home-jumbotron jumbotron text-center">
	<div class="container">
	<h1 class="jumbotron-heading">Welcome</h1>
		<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
		<p>
			<a href="#" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">Lunch demo modal</a>
			<a href="#" class="btn btn-secondary my-2" data-toggle="modal" data-target="#exampleWizard">Lunch wizard</a>
		</p>
	</div>
</section>
<?=$this->fetch("_partial.php", $data)?>
<h2><?=$user_name?></h2>
<h2><?=$parent_function?></h2>

<?php ob_start(); ?>
	<script>
		console.log("Script from demo1.php file");
		$(".tooltip-test").tooltip();
		$(".popover-test").popover();
		$(window).on('load',function(){
			$('#exampleWizard').modal('show');
    	});
	</script>
<?php
	$js_code = ob_get_clean();
	$this->addDataCollection("script_inline", $js_code);
?>
