<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="./bootstrap/assets/ico/favicon.png">

		<title>Grid Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="./bootstrap/dist/css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="./css/grid.css" rel="stylesheet">
		<style>
			.font-small {font-size:11px;}
			.traces {display:none;}
			.traces li:nth-child(odd) {background-color: #f9f9f9;}
			.traces li:nth-child(even) {background-color: #ffffff;}
		</style>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../../assets/js/html5shiv.js"></script>
			<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Error logging</h1>
				<p class="lead">List all errors, groups by file and line.</p>
			</div>
			
			
			<div style='margin-top:10px'>&nbsp;</div>
			<table class="table table-striped font-small">
			<tr>
				<th class='span1'>#</th>
				<th class='span4'>Message</th>
				<th>File</th>
				<th class='span1'>Total</th>
				<th class='span2'>Action</th>
			</tr>
			<?php $cnt = 1;
			foreach ($groups as $file => $lines):
			foreach ($lines as $line => $errors):?>
			<tr>
				<td><?php echo $cnt++;?></td>
				<td>
					<?php echo $errors['errors'][0]['message'];?>
				</td>
				<td>
					<div><?php echo $file;?> (<?php echo $line;?>)</div>
					
				</td>
				<td><?php echo $errors['count'];?></td>
				<td>
					[ 
						<a href='<?php echo "./deleteErrors.php?file=".urlencode($file)."&line={$line}"?>'>Delete</a> 
						| <a href='<?php echo "./listErrors.php?file=".urlencode($file)."&line={$line}"?>'>List Errors</a> 
					]
				</td>
			</tr>
			<?php endforeach;endforeach;?>
			</table>
			
			<script language='javascript'>
			
			</script>
		</div>
	</body>
</html>
