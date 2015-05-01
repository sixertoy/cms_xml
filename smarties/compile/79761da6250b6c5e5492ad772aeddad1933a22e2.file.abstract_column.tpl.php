<?php /* Smarty version Smarty-3.0.7, created on 2013-02-12 07:19:13
         compiled from "smarties/templates/tables/abstract_column.tpl" */ ?>
<?php /*%%SmartyHeaderCode:268315118d3a78248a9-96046486%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79761da6250b6c5e5492ad772aeddad1933a22e2' => 
    array (
      0 => 'smarties/templates/tables/abstract_column.tpl',
      1 => 1360604678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '268315118d3a78248a9-96046486',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('label')->value){?>
<th
    class="column-header column-<?php echo $_smarty_tpl->getVariable('key')->value;?>
"
    style="text-align:<?php echo $_smarty_tpl->getVariable('align')->value;?>
;"
><?php echo $_smarty_tpl->getVariable('label')->value;?>
</th>
<?php }else{ ?>
<td
    class="column-<?php echo $_smarty_tpl->getVariable('key')->value;?>
"
    style="text-align:<?php echo $_smarty_tpl->getVariable('align')->value;?>
;"
><?php echo $_smarty_tpl->getVariable('value')->value;?>
</td>
<?php }?>