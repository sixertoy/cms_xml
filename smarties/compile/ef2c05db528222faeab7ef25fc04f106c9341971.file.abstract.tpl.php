<?php /* Smarty version Smarty-3.0.7, created on 2012-12-02 10:24:00
         compiled from "D:\www\pure\cache\smarties/templates/inputs/abstract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:694650bb2c4024aa36-09118195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef2c05db528222faeab7ef25fc04f106c9341971' => 
    array (
      0 => 'D:\\www\\pure\\cache\\smarties/templates/inputs/abstract.tpl',
      1 => 1354443833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '694650bb2c4024aa36-09118195',
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