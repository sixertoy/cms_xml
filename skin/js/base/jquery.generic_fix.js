/*
 * Functions decoratrices HTML
 */
jQuery( document ).ready( function ()
{
    
    // IE7 z-index Fix
    var zIndexNumber = 1000;
    jQuery( "div" ).each( function()
    {
        jQuery( this ).css( "zIndex", zIndexNumber );
        zIndexNumber -= 10;
    });

    // First/Last class on table and child list elements
    jQuery( "li:last-child, td:last-child, tr:last-child, th:last-child" ).addClass( "last" );
    jQuery( "li:first-child, td:first-child, tr:first-child, th:first-child" ).addClass( "first" );
    // Odd and Even Table
    if( !jQuery( "table" ).length ) return false;
    jQuery( "table" ).each( function( index, item )
    {
        if( !jQuery( "table" ).hasClass( "smart-table" ) )
        {
            jQuery( item ).find( "tbody tr" ).each( function( ind, itm )
            {
                if( ind % 2 ) jQuery( itm ).addClass( "odd" );
                else jQuery( itm ).addClass( "even" );
            });
        }
    });

});