/**
 * jQuery UI Combobox @0.0.1
 * Copyright 2011, Matthieu Lassalvy (http://www.bluemagic.fr)
 * 
 * http://jqueryui.com/demos/autocomplete/#event-search
 * 
 */
( function( $ )
{
$.widget( "simpletabs",
{
	options:{},
	_create: function()
	{
        var self = this;
        this.element.attr( "role", "simpletabs" );
        var tabs = $( this ).children( "li" ).each( function()
        {
            $( this ).click( function()
            {
                alert( "click" );
            });
        });
	},
	refresh: function(){},
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
	},
	destroy: function()
	{
		$.Widget.prototype.destroy.call( this );
	}
});
})( jQuery );