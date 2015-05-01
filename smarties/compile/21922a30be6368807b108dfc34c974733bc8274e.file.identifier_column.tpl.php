<?php /* Smarty version Smarty-3.0.7, created on 2013-02-12 07:19:13
         compiled from "smarties/templates/tables/identifier_column.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129105118d4b1900742-86804256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21922a30be6368807b108dfc34c974733bc8274e' => 
    array (
      0 => 'smarties/templates/tables/identifier_column.tpl',
      1 => 1360604678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129105118d4b1900742-86804256',
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
;width:13px;" >
    <?php if ($_smarty_tpl->getVariable('editable')->value){?>
        <input type="checkbox" onclick="" />
    <?php }else{ ?>
        <?php echo $_smarty_tpl->getVariable('label')->value;?>

    <?php }?>
</th>
<?php }else{ ?>
<td
    class="column-<?php echo $_smarty_tpl->getVariable('key')->value;?>
"
    style="text-align:<?php echo $_smarty_tpl->getVariable('align')->value;?>
;width:13px;"
>
    <?php if ($_smarty_tpl->getVariable('editable')->value){?>
        <input type="checkbox" name="identifier-<?php echo $_smarty_tpl->getVariable('value')->value;?>
" />
    <?php }else{ ?>
        <?php echo $_smarty_tpl->getVariable('value')->value;?>

    <?php }?>
</td>
<?php }?>