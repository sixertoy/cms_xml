<?php /* Smarty version Smarty-3.0.7, created on 2011-07-02 06:39:55
         compiled from "D:\www\staytuned_v3\cache\smarties/templates/inputs/abstract.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128394e0ebd3bcd5d03-60691728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ab0756c5168c84dc9a6732621ef5094e394ddda' => 
    array (
      0 => 'D:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/abstract.tpl',
      1 => 1309588636,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128394e0ebd3bcd5d03-60691728',
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