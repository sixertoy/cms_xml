<?php /* Smarty version Smarty-3.0.7, created on 2011-06-27 14:44:32
         compiled from "E:\www\staytuned_v3\cache\smarties/templates/inputs/abstract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:269424e08975006bea6-19941859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '547acf12941608dd2787675407c4fdbf2832afcd' => 
    array (
      0 => 'E:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/abstract.tpl',
      1 => 1308996678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269424e08975006bea6-19941859',
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
			type="<?php echo $_smarty_tpl->getVariable('type')->value;?>
"
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
		/><em></em>
	</dd>
	<hr class="clear" />
</dl>