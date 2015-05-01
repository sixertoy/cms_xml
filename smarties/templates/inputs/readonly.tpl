<div class="control-group">
	<label
		for="{$id}"
		class="control-label"
	>
		<b>{$label}</b>
		{if $description}<br><i>{$description}</i>{/if}
	</label>
	<div class="controls">
		<span class="input-xlarge uneditable-input">{if $value}{$value}{/if}</span>
		<input type="hidden" value="{if $value}{$value}{/if}" id="{$id}" name="{$id}" />
	</div>
</div>