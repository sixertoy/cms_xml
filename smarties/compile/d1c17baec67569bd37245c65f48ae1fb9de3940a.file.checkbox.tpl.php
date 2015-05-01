<?php /* Smarty version Smarty-3.0.7, created on 2011-06-26 18:02:10
         compiled from "D:\www\staytuned_v3\cache\smarties/templates/inputs/checkbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135114e077422202416-99383847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1c17baec67569bd37245c65f48ae1fb9de3940a' => 
    array (
      0 => 'D:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/checkbox.tpl',
      1 => 1309111326,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135114e077422202416-99383847',
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