

<form method="post">
	<div>
		<textarea  name="text" cols="50" rows="10" placeholder="select"><?=$text?></textarea>
	</div>
	<?foreach ($connections as $value):?>

		<div>
			<label > <?=$value['db_login']?>
				<input type="checkbox" name="db[<?=$value['db_login']?>]" value="1">
			</label>
		</div>

	<?endforeach ?>
	<div>
		<input type="submit" value="Submit">
	</div>
</form>
