<dt>
    {if $label}
    <label for="{$id}">
        <b>{$label}</b>
		{if $required}<em>*</em>{/if}
        {if $description}<br><i>{$description}</i>{/if}
    </label>
    {/if}
</dt>
<dd>
    <select id='{$id}' name='{$id}'>
	{html_options options=$options selected=$selected}
	</select>
</dd>