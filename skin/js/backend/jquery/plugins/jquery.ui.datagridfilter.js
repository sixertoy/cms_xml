(function( $, undefined )
{
var lastActive,
	stateClasses = "ui-state-hover ui-state-active",
	typeClasses = "",
	baseClasses = "ui-widget ui-state-default ui-corner-all";
/**
 * 
 */
$.widget( "ui.datagridfilter",
{
	/**
	 * 
	 */
	options:
	{
		label:null,
		targetBody:null,
		icon:"ui-icon-check",
		usepagination:false
	},
	/**
	 * 
	 */
	_init: function() { this.refresh(); },
	widget:function(){ return this.filterFieldElement; },
	destroy: function(){ $.Widget.prototype.destroy.call( this ); },
	/**
	 * 
	 */
	_create: function()
	{
		this._initFilterField();
		//
		var self = this;
		var hoverClass = "ui-state-hover";
		//
		this.element.bind( "blur", function()
		{
			self.element.removeClass( hoverClass );
			self.element.unbind( "keyup", false );
		});
		this.element.bind( "focus", function()
		{
			self.element.addClass( hoverClass );
			self.element.bind( "keyup", function(){ self._onKeyUp(); } );
		} );
	},
	/**
	 * 
	 */
	_initFilterField:function()
	{
		var self = this;
		this.filterFieldElement = this.element.parent().addClass( "ui-searchfield" );
		this.element.addClass( "ui-widget ui-state-default ui-corner-all ui-searchfield-input" );
		//
		var buttonElement = $( "<button></button>" ).appendTo( this.filterFieldElement ).addClass( "ui-searchfield-button" );
		$( buttonElement ).button( { icons:{ primary:"ui-icon-circle-close" }, text:false } );
		$( buttonElement ).bind( 'click.datagridfilter', function(){ return self.clear(); });			
	},
	/***************************************************************************************************/
	/* */
	/***************************************************************************************************/
	/**
	 * var visibility = $( rows[ i ] ).is( ":visible" );
	 */
	_onKeyUp:function()
	{
		var matches = [];
		var unmatches = [];
		var search = this.element.val();
		if( search.length < 3 ) return this._showAllRows();
		var rows = this.options.targetBody.find( "tr" );
		var searches = search.toLowerCase().split( " " );
		for( var i = 0; i < rows.length; i++ )
		{			
			var hasWords = false;
			var columns = $( rows[ i ] ).find( "td" );
			for( var j = 1; j < ( columns.length - 1 ); j++ )
			{
				if( !hasWords )
				{
					var content = $( columns[ j ] ).text();
					hasWords = this._containsWords( searches, content );
					if( hasWords ) matches.push( rows[ i ] );
				}
			}
		}
		for( var i = 0; i < rows.length; i++ )
		{
			if( $.inArray( rows[ i ], matches ) === -1 ) $( rows[ i ] ).hide();
			else $( rows[ i ] ).show();
		}
		return ( matches.length > 0 );
	},
	/**
	 * 
	 */
	_onKeyDown:function(){},
	/**
	 * 
	 */
	_containsWords:function( pWords, pContent )
	{
		var content = pContent.toLowerCase();
		for (var i = 0; i < pWords.length; i++)
		{
			if( content.indexOf( pWords[ i ] ) === -1) return false;
		}
	    return true;
	},
	/**
	 * 
	 */
	_showAllRows:function()
	{
		var rows = this.options.targetBody.find( "tr" );
		for( var i = 0; i < rows.length; i++ ) $( rows[ i ] ).show();
		return false;
	},
	/***************************************************************************************************/
	/* */
	/***************************************************************************************************/
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
	},
	refresh: function(){},
	clear: function()
	{
		this.element.val( "" );
		this._showAllRows();
		return false;
	}
});
}( jQuery ) );