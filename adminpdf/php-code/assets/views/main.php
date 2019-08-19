<?if (isset($render_json)){
	echo $json_result;
}

 else {?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHPixie</title>
	</head>
	<body>
		<!-- Here is where we include a subtemplate -->
		<?php include($subview.'.php');?>
	</body>
</html>
<?}