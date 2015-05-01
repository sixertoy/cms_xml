$( function(){
        /*
        $( "#debug-title" ).click( function()
        {
            $( this ).parent().parent().children( "#debug-content" ).toggle();
        });
        $( "#debug-content" ).toggle();      
        */
        $( "#debug-content" ).tabs();
        $( "#debugger" ).draggable( { cancel:"#debug-title" } );
        $( "#debug-content" ).removeClass( "ui-corner-all ui-widget-content" )
        .children( "ul" ).removeClass( "ui-corner-all ui-widget-header" )
        .children( "li" ).removeClass( "ui-corner-top" );
} );