( function( $ )
{
    $.widget( "ui.combobox",
    {
        _create: function()
        {
			var self = this,
			select = this.element.hide(),
			selected = select.children( ":selected" ),
			value = ( ( selected.val() ) ? selected.text() : "" );
			//
			var input = this.input = $( "<input>" ).insertAfter( select ).val( value ).autocomplete
			( {
                delay:0,
                minLength:0,
                //
                source: function( request, response )
                {
					response( select.children( "option" ).map( function()
                    {
                        var text = $( this ).text();
                        return { option:this,value:text,label:text };
                    } ) );
                },
                //
                select: function( event, ui )
                {
                    if( ui.item != null )
                    {
					    ui.item.option.selected = true;
			    	    self._trigger( "selected", event, { item:ui.item.option } );
                    }
                },
                //
                change: function( event, ui )
                {
                    if( ui.item != null )
                    {
			    	    self._trigger( "changed", event, { item:ui.item.option } );
			    	}
                }
			} ).addClass( "ui-widget ui-widget-content ui-corner-left ui-combobox-input" );
			//
			input.data( "autocomplete" )._renderItem = function( ul, item )
		    {
			    return $( "<li></li>" )
			    .data( "item.autocomplete", item )
			    .append( '<a>' + item.label + '</a>' )
			    .appendTo( ul );
		    };
		    //
            this.button = $( "<button>&nbsp;</button>" ).attr( "tabIndex", -1 ).attr( "title", "Show All Items" )
            .insertAfter( input ).button( { icons:{ primary: "ui-icon-triangle-1-s" }, text: false } ).removeClass( "ui-corner-all" )
            .addClass( "ui-corner-right ui-button-icon" ).click( function() // close if already visible
            {
                if ( input.autocomplete( "widget" ).is( ":visible" ) )
                {
				    input.autocomplete( "close" );
					return false;
                }				
				input.autocomplete( "search", "" ); // pass empty string as value to search for, displaying all results
			    input.focus();
			    return false;
            } );
        },
        //
        destroy: function()
        {
			this.input.remove();
			this.button.remove();
			this.element.show();
			$.Widget.prototype.destroy.call( this );
        }        
    } )
} )( jQuery );
/*                
change: function( event, ui )
{
	if ( !ui.item )
	{   
		var matcher = new RegExp( "^"+$.ui.autocomplete.escapeRegex( $(this).val() )+"$", "i" ), valid = false;
		select.children( "option" ).each( function()
		{
		    if( $( this ).text().match( matcher ) ) { this.selected = valid = true; return false; }
	    } );
    }
	if( !valid ) // remove invalid value, as it didn't match anything
	{						
		$( this ).val( "" );
		select.val( "" );
		input.data( "autocomplete" ).term = "";
	    return false;
    }
}
*/
/*
source: function( request, response )
{
	response( select.children( "option" ).map( function()
    {
        var text = $( this ).text();
        if ( this.value && ( !request.term || matcher.test( text ) ) ) var lab = text.replace( new RegExp("(?![^&;]+;)(?!<[^<>]*)("+$.ui.autocomplete.escapeRegex(request.term)+")(?![^<>]*>)(?![^&;]+;)","gi" ) ,"<strong>$1</strong>" ),
        return { option:this,value:text,label:text };
    } ) );
},
*/