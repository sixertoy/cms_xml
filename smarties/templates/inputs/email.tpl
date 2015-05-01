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
		<div class='input-append'>
			<input
				type='email'
				id='{$id}'
				name='{$id}'
				{if $value}
					value='{$value}'
				{else}
    	    		{if $description}
						placeholder='{$description}'
        			{else}
        				placeholder='{$label}'
        			{/if}
				{/if}
				{if $required}required {/if}
				{if $autofocus}autofocus {/if}
			/>
			<span class='add-on'>@</span>
		</div>
	</div>
</div>