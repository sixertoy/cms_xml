<?php /* Smarty version Smarty-3.0.7, created on 2011-06-27 14:44:32
         compiled from "E:\www\staytuned_v3\cache\smarties/templates/inputs/checkbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:255034e0897501d80e1-00407425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '735c4173f7273bff6adb2c0581b5ca6deb5c5f9d' => 
    array (
      0 => 'E:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/checkbox.tpl',
      1 => 1309111326,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255034e0897501d80e1-00407425',
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
			type="checkbox"
			id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
            <?php if ($_smarty_tpl->getVariable('checked')->value){?>checked="checked" <?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
		/><em></em>
	</dd>
	<hr class="clear" />
</dl>