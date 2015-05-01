<dt>
    {if $label}
    <label for='{$id}'>
        <b>{$label}</b>
		{if $required}<em>*</em>{/if}
        {if $description}<br><i>{$description}</i>{/if}
    </label>
    {/if}
</dt>
<dd>
    <textarea id='{$id}' class='texteditor' name='{$id}' cols='{$width}' rows='{$height}'
		{if !$value}placeholder='Votre {$label}'{/if}
		{if $required}required {/if}
		{if $autofocus}autofocus {/if}
	>{$value}</textarea>
</dd>