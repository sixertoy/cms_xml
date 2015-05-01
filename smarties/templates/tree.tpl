{function name="dropdownmenu" level=0}
<ul class="level{$level}">
    {foreach $data as $entry}
    <li>
        <a href=""></a>
        {if }
        <ul>
        {call name="dropdownmenu" data=$entry level=$level+1}
        </ul>
        {else}
        
        {/if}
    </li>
    {/foreach}
</ul>
{/function}
{call dropdownmenu data=$items class=$class}