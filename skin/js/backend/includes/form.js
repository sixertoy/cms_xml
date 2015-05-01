$(function()
{
	// $( "input[type=checkbox]" ).checkbox( { iconOnly:false }); // @TODO - bug a l'affichage jqueryui
    $( ".texteditor" ).wysiwyg( { css:"skin/css/jquery/jquery.ueditorcontent.css" }  );
});

function validatePass( pValue, pConfirm )
{ 
    var value = jQuery.trim( $( pValue ).val() );
	var confirmPass = document.getElementById( pConfirm );
	var confirm = jQuery.trim( $( confirmPass ).val() );
    if( ( value != confirm ) || confirm == "" || value == "" ) $( confirmPass ).setCustomValidity( "Password incorrect" );
    else $( confirmPass ).setCustomValidity( "" );
}
    
    
    /*************************************************************************************/
	/* Initializations */
	/*************************************************************************************/
    /*
	$(function()
	{
		$( "#stepper-tabs" ).tabs();
	});
    */
	/*************************************************************************************/
	/* Functions */
	/*************************************************************************************/
    /*
    */
	//<![CDATA[
	/**
	 * Ajoute une ligne d'un groupe clonable
	 *
	 */
     /*
	function addCloneRow( pEvent )
	{
		var cloneIndex = ( pEvent.data.index + 1 );
		var trigger = $( pEvent.target ).unbind( "click" );
		var holder = trigger.parent( "div" ).parent( "fieldset" );
		var clonable = $( trigger.parent( "div" ) ).clone();

		$( clonable ).find( ":input" ).each( function(){ alert( $( this ).val( "" ) ); } );
				
		var cloneId =  $( clonable ).attr( "id" ).replace( /(\d+)/, cloneIndex );
		$( clonable ).attr( "id", cloneId );
		$( clonable ).appendTo( holder );

		var triggerId =  $( trigger ).attr( "id" ).replace( /(\d+)/, cloneIndex );
		var cloneTrigger = $( $( clonable ).find( ".button" )[ 0 ] ); 
		$( cloneTrigger ).attr( "id", triggerId );
		$( cloneTrigger ).bind( "click",  { index:cloneIndex }, addCloneRow );
		
		$( trigger ).html( "-" ).unbind( "click" );
		$( trigger ).bind( "click", removeCloneRow );
		return false;
	}
    */
	/**
	 * Supprime une ligne d''un groupe clonable
	 *
	 */
     /*
	function removeCloneRow( pEvent )
	{
		var trigger = $( pEvent.target ).unbind( "click" );
		var holder = trigger.parent( "div" );
		$( holder ).remove();
		return false;
	}
    */