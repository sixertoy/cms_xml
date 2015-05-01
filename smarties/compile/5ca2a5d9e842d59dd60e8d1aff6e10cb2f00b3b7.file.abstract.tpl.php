<?php /* Smarty version Smarty-3.0.7, created on 2012-12-03 10:37:19
         compiled from "E:\www\pure\cache\smarties/templates/inputs/abstract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1009450bc80df69c9c0-91335106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ca2a5d9e842d59dd60e8d1aff6e10cb2f00b3b7' => 
    array (
      0 => 'E:\\www\\pure\\cache\\smarties/templates/inputs/abstract.tpl',
      1 => 1354527706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1009450bc80df69c9c0-91335106',
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
		<input
			type="text"
			id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			<?php if ($_smarty_tpl->getVariable('value')->value){?>
				value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
			<?php }else{ ?>
        		<?php if ($_smarty_tpl->getVariable('description')->value){?>
					placeholder="<?php echo $_smarty_tpl->getVariable('description')->value;?>
"
        		<?php }else{ ?>
        			placeholder="<?php echo $_smarty_tpl->getVariable('label')->value;?>
"
        		<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
			<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
	><em></em>
	</div>
</div>