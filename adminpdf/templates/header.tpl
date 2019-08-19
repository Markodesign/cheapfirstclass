<!DOCTYPE html>
	<html lang="en">
	<head>
		{include file="meta.tpl"}


		<meta charset="utf-8">
		<title>CHEPFIRSTCLASS</title>

	</head>
	<body class="background-white">
	<div style="height: 40px;"></div>
	<!-- NOTIFICATION -->
	<div class="notification">
		<div id="newWarning" class="alert alert-block hide ">
			<button id="" class="close" type="button">×</button>
			<h4 class="notification-title alert-heading"></h4>
			<p class="notification-text"></p>
		</div>
	</div>

	<!-- NAVBAR -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<span class="brand" >CHEAPFIRSTCLASS </span>
				<div class="nav-collapse collapse">
					<ul class="nav pull-right">
						{*<li><a href="{$url}{$home.url}">Launch website</a></li>*}
						<li><a href="{$url}{$quit.url}">{$quit.$lang}</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- COLORBAR -->
	<div class="colorbar"></div>
	<!-- SIDEBAR -->
	<div class="sidebar">
		<ul class="nav nav-list">
			{if count($topMenu) > 1}
			{foreach from=$topMenu key=currentChild item=menuChild}
				{if in_array($access_type, $menuChild.admin_access)}
					<li{if $currentChild == $selectedTop} class="active"{/if}><a href="{$url}{$currentChild}/">{$menuChild.$lang}</a></li>
				{/if}
			{/foreach}
			{/if}
			{if count($menu.$selectedTop)}
			{if count($topMenu) > 1}
				<li class="nav-header">Sections</li>
			{/if}

				{foreach from=$menu.$selectedTop key=currentChild item=menuChild}
							{if in_array($access_type, $menuChild.admin_access)}
								<li {if $currentChild == $selectedMenu} class="active"{/if}><a href="{$url}{$selectedTop}/{$currentChild}/">{$menuChild.$lang}</a>										</li>
							{/if}
						{/foreach}

			{/if}
	</ul>
	</div>
	<!-- MODAL -->

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header text-center">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"></h3>
		</div>
		<div class="modal-body text-center">
			<p></p>
		</div>
		<div class="modal-footer">
			<div class="text-center">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">No</button>
				<button class="btn btn-success ">Yes</button>
			</div>
		</div>
	</div>

