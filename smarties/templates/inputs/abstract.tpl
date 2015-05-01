<div class='control-group'>
	<label
		for='{$id}'
		class='control-label'
	>
		<b>{$label}</b>
		{if $required}<em>*</em>{/if}
		{if $description}<br><i>{$description}</i>{/if}
	</label>
	<div class='controls'>
		<input
			type='text' id='{$id}' name='{$id}'
			{if $value} value='{$value}'
			{else}
        		{if $description} placeholder='{$description}'
        		{else} placeholder='{$label}'
        		{/if}
			{/if}
			{if $classes}class='{$classes}' {/if}
			{if $required}required {/if}
			{if $autofocus}autofocus {/if}
			{if $readonly}readonly='readonly'{/if}
			{if $disabled}disabled='disabled'{/if} />
	</div>
</div>