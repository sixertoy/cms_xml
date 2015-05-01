<?php /* Smarty version Smarty-3.0.7, created on 2013-10-27 08:01:50
         compiled from "smarties/templates/inputs/email.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5568526cc86e0122c6-22137783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99ee364f705858824dfd7f7454414d6e4fa41c2f' => 
    array (
      0 => 'smarties/templates/inputs/email.tpl',
      1 => 1376648163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5568526cc86e0122c6-22137783',
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
		<div class='input-append'>
			<input
				type='email'
				id='<?php echo $_smarty_tpl->getVariable('id')->value;?>
'
				name='<?php echo $_smarty_tpl->getVariable('id')->value;?>
'
				<?php if ($_smarty_tpl->getVariable('value')->value){?>
					value='<?php echo $_smarty_tpl->getVariable('value')->value;?>
'
				<?php }else{ ?>
    	    		<?php if ($_smarty_tpl->getVariable('description')->value){?>
						placeholder='<?php echo $_smarty_tpl->getVariable('description')->value;?>
'
        			<?php }else{ ?>
        				placeholder='<?php echo $_smarty_tpl->getVariable('label')->value;?>
'
        			<?php }?>
				<?php }?>
				<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
				<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
			/>
			<span class='add-on'>@</span>
		</div>
	</div>
</div>