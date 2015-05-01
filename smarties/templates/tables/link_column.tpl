{if $label}
<th
    class="column-header column-{$key}"
    style="text-align:{$align};"
>{$label}</th>
{else}
<td
    class="column-{$key}"
    style="text-align:{$align};"
><a href="{$value}" title="{$label}">{$value}</a></td>
{/if}