<style>
table{
	border-collapse: collapse;
	width: 100%;
}

table td{

	border: 1px solid silver;
	padding: 10px;
}

tbody{
	padding-bottom: 20px;
	border: 1px solid silver;
	border-bottom: 5px solid silver;
-moz-transition: all 0.3s ease-out;  /* FF3.7+ */
-o-transition: all 0.3s ease-out;  /* Opera 10.5 */
-webkit-transition: all 0.3s ease-out;  /* Saf3.2+, Chrome */
transition: all 0.3s ease-out;
}

thead th{
	background: #23282D;
	padding: 5px;
	color: white;
}

tbody:nth-child(odd){
	background: #EAF0F0;
}

tbody:hover{
	background: #EAF0F0;

}

#filter{
	width: 100%;
	border: 1px solid #D54E21;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}
</style>

<h1>Requests: <?php echo $countresults?> results</h1>
<?php
if($_POST['search']){
?>
	<h2>Search results: <?php echo count($newtable)?></h2>
<?php
}
?>


<div class="media-toolbar wp-filter">
<table>
	<thead>
		<th>ID</th>
		<th>TYPE</th>
		<th>Travelers</th>
		<th>Cabin</th>
		<th>Email</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Insert date</th>
		<th>User IP </th>
		<th>Request </th>
	<thead>
<tr><td colspan='10'><form method='POST'><input id='filter' class="form-control" name="search" value='<?php echo $search?>' placeholder="Search... Press ENTER to advanced search"/></form></td></tr>
<?php

foreach($newtable as $row){

?><tbody><tr>
		<td><?php echo $row->rq_id?></td>
		<td><?php echo $row->rq_type?></td>
		<td><?php echo $row->rq_traveler_count?></td>
		<td><?php echo $row->rq_cabin?></td>
		<td><?php echo $row->rq_email?></td>
		<td><?php echo $row->rq_name?></td>
		<td><?php echo $row->rq_mobile?></td>
		<td><?php echo $row->rq_insert_date?></td>
		<td><?php echo $row->rq_ip?></td>
		<td><?php echo $row->rq_reference?></td>
</tr>
	</tr>
        <tr>
		<th colspan='5'></th>
		<th>From</th>
		<th>To</th>
		<th>Departure</th>
		<th>Return</th>
		<th></th>

        </tr>
		<?php
		$flights = json_decode($row->rq_flights);

		foreach($flights as $flight){
            ?>

        <tr>
            <td colspan='5'></td>
            <td><?php echo $flight->from?></td>
            <td><?php echo $flight->to?></td>
            <td><?php echo $flight->departure?></td>
            <td><?php echo $flight->return?></td>
            <td></td>
        </tr>
            <?php
        }
	?><tr class='trow'></tr></tbody><?php
}
?>



</table>
<?php

?></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>
$(document).ready(function(){

	tablesearch($('table'));

})

function tablesearch(form){

	var value ="";

	$("#filter").keyup(function a(){

	value = $(this).val(); // содержимое поиска

	$("tbody",form).each(function(){

		if($(this).text().search(new RegExp(value, "gi")) == -1){ //глобальный регистронезависимый поиск
			$(this).hide();
		}else{
			$(this).show();
		}
	})
		}
	)
}
</script>
