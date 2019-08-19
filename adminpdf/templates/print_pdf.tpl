<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=1024">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Koomi POS Invoice - {$invoice.invoice_id}</title>

	<link rel="icon" type="image/png" href="{$url}images/favicon.png">

	<link rel="stylesheet" type="text/css" href="{$url}css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{$url}css/style.css">
{if $print == 'y'}
	<script type="text/javascript">
		window.print();
	</script>
	<style>

	</style>

		{/if}
<style>

	html {
		margin: 0;
		padding: 0;
	}

	body {
		font: 500 11px/1.6 Raleway, sans-serif;
		color: #000;
		padding: 30px 0 280px 0;
		margin: 0;
	}
	.border-top td{
		border-bottom: 1px solid #000;
	}
	table {
		width: 100%;
		/*padding: 40px;*/
	}
	.subtotal td {
		padding-top: 36px;
	}

</style>
</head>
<body>
<table style="padding: 0 7%;">
	<tr>
		<td style="padding-bottom: 42px; width: 35%;">
			{*<a href="{$site_url}" style="text-decoration: none" ></a>*}
				<img src="{$cms_url}images/pdf/logo.jpg" alt="Koomi" style="display: block; max-width: 80px;">

		</td>
		<td></td>
		<td valign="top" style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; width: 21%;">
			Invoice N°<br>
			{$invoice.invoice_id}
			{if $invoice.refund}<span style="color:red ;">REFUNDED</span>{/if}

		</td>
	</tr>
	<tr>
		<td style="font-weight: 700; font-size: 7px; letter-spacing: 0.075em;">
			TRANSACTION DATE
		</td>
		<td style="font-weight: 700; font-size: 7px; letter-spacing: 0.075em;">
			CONFIRMATION N°
		</td>
		<td></td>
	</tr>
	<tr>

		<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			{$invoice.time}

		</td>
		<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			{$invoice.transaction_id}
		</td>
		<td></td>
	</tr>

	<tr>

		<td style="padding: 36px 0 17px; font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			BILLING
		</td>
		<td>
		</td>
		<td>
		</td>
	</tr

	<tr>

		<td valign="bottom" style="font-weight: 700; font-size: 7px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			NAME
		</td>
		<td  valign="bottom" colspan="2" style="font-weight: 400; font-size: 11px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			{$billing.first_name} {$billing.last_name}
		</td>

	</tr>
	<tr>

		<td  valign="bottom" style="font-weight: 700; font-size: 7px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			COMPANY
		</td>
		<td valign="bottom" colspan="2" style="font-weight: 400; font-size: 11px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			{$billing.company_name}
		</td>

	</tr>
	<tr>

		<td valign="bottom" style="font-weight: 700; font-size: 7px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			ADDRESS
		</td>
		<td valign="bottom" colspan="2" style="font-weight: 400; font-size: 11px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			{$billing.address}, {if $billing.second_address}{$billing.second_address}, {/if} {$billing.city},
			{if $billing.region_name}{$billing.region_name}, {/if}
			{$billing.country_name}, {$billing.postal_code}
		</td>

	</tr>

	<tr>

		<td valign="bottom" style="font-weight: 700; font-size: 7px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			PHONE
		</td>
		<td valign="bottom" colspan="2" style="font-weight: 400; font-size: 11px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			{$billing.phone}
		</td>

	</tr>
	<tr>

		<td valign="bottom" style="font-weight: 700; font-size: 7px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			CREDIT CARD
		</td>
		<td valign="bottom" colspan="2" style="font-weight: 400; font-size: 11px; line-height: 12px; vertical-align: baseline; letter-spacing: 0.075em;">
			{$billing.card_type}
		</td>

	</tr>
	<tr>

		<td colspan="2" style="padding: 36px 0 17px 0; font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			PURCHASE
		</td>
		<td style="padding: 36px 0 17px 0; font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			TOTAL
		</td>

	</tr>

	<tr>

		<td colspan="2" style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
			{$invoice.configuration|capitalize} Monthly Subscription
		</td>
		<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
	        ${number_format($amount.base_price/100, 2, '.', '')} CAD
		</td>

	</tr>
	{if $amount.prorate}
		{foreach from=$amount.prorate key=k item=v}
			<tr>

				<td colspan="2" style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
					{$k|capitalize} Monthly Subscription - Prorated
				</td>
				<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em;">
					${number_format($v/100, 2, '.', '')} CAD
				</td>

			</tr>
		{/foreach}


	{/if}

</table>


<div style="position: fixed; bottom: 140px; left: 0; right: 0; background: #fff;">

	<table style="padding: 0 7%;">

		<tr class="border-top subtotal" >

			<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; width: 35%; padding: 7px 0;">
				SUBTOTAL
			</td>
			<td>

			</td>
			<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; width: 21%; padding: 7px 0;">
				${number_format($amount.subtotal/100, 2, '.', '')} CAD
			</td>

		</tr>
		{if $amount.tax_price > 0}
		<tr class="border-top">

			<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
				TAX ({$amount.taxes.tax1}%)
			</td>
			<td>

			</td>
			<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
				${number_format($amount.taxes.tax1_price/100, 2, '.', '')} CAD
			</td>

		</tr>
		{if $amount.taxes.tax2}
			<tr class="border-top">

				<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
					TAX ({$amount.taxes.tax2})
				</td>
				<td>

				</td>
				<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
					${number_format($amount.taxes.tax2_price/100, 2, '.', '')} CAD
				</td>

			</tr>

		{/if}
		{/if}
		<tr>

			<td style="font-weight: 400; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
				TOTAL
			</td>
			<td>

			</td>
			<td style="font-weight: 700; font-size: 11px; letter-spacing: 0.075em; padding: 7px 0;">
				${number_format($amount.amount/100, 2, '.', '')} CAD
			</td>

		</tr>

	</table>

</div>

<div style="position: fixed; bottom: 0; left: 0; right: 0; background: #f4f4f4; height: 120px;">

	<table style="font-size: 8px; color: #5b5c5f; padding: 0 7%;">
		<tr>

			<td style="vertical-align: top; padding-top: 19px;" >
				{*<a href="{$site_url}" style="text-decoration: none" ></a>*}
					<img src="{$cms_url}images/pdf/koomi.jpg" alt="Koomi" style="display: block; max-width: 53px;">
				<br>
				{*<span>
					<a href="{$site_url}" style="text-decoration: none;"><img src="{$cms_url}images/pdf/view_online.jpg" alt="View online" style="display: block; max-width: 72px;"></a>
				</span>*}

			</td>

			<td style="padding-top: 19px;">
				Questions? Reach us by phone at +1.844.MY.KOOMI (695.6664) or by email at info@koomi.com <br>
				<br>
				{if $amount.tax_price > 0}
					GST No. 804071124<br>
					{if $amount.taxes.tax2}TVQ No. 1223033683<br>{/if}
					<br>
				{/if}
				Koomi Inc. 304 rue Notre-Dame Est, Suite 400, Montréal, Québec, H2Y 1C7
			</td>

		</tr>
	</table>

</div>


</body>


</html>