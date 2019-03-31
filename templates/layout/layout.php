<?php
	$manifest = $this->getData('manifest');

	$stylesheet_path = "dist/css/".str_ireplace("../css/", "", $manifest->main_styles[0]);
    $js_path = "dist/js/".$manifest->main_scripts;

    //added script files by every fetched file - these need to be included in the layout after the main scripts
	$script_files_manifest = $this->getData("script_files_manifest");	
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<base href="/">
		<link rel="stylesheet" href="<?=$stylesheet_path?>">

		<title>Hello, world!</title>
	</head>
	<body>
	<?=$content?>
	<?=$this->fetch("_modals.php")?>
	<script src="<?=$js_path?>"></script>

	<?php
	//add script files
	$script_files_manifest = $this->getDataCollection("script_files_manifest");
	if (is_array($script_files_manifest)){
		foreach ($script_files_manifest as $script_file) {
	?>
		<script src="dist/js/<?=$manifest->$script_file?>"></script>
	<?php
		}//end foreach
	}//end if
	?>

	<?php
	//add inline scripts
	$script_inline = $this->getDataCollection("script_inline");


	if (is_array($script_inline)){
		foreach ($this->getDataCollection("script_inline") as $script_inline) {
			echo $script_inline;
		}//end foreach
	}//end if
	?>

	</body>
</html>