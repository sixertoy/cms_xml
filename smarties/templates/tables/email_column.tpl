{if $label}
<th
    class="column-header column-{$key}"
    style="text-align:{$align};"
>{$label}</th>
{else}
<td
    class="column-{$key}"
    style="text-align:{$align};"
>{include 'email.tpl' address={$value} text={$value}}</td>
{/if}