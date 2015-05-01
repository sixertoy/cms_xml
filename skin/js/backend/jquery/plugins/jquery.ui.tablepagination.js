/*
 * jQuery UI Checkbox @0.0.2
 *
 * Copyright 2011, Matthieu Lassalvy (http://www.bluemagic.fr)
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */
(function( $, undefined )
{
	var typeClasses = "";
	var baseClasses = "";
	var stateClasses = "";
$.widget( "ui.tablepagination",{
	options:
	{
		current:1,
		table:null,
		ignoreRows:[],
		itemPerPage:5,
		pagesizer:null,
		optionsForRows:[ 5, 10, 25, 50, 100 ]
	},
	_init: function() { this.refresh(); },
	widget:function(){ return this.pagerElement; },
	/**
	 * Creation des elements graphiques
	 * Initialization des comportements des boutons
	 */
	_create: function()
	{
		this._itemPerPage = this.options.itemPerPage;
		
		var self = this;
		this.buttonSet = [];
		var icons = [ "stop-1-w","-1-w","-1-e","stop-1-e"];
		for( var i = 0; i < icons.length; i++ )
		{
			var opt = { text:false, icons:{ primary:( "ui-icon-arrowthick" + icons[ i ] ) } };
			var button = $( "<button></button>" ).button( opt ).addClass( "ui-pagination" ).appendTo( this.element );		
			this.buttonSet.push( button );
		}
		//
		this.element.attr( "role", "tablepagination" );
		$( this.buttonSet[ 0 ] ).bind( "click.tablepagination", function(){ return self._gotoPageAt( 1 ); });			
		$( this.buttonSet[ 1 ] ).bind( "click.tablepagination", function(){ return self._gotoPageAt( self._currentPage - 1 ) });      
		$( this.buttonSet[ 2 ] ).bind( "click.tablepagination", function(){ return self._gotoPageAt( self._currentPage + 1 ) });      
		$( this.buttonSet[ 3 ] ).bind( "click.tablepagination", function(){ return self._gotoPageAt( self._totalPages ) });
		//
		if( this.options.pagesizer != null )
		{
			$( this.options.pagesizer ).bind( "combobox.selected", function()
			{
				alert( "combobox.selected" );
			});
		}
		/*
		$( currPageId ).bind( 'change', function(){ _gotoPageAt( this.value ) });      
		$( rowsPerPageId ).bind( 'change', function()
		{
			defaults.itemPerPage = parseInt( this.value, 10 );
			totalPages = resetTotalPages();
			_gotoPageAt( 1 )
		});
		*/
		
		// this.checkboxElement = this.element.parents().last().find( "label[for=" + this.element.attr( "id" ) + "]" );
		
		
	},
	updatePageSize:function( pValue )
	{
		this._itemPerPage = pValue;
		this.refresh();
	},
	/**
	 *
	 */
	_resetPerPageValues:function()
	{	
		/*
		var isRowsPerPageMatched = false;
		var optsPerPage = defaults.optionsForRows;
		optsPerPage.sort(function (a,b){return a - b;});
		var perPageDropdown = $(rowsPerPageId)[0];
		perPageDropdown.length = 0;
		for (var i=0;i<optsPerPage.length;i++)
		{
			if (optsPerPage[i] == defaults.itemPerPage)
			{
				perPageDropdown.options[i] = new Option(optsPerPage[i], optsPerPage[i], true, true);
				isRowsPerPageMatched = true;
			}
			else
			{
				perPageDropdown.options[i] = new Option(optsPerPage[i], optsPerPage[i]);
			}
		}
		if (!isRowsPerPageMatched)
		{
			defaults.optionsForRows == optsPerPage[0];
		}
		*/
	},
	/**
	 *
	 */
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
	},	
	/**
	 *
	 */
	_gotoPageAt:function( pIndex )
	{
		var isNotRange = ( ( pIndex < 1 ) || ( pIndex > this._totalPages ) );
		if( !isNotRange )
		{
			this._currentPage = pIndex;
			this._setPagesVisibility( pIndex );
			this._setButtonVisibility( pIndex ); // Desactive les boutons
			// $( currPageId ).val( pIndex );
		}
		return false;
	},
	/**
	 * 
	 */
	_setButtonVisibility:function( pIndex )
	{
		$( this.buttonSet[ 0 ] ).attr( "disabled", ( ( pIndex == 1 ) ? "disabled" : "" ) );
		$( this.buttonSet[ 1 ] ).attr( "disabled", ( ( pIndex == 1 ) ? "disabled" : "" ) );
		if( pIndex == 1 )
		{
			$( this.buttonSet[ 0 ] ).addClass( "ui-state-disabled" ).removeClass( "ui-state-focus ui-state-hover" );
			$( this.buttonSet[ 1 ] ).addClass( "ui-state-disabled" ).removeClass( "ui-state-focus ui-state-hover" );
		}
		else
		{
			$( this.buttonSet[ 0 ] ).removeClass( "ui-state-disabled" );
			$( this.buttonSet[ 1 ] ).removeClass( "ui-state-disabled" );
		}
		//
		$( this.buttonSet[ 2 ] ).attr( "disabled", ( ( pIndex == this._totalPages ) ? "disabled" : "" ) );
		$( this.buttonSet[ 3 ] ).attr( "disabled", ( ( pIndex == this._totalPages ) ? "disabled" : "" ) );
		if( pIndex == this._totalPages )
		{
			$( this.buttonSet[ 2 ] ).addClass( "ui-state-disabled" ).removeClass( "ui-state-focus ui-state-hover" );
			$( this.buttonSet[ 3 ] ).addClass( "ui-state-disabled" ).removeClass( "ui-state-focus ui-state-hover" );
		}
		else
		{
			$( this.buttonSet[ 2 ] ).removeClass( "ui-state-disabled" );
			$( this.buttonSet[ 3 ] ).removeClass( "ui-state-disabled" );
		}
	},
	/**
	 *
	 */
	_setPagesVisibility:function( pIndex )
	{
		var isNotRange = ( ( pIndex == 0 ) || ( pIndex > this._totalPages ) );
		if( !isNotRange )
		{
			var startIndex = ( pIndex - 1 ) * this._itemPerPage;
			var endIndex = ( startIndex + this._itemPerPage - 1 );
			$( this._tableRows ).show();
			for( var i = 0;i < this._tableRows.length; i++ )
			{
				if( i < startIndex || i > endIndex ) $( this._tableRows[ i ] ).hide();
			}
		}
		return false;
	},
	/**
	 * Mise a jour de la page courante
	 * Mise a jour du nombre total de pages
	 *
	 * @return	Number - le nombre total de pages
	 */
	refresh:function()
	{
		var self = this;
		this._tableRows = $( this.options.table ).find( "tbody" ).find( "tr" );
		var count = this._tableRows.length;
		this._totalPages = Math.round( count / this._itemPerPage );
		this._totalPages += ( ( this._totalPages * this._itemPerPage ) < count ) ? 1 : 0;
		//		
		this._currentPage = this.options.current;
		if( this._currentPage > this._totalPages ) this._currentPage = 1;
		//
		this._setPagesVisibility( this._currentPage );
		this._setButtonVisibility( this._currentPage );
		return this._totalPages;
	}
});
}( jQuery ) );
 /*
(function($)
{
	$.fn.tablePagination = function( settings )
	{
			ignoreRows:[],
			
		};  
		settings = $.extend( defaults, settings );
		
		return this.each(function()
		{
			if( $.inArray( defaults.itemPerPage, defaults.optionsForRows ) == -1 )
			{
				defaults.optionsForRows.push( defaults.itemPerPage );
			}
			
            if( $( totalPagesId ).length == 0 )
			{
				$( this ).after( createPaginationElements() );
			}
			else
			{
				$('#tablePagination_currPage').val(currPageNumber);
			}
			
			resetPerPageValues();
			
			$( currPageId ).bind( 'change', function(){ resetCurrentPage( this.value ) });      
			$( rowsPerPageId ).bind( 'change', function()
			{
				defaults.itemPerPage = parseInt( this.value, 10 );
				totalPages = resetTotalPages();
				resetCurrentPage(1)
			});
		})
	};		
})(jQuery);
*/