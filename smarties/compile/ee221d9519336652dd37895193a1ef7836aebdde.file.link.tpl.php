<?php /* Smarty version Smarty-3.0.7, created on 2013-02-10 14:44:47
         compiled from "smarties/templates/bootstrap/link.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60815117b25f38cb61-72498979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee221d9519336652dd37895193a1ef7836aebdde' => 
    array (
      0 => 'smarties/templates/bootstrap/link.tpl',
      1 => 1360507484,
      2 => 'file',
    ),
    'a4f91a8a3967b46adffb7b7f0e19b00b6ba21f2d' => 
    array (
      0 => 'smarties/templates/link.tpl',
      1 => 1360507399,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60815117b25f38cb61-72498979',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a
    title='<?php echo $_smarty_tpl->getVariable('label')->value;?>
'
    href='<?php echo $_SERVER['SCRIPT_NAME'];?>
<?php echo $_smarty_tpl->getVariable('url')->value;?>
'
    class='<?php echo $_smarty_tpl->getVariable('classes')->value;?>
'
>

<?php if ($_smarty_tpl->getVariable('icon')->value){?><i class="icon-<?php echo $_smarty_tpl->getVariable('icon')->value;?>
"></i>&nbsp;<?php }?>
<?php echo $_smarty_tpl->getVariable('label')->value;?>

</a>