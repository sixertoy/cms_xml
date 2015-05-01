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
    <input type='checkbox' id='{$id}' name='{$id}'
        {if $checked}checked='checked'{/if}
		{if $required}required{/if} />
</dd>