<?php /* Smarty version Smarty-3.0.7, created on 2011-06-25 09:11:03
         compiled from "D:\www\staytuned_v3\cache\smarties/templates/inputs/textarea.tpl" */ ?>
<?php /*%%SmartyHeaderCode:280624e05a627de2537-89779394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a37e33562113ec70d9e592f280d3b9fbe1954bd' => 
    array (
      0 => 'D:\\www\\staytuned_v3\\cache\\smarties/templates/inputs/textarea.tpl',
      1 => 1308993058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '280624e05a627de2537-89779394',
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
		<textarea 
			id="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			class="texteditor"
			name="<?php echo $_smarty_tpl->getVariable('id')->value;?>
"
			cols="<?php echo $_smarty_tpl->getVariable('width')->value;?>
"
			rows="<?php echo $_smarty_tpl->getVariable('height')->value;?>
"
			<?php if (!$_smarty_tpl->getVariable('value')->value){?>
			placeholder="Votre <?php echo $_smarty_tpl->getVariable('label')->value;?>
"
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('required')->value){?>required <?php }?>
			<?php if ($_smarty_tpl->getVariable('autofocus')->value){?>autofocus <?php }?>
		>
		<?php echo $_smarty_tpl->getVariable('value')->value;?>

		</textarea>
		</dd>
		<hr class="clear" />
</dl>