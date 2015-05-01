<?php /* Smarty version Smarty-3.0.7, created on 2011-06-29 15:58:00
         compiled from "E:\www\staytuned_v3\cache\smarties/templates/inputs/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:301694e0b4b881c8be1-38061802%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9ed73f9045e9c0a3cc4495d04ab1fd9af4a18cf' => 
    array (
      0 => 'E:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/password.tpl',
      1 => 1309363078,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301694e0b4b881c8be1-38061802',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<dl>
	<dt>
        <?php if ($_smarty_tpl->getVariable('label')->value){?>
        <label for="<?php echo $_smarty_tpl->getVariable('id')->value;?>
">
            <b><?php echo $_smarty_tpl->getVariable('label')->value;?>
</b>
            <?php if ($_smarty_tpl->getVariable('description')->value){?>
            <br><i><?php echo $_smarty_tpl->getVariable('description')->value;?>
</i>
            <?php }?>
        </label>
        <?php }?>
    </dt>
	<dd>
		<input
			type="password"
			name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			<?php if ($_smarty_tpl->getVariable('value')->value){?>
			value="<?php echo $_smarty_tpl->getVariable('value')->value;?>
"
			<?php }else{ ?>
			placeholder="Votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
			<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
			pattern="([a-zA-Z0-9\$@*#]{8,15})"
		/><em></em>
		<br>
		<input
			type="password"
			name="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
"
			id="<?php echo ($_smarty_tpl->getVariable('id')->value).('-valid');?>
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
			onfocus="validatePass( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
			oninput="validatePass( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
		/><em></em>
	</dd>
	<hr class="clear" />
</dl>