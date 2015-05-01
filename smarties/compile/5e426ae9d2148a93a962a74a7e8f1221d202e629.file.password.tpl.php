<?php /* Smarty version Smarty-3.0.7, created on 2013-10-27 08:01:49
         compiled from "smarties/templates/inputs/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31555526cc86dc9d121-31911428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e426ae9d2148a93a962a74a7e8f1221d202e629' => 
    array (
      0 => 'smarties/templates/inputs/password.tpl',
      1 => 1376648163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31555526cc86dc9d121-31911428',
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
		<?php if ($_smarty_tpl->getVariable('required')->value){?><em>*</em><?php }?>
		<?php if ($_smarty_tpl->getVariable('description')->value){?><br><i><?php echo $_smarty_tpl->getVariable('description')->value;?>
</i><?php }?>
	</label>
	<div class="controls">
		<div class="input-append">
			<input type="password" id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
                 pattern="([a-zA-Z0-9\$@*#]{8,15})"
				<?php if ($_smarty_tpl->getVariable('value')->value){?> value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
	      		<?php }else{ ?> placeholder="Votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
				<?php }?>
			/><span class="add-on"><i class="icon-lock"></i></span>
	    </div>
	    <?php if ($_smarty_tpl->getVariable('need_validation')->value){?>
		<input type="password" id="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
" name="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
"
            <?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
            <?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
			<?php if ($_smarty_tpl->getVariable('value')->value){?> value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
        	<?php }else{ ?> placeholder="V&eacute;rifier votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
			<?php }?>
			onfocus="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
			oninput="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
    	/>
		<?php }?>
	</div>
</div>