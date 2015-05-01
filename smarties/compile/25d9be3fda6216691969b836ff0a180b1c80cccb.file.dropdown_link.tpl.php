<?php /* Smarty version Smarty-3.0.7, created on 2013-02-11 09:29:42
         compiled from "smarties/templates/bootstrap/dropdown_link.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244755117bfbc775255-57942420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25d9be3fda6216691969b836ff0a180b1c80cccb' => 
    array (
      0 => 'smarties/templates/bootstrap/dropdown_link.tpl',
      1 => 1360573885,
      2 => 'file',
    ),
    'fd9399817065baf02b4e428f418839ecad49f742' => 
    array (
      0 => 'smarties/templates/bootstrap/icon_link.tpl',
      1 => 1360573885,
      2 => 'file',
    ),
    'a4f91a8a3967b46adffb7b7f0e19b00b6ba21f2d' => 
    array (
      0 => 'smarties/templates/link.tpl',
      1 => 1360573885,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244755117bfbc775255-57942420',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a
    href='<?php echo $_smarty_tpl->getVariable('url')->value;?>
'
    title='<?php echo $_smarty_tpl->getVariable('label')->value;?>
'
    class='<?php echo $_smarty_tpl->getVariable('classes')->value;?>
'
    data-toggle="dropdown"
>

<?php if ($_smarty_tpl->getVariable('icon')->value){?><i class="icon-<?php echo $_smarty_tpl->getVariable('icon')->value;?>
"></i>&nbsp;<?php }?><?php echo $_smarty_tpl->getVariable('label')->value;?>

&nbsp;<b class="caret"></b>
</a>