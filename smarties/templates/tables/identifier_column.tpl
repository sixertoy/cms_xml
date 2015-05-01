{if $label}
<th
    class="column-header column-{$key}"
    style="text-align:{$align};width:13px;" >
    {if $editable}
        <input type="checkbox" onclick="" />
    {else}
        {$label}
    {/if}
</th>
{else}
<td
    class="column-{$key}"
    style="text-align:{$align};width:13px;"
>
    {if $editable}
        <input type="checkbox" name="identifier-{$value}" />
    {else}
        {$value}
    {/if}
</td>
{/if}