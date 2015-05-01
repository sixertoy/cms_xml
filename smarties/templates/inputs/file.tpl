<dt>
    {if $label}
    <label for='{$id}'>
        <b>{$label}</b>
        {if $description}
        <br><i>{$description}</i>
        {/if}
    </label>
    {/if}
</dt>
<dd>
    <input
	   type='file'
		id='{$id}'
		name='{$id}'
		/>
</dd>