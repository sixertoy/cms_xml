<?php /* Smarty version Smarty-3.0.7, created on 2012-12-02 11:22:12
         compiled from "D:\www\pure\cache\smarties/templates/inputs/email.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2020150bb39e4753256-84060954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfa00be7ca407f35502dbb9dd40d2da14ec03b70' => 
    array (
      0 => 'D:\\www\\pure\\cache\\smarties/templates/inputs/email.tpl',
      1 => 1354447329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2020150bb39e4753256-84060954',
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
		<div class="input-append">
			<input
				type="email"
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
			>
			<span class="add-on">@</span><em></em>
		</div>
	</div>
</div>