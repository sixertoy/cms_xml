<?php /* Smarty version Smarty-3.0.7, created on 2013-10-27 07:59:50
         compiled from "smarties/templates/inputs/abstract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5117526cc7f6320000-79537132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd378fed8b9e8526e5b14054147f6b22319087e2f' => 
    array (
      0 => 'smarties/templates/inputs/abstract.tpl',
      1 => 1376648163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5117526cc7f6320000-79537132',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class='control-group'>
	<label
		for='<?php echo $_smarty_tpl->getVariable('id')->value;?>
'
		class='control-label'
	>
		<b><?php echo $_smarty_tpl->getVariable('label')->value;?>
</b>
		<?php if ($_smarty_tpl->getVariable('required')->value){?><em>*</em><?php }?>
		<?php if ($_smarty_tpl->getVariable('description')->value){?><br><i><?php echo $_smarty_tpl->getVariable('description')->value;?>
</i><?php }?>
	</label>
	<div class='controls'>
		<input
			type='text' id='<?php echo $_smarty_tpl->getVariable('id')->value;?>
' name='<?php echo $_smarty_tpl->getVariable('id')->value;?>
'
			<?php if ($_smarty_tpl->getVariable('value')->value){?> value='<?php echo $_smarty_tpl->getVariable('value')->value;?>
'
			<?php }else{ ?>
        		<?php if ($_smarty_tpl->getVariable('description')->value){?> placeholder='<?php echo $_smarty_tpl->getVariable('description')->value;?>
'
        		<?php }else{ ?> placeholder='<?php echo $_smarty_tpl->getVariable('label')->value;?>
'
        		<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('classes')->value){?>class='<?php echo $_smarty_tpl->getVariable('classes')->value;?>
' <?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
			<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
			<?php if ($_smarty_tpl->getVariable('readonly')->value){?>readonly='readonly'<?php }?>
			<?php if ($_smarty_tpl->getVariable('disabled')->value){?>disabled='disabled'<?php }?> />
	</div>
</div>