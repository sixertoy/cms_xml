<?php /* Smarty version Smarty-3.0.7, created on 2011-07-02 06:35:38
         compiled from "D:\www\staytuned_v3\cache\smarties/templates/inputs/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155904e0ebc3a11a372-12236837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04e6daaf136bdcc33c4bb234204a57579a448ddb' => 
    array (
      0 => 'D:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/password.tpl',
      1 => 1309588531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155904e0ebc3a11a372-12236837',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
		onfocus="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
		oninput="validatePassword( document.getElementById( '<?php echo $_smarty_tpl->getVariable('id')->value;?>
' ), this );"
    /><em></em>
</dd>