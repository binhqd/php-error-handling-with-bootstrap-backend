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
		.header-group {font-weight: bold;font-style:italic;background: #dddddd}
		</style>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="./bootstrap/assets/js/html5shiv.js"></script>
			<script src="./bootstrap/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<script language='javascript' src='./js/jquery.min.js'></script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Error logging</h1>
				<p class="lead">List all errors, groups by file and line.</p>
			</div>
			
			<table class="table">
			<tr>
				<td colspan='4'>[ <a href='./'>Back to Error Index</a> ]
				<h4>File: <?php echo $file?></h4>
				<h4>Line: <?php echo $line?></h4>
				</td>
			</tr>
			<?php $cnt = 1;
			foreach ($groups as $uri => $methods):
			foreach ($methods as $method => $errors):?>
			
			<tr class='header-group'>
				<td>(Error <?php echo $errors['errors'][0]['code'];?>) <?php echo $method;?>: <?php echo $uri;?></td>
				<td class='span2'>TOTAL: <?php echo $errors['count'];?></td>
				<td class='span2'>
					[ <a href='<?php echo "./deleteErrorsByGroup.php?file=".urlencode($file)."&line={$line}&uri=".urlencode($uri)."&method={$method}"?>'>Remove group</a> ]
				</td>
			</tr>
			<tr>
				<td colspan='4'>
				<table class="table table-striped font-small">
				<tr>
					<th class='span1'>#</th>
					<th>Message</th>
					<th class='span4'>Referrer</th>
					<th class='span2'>IP</th>
					<th class='span2'>Browser</th>
					<th class='span2'>Date</th>
				</tr>
				<?php $itemCnt = 1;
				foreach ($errors['errors'] as $item):?>
				<tr>
					<td><?php echo $itemCnt++;?></td>
					<td class='td-traces'>
						<?php echo $item['message']?>
						<ol class='traces'>
						<?php foreach ($item['traces'] as $trace):?>
						<li><?php echo $trace?></li>
						<?php endforeach;?>
						</ol>
						<div class='show-traces'>[ <a href='#'><span>Show traces</span></a> ]</div>
					</td>
					<td><?php echo $item['referrer']?></td>
					<td><?php echo $item['ip']?></td>
					<td><?php echo $item['browser']['platform']?> <?php echo $item['browser']['version']?></td>
					<td><?php echo date("Y-m-d H:i:s", strtotime($item['logtime']))?></td>
				</tr>
				<?php endforeach;?>
				</table>
				</td>
			</tr>
			<?php endforeach;endforeach;?>
			</table>
			
			<script language='javascript'>
			$(document).ready(function() {
				$('.show-traces').click(function() {
					if ($(this).hasClass('showed')) {
						$(this).parents('td.td-traces').find('.traces').hide();
						$(this).removeClass('showed');
						$(this).find('span').html('Show Traces');
					} else {
						$(this).parents('td.td-traces').find('.traces').show();
						$(this).addClass('showed');
						$(this).find('span').html('Hide Traces');
					}
					return false;
				});
			});
			</script>
		</div>
	
	</body>
</html>
