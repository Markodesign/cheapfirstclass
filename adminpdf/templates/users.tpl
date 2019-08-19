<script type="text/javascript">

	jQuery(function ($) {

	});

</script>


<div class="container-fluid nopd">
	<div class="row-fluid">
		<div class="main smal">
				<div class="page-header"><h1>Users: {$users_count}</h1>

					<table class="table table-hover table-striped table-bordered" id="account-fixed">

						<tr>
							<td></td>
							<td></td>
							<td>Yesterday</td>
							<td>Last Week</td>
							<td>Last Month</td>
							<td>All Period</td>

						</tr>

						{foreach from=$users[$last_key] item=row key=Key}
							<tr >
								<td >{$Key|ucfirst} Users</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>Number of trial users </td>
								<td>{$users['day_1'][$Key].trial|default:0}</td>
								<td>{$users['day_7'][$Key].trial|default:0}</td>
								<td>{$users['day_30'][$Key].trial|default:0}</td>
								<td>{$row.trial|default:0}</td>
								

							<tr>
								<td></td>
								<td>Number of active users</td>
								<td>{$users['day_1'][$Key].paid|default:0}</td>
								<td>{$users['day_7'][$Key].paid|default:0}</td>
							<td>{$users['day_30'][$Key].paid|default:0}</td>

							<td>{$row.paid|default:0}</td>


						</tr>
							<tr>
								<td></td>
								<td>Number of cancelled  users</td>
								<td>{$users['day_1'][$Key].active[0]|default:0}</td>
								<td>{$users['day_7'][$Key].active[0]|default:0}</td>
								<td>{$users['day_30'][$Key].active[0]|default:0}</td>
								<td>{$row.active[0]|default:0}</td>

							</tr>
							<tr>
								<td></td>
								<td>Number of MEV   users</td>
								<td>{$users['day_1'][$Key].print_system['mev']|default:0}</td>
								<td>{$users['day_7'][$Key].print_system['mev']|default:0}</td>
								<td>{$users['day_30'][$Key].print_system['mev']|default:0}</td>
								<td>{$row.print_system['mev']|default:0}</td>

							</tr>
							<tr>
								<td></td>
								<td>Number of Non-MEV  users</td>
								<td>{$users['day_1'][$Key].print_system['epson']|default:0}</td>
								<td>{$users['day_7'][$Key].print_system['epson']|default:0}</td>
								<td>{$users['day_30'][$Key].print_system['epson']|default:0}</td>
								<td>{$row.print_system['epson']|default:0}</td>

							</tr>
						{/foreach}
					</table>


				</div>
		</div>
	</div>
</div>
