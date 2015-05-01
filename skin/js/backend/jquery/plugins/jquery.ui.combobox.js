/**
 * jQuery UI Combobox @0.0.1
 * Copyright 2011, Matthieu Lassalvy (http://www.bluemagic.fr)
 * 
 * http://jqueryui.com/demos/autocomplete/#event-search
 * 
 */
( function( $ )
{
$.widget( "ui.combobox",
{
	options:
	{
		label:null,
		select:null, // event
		change:null, // event
		pagination:null,
		values:[ "5", "10", "20", "25", "30" ]
	},
	_create: function()
	{
		var self = this;
		this.element.attr( "role", "combobox" );
		var select = this.element.hide();
		var selected = select.children( ":selected" );
		var value = ( selected.val() ) ? selected.text() : "";
		//
		this.input = $( "<input>" ).insertAfter( select ).val( value ).addClass( "ui-widget ui-widget-content  ui-state-default ui-corner-left ui-button-combobox" )
		.autocomplete(
		{
			delay:0,minLength:0,
			source:function( request, response )
			{
				response( select.children( "option" ).map(function()
				{
					var object = { label:$( this ).text(), value:$( this ).text(), option:this }; 
					return object;					
				}));
			},
			select:function( pEvent, pUi )
			{
				pUi.item.option.selected = true;
				self._trigger( ".selected", pEvent, $( pUi.item ).val() );
			},
			change:function( pEvent, pUi ){ self._trigger( ".changed", pEvent, $( self.input ).val() ); }
		}).attr( "disabled", true );
		//
		this.input.data( "autocomplete" )._renderItem = function( pUl, pItem )
		{
			var element = $( "<li></li>" ).data( "item.autocomplete", pItem ).append( "<a>" + pItem.label + "</a>" ).appendTo( pUl ); 
			return element; 
		};
		//
		this.button = $( "<button type='button'>&nbsp;</button>" ).attr( "tabIndex", -1 ).attr( "title", "Show All Items" )
		.insertAfter( this.input ).button({icons:{primary: "ui-icon-triangle-1-s"},text: false})
		.removeClass( "ui-corner-all" ).addClass( "ui-corner-right ui-button-icon" )
		this.button.click(function()
		{
			// close if already visible
			if ( self.input.autocomplete( "widget" ).is( ":visible" ) )
			{
				self.input.autocomplete( "close" );
				return;
			}
			// pass empty string as value to search for, displaying all results
			self.input.autocomplete( "search", "" );
			self.input.focus();
		});
		// Events
		if( this.options.select != null ) $( this.element ).bind( "combobox.selected", this.options.select );
		if( this.options.change != null ) $( this.element ).bind( "combobox.changed", this.options.change );
	},
	refresh: function(){},
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
	},
	destroy: function()
	{
		this.input.remove();
		this.button.remove();
		this.element.show();
		$.Widget.prototype.destroy.call( this );
	}
});
})( jQuery );