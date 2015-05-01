// http://www.emirplicanic.com/javascript/cross-browser-textarea-editor.php
(function( $, undefined )
{
$.widget( "ui.editor",
{
	options:{},
	_init: function() { this.refresh(); },
	widget:function(){ return this.checkboxElement; },
	_create: function(){},
	destroy: function(){},
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
	},
	refresh: function(){}	
});
}( jQuery ) );