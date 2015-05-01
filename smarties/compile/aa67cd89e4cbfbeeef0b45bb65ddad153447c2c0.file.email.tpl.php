<?php /* Smarty version Smarty-3.0.7, created on 2013-02-11 09:29:43
         compiled from "smarties/templates/email.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37385117bb4ecea176-10325386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa67cd89e4cbfbeeef0b45bb65ddad153447c2c0' => 
    array (
      0 => 'smarties/templates/email.tpl',
      1 => 1360573885,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37385117bb4ecea176-10325386',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_mailto')) include 'E:\www\pure\www\lib\Smarty\plugins\function.mailto.php';
?>
<?php ob_start();?><?php echo $_smarty_tpl->getVariable('address')->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('text')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_function_mailto(array('address'=>$_tmp1,'text'=>$_tmp2,'encode'=>'hex'),$_smarty_tpl);?>
