<?php /* Smarty version Smarty-3.0.7, created on 2013-10-27 07:59:50
         compiled from "smarties/templates/inputs/readonly.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18674526cc7f662d4b0-81260128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '885635972ab83417f969cba51fd90c443ebc03d4' => 
    array (
      0 => 'smarties/templates/inputs/readonly.tpl',
      1 => 1376648163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18674526cc7f662d4b0-81260128',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="control-group">
	<label
		for="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
		class="control-label"
	>
		<b><?php echo $_smarty_tpl->getVariable('label')->value;?>
</b>
		<?php if ($_smarty_tpl->getVariable('description')->value){?><br><i><?php echo $_smarty_tpl->getVariable('description')->value;?>
</i><?php }?>
	</label>
	<div class="controls">
		<span class="input-xlarge uneditable-input"><?php if ($_smarty_tpl->getVariable('value')->value){?><?php echo $_smarty_tpl->getVariable('value')->value;?>
<?php }?></span>
		<input type="hidden" value="<?php if ($_smarty_tpl->getVariable('value')->value){?><?php echo $_smarty_tpl->getVariable('value')->value;?>
<?php }?>" id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
	</div>
</div>