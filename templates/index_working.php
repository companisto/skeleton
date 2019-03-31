<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="dist/css/<?=str_ireplace("../css/", "", $manifest->app[0])?>">

		<title>Hello, world!</title>
	</head>
	<body>
		<h1>Hello, world!</h1>

		<div class="jumbotron img-test">
	<h1 class="display-4">Hello, world!</h1>
	<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	<hr class="my-4">
	<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
	<p class="lead">
		<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
	</p>
</div>


		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	Launch demo modal 
</button>
<div>Some text for: <i class="fa fa-car"></i></div>
<div>Some text for: <i class="fa fa-eye"></i></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
				Launch demo modal 2
		</button>
		<h5>Popover in a modal</h5>
	<p>This <a href="#" role="button" class="btn btn-secondary popover-test" title="Popover title" data-content="Popover body content is set in this attribute.">button</a> triggers a popover on click.</p>
	<hr>
	<h5>Tooltips in a modal</h5>
	<p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="Tooltip">that link</a> have tooltips on hover.</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quos ullam, eveniet ad esse, sed dolor pariatur hic similique quibusdam atque vitae rerum laudantium odit doloribus excepturi fugiat nulla molestiae.</br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quos ullam, eveniet ad esse, sed dolor pariatur hic similique quibusdam atque vitae rerum laudantium odit doloribus excepturi fugiat nulla molestiae.</br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quos ullam, eveniet ad esse, sed dolor pariatur hic similique quibusdam atque vitae rerum laudantium odit doloribus excepturi fugiat nulla molestiae.</br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quos ullam, eveniet ad esse, sed dolor pariatur hic similique quibusdam atque vitae rerum laudantium odit doloribus excepturi fugiat nulla molestiae.</br>
				<h5>Popover in a modal</h5>
	<p>This <a href="#" role="button" class="btn btn-secondary popover-test" title="Popover title" data-content="Popover body content is set in this attribute.">button</a> triggers a popover on click.</p>
	<hr>
	<h5>Tooltips in a modal</h5>
	<p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="Tooltip">that link</a> have tooltips on hover.</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

		<script src="dist/js/<?=$manifest->app[1]?>"></script>
		<script>
				$(".tooltip-test").tooltip();
				$(".popover-test").popover();
		</script>
	</body>
</html>