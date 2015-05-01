<?php /* Smarty version Smarty-3.0.7, created on 2013-02-10 14:43:08
         compiled from "smarties/templates/link.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92245117b1fcc68608-89054269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4f91a8a3967b46adffb7b7f0e19b00b6ba21f2d' => 
    array (
      0 => 'smarties/templates/link.tpl',
      1 => 1360507386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92245117b1fcc68608-89054269',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a
    title='<?php echo $_smarty_tpl->getVariable('label')->value;?>
'
    href='<?php echo $_SERVER['SCRIPT_NAME'];?>
'
    class='<?php echo $_smarty_tpl->getVariable('classes')->value;?>
'
>
<?php echo $_smarty_tpl->getVariable('label')->value;?>

</a>