

<h2>{$section->box_title}<br />
	{*<small>{$section->box_description}</small>*}
</h2>
{if !isset($section->box_can_add) || isset($section->box_can_add) && $section->box_can_add == true}
	<button class="btn btn-large btn-block btn-success" type="button"
	        onclick="OpenSection('{$section->name}', 0);return false;">{$section->box_add_title}</button>
	<p class="muted pt20">or browse existing ones:</p>
{/if}

<select class="input-block-level" size="10" name="tips"
        onchange="OpenSection('{$section->name}', this.value);return false;">
	{foreach from=$section->box_elements item=item_value key=item_key}
		<option {if $section->box_value == $item_key}selected="selected"{/if} value="{$item_key}" title="{$item_value}">{$item_value}</option>
	{/foreach}
</select>
{if $section->box_sortable and $section->box_value>0 and $section->box_elements|@count > 1}
	<ul class="nav nav-pills nav-center">
		{if $first_id != $section->box_value}
			<li><a href="{$url}{$selectedUrl}?{$section->name}_sort=first&{$sections->generateUrlParams()}"><i
							class="icon-step-backward icon-rotate-90"></i></a></li>
			<li><a href="{$url}{$selectedUrl}?{$section->name}_sort=prew&{$sections->generateUrlParams()}"><i
							class="icon-chevron-up"></i></a></li>
		{/if}
		{if $last_id != $section->box_value}
			<li><a href="{$url}{$selectedUrl}?{$section->name}_sort=next&{$sections->generateUrlParams()}"><i
							class="icon-chevron-down"></i></a></li>
			<li><a href="{$url}{$selectedUrl}?{$section->name}_sort=last&{$sections->generateUrlParams()}"><i
							class="icon-step-forward icon-rotate-90"></i></a></li>
		{/if}
	</ul>
{/if}
