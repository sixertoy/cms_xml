<div class="control-group form-input-password">
	<label
    	for="{$id}"
    	class="control-label"
	>
		<b>Password</b>
		{if $required}<em>*</em>{/if}
		{if $description}<br><i>{$description}</i>{/if}
	</label>
	<div class="controls">
		<div class="input-append">
			<input type="password" id="{$id}" name="{$id}"
                {literal} pattern="([a-zA-Z0-9\$@*#]{8,15})"{/literal}
				{if $value} value="{$value}"
	      		{else} placeholder="Votre {$label}"
				{/if}
			/><span class="add-on"><i class="icon-lock"></i></span>
	    </div>
	    {if $need_validation}
		<input type="password" id="{$id|cat:'-valid'}" name="{$id|cat:'-valid'}"
            {if $required}required {/if}
            {if $autofocus}autofocus {/if}
			{if $value} value="{$value}"
        	{else} placeholder="V&eacute;rifier votre {$label}"
			{/if}
			onfocus="validatePassword( document.getElementById( '{$id}' ), this );"
			oninput="validatePassword( document.getElementById( '{$id}' ), this );"
    	/>
		{/if}
	</div>
</div>