<?php /* Smarty version Smarty-3.0.7, created on 2012-12-02 11:43:50
         compiled from "D:\www\pure\cache\smarties/templates/inputs/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2700150bb3ef6dcd2b8-97523036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64c114a928297cd3f6126145f7d2ed912e467b2d' => 
    array (
      0 => 'D:\\www\\pure\\cache\\smarties/templates/inputs/password.tpl',
      1 => 1354448574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2700150bb3ef6dcd2b8-97523036',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="control-group form-input-password">
	<label
    	for="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
    	class="control-label"
	>
		<b>Password</b>
		<?php if ($_smarty_tpl->getVariable('description')->value){?><br><i><?php echo $_smarty_tpl->getVariable('description')->value;?>
</i><?php }?>
	</label>
	<div class="controls">
		<div class="input-append">
			<input
				type="password"
	      		id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
				name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
				<?php if ($_smarty_tpl->getVariable('value')->value){?>
	      			value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
	      		<?php }else{ ?>
	      			placeholder="Votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
				<?php }?>
				pattern="([a-zA-Z0-9\$@*#]{8,15})"
			/><span class="add-on"><i class="icon-lock"></i></span><em></em>
	    </div>
	    <?php if ($_smarty_tpl->getVariable('need_validation')->value){?>
		<input
	   		type="password"
			id="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
"
			name="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
"
			<?php if ($_smarty_tpl->getVariable('value')->value){?>
				value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
        	<?php }else{ ?>
				placeholder="V&eacute;rifier votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
			<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
			onfocus="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
			oninput="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
    	/><em></em>
		<?php }?>
	</div>
</div>