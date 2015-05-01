<?php /* Smarty version Smarty-3.0.7, created on 2013-02-11 09:29:42
         compiled from "smarties/templates/tables/email_column.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197695117b9f65d1230-38823732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6dc9c20ccbb23296904fbb7b05f894ce1cc16f11' => 
    array (
      0 => 'smarties/templates/tables/email_column.tpl',
      1 => 1360573885,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197695117b9f65d1230-38823732',
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
><?php ob_start();?><?php echo $_smarty_tpl->getVariable('value')->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('value')->value;?>
<?php $_tmp2=ob_get_clean();?><?php $_template = new Smarty_Internal_Template('email.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('address',$_tmp1);$_template->assign('text',$_tmp2); echo $_template->getRenderedTemplate();?><?php unset($_template);?></td>
<?php }?>