{extends file="link.tpl"}
{block name="label" append}
{if $icon}<i class="icon-{$icon}"></i>&nbsp;{/if}{$smarty.block.parent}
{/block}