
	var datagridTable;
	/**
	 *
	 */
	function onDeleteSucess( pResponseText, pStatusText, pXHR, pForm )
	{
		if( pResponseText == pStatusText )
		{
			var tbody = $( "#datagrid-tbody" );
			var index = $( "#current-hidden-row-index" ).val();
			var row = $( tbody ).find( "tr:eq(" + index + ")" );
			$( row ).fadeTo( 400, 0, function () { $( this ).remove(); }); // Suprime la ligne
			$( row ).nextAll( "tr" ).toggleClass( "alternate-row" ); // Mise a jour de la couleur des lignes
			if( ( $( tbody ).find( "tr" ).length - 1 ) <= 0 ) window.location = "<?php echo $this->currentController; ?>/insert"; // Si toutes les lignes sont effacees on redirige vers la page d'ajout
			else $( "#dialog-waiting" ).dialog( "close" );
			$( "#datagrid-pagination" ).tablepagination( "refresh" );
		}else onDeleteError( null );
	}
	/**
	 *
	 */
	function onDeleteError( pEvent )
	{
		$( "#dialog-waiting" ).dialog( "close" );
		$( "#dialog-fail" ).dialog( "open" );
	}
	/**
	 * Initialization des boites de dialogue
	 */
	$( function()
	{
		$( "#dialog-fail" ).dialog({ height:200,modal:true,draggable:false,resizable:false,autoOpen:false });
		$( "#dialog-waiting" ).dialog({ height:200,modal:true,draggable:false,resizable:false,autoOpen:false });
		$( "#dialog-confirm" ).dialog({ height:200,modal:true,draggable:false,resizable:false,autoOpen:false,buttons:{"Annuler": function() { $( this ).dialog( "close" ); },"Supprimer":deleteEntryConfirm} });
				
	});
	/**
	 * Affecte/Enregistre l'id a effacer
	 * Ouvre la boite de dialogue
	 */
	function removeEntry( pIndex, pId )
	{
		$( "#current-hidden-id" ).val( pId );
		$( "#current-hidden-row-index" ).val( pIndex );
		$( "#dialog-confirm" ).dialog( "open" );
	}
	/**
	 *
	 */
	function onPageSizeChange( pEvent, pValue )
	{
		$( "#datagrid-pagination" ).tablepagination( "updatePageSize", pValue );
	}
	/**
	 *
	 */
	function deleteEntryConfirm()
	{
		$( "#dialog-waiting" ).dialog( "open" );
		var id = $( "#current-hidden-id" ).val();
		$( "#mainform" ).ajaxSubmit(
		{
         	type: "post",
          	url:( "<?php echo $this->currentController; ?>/getdelete/" + id ),
          	error:onDeleteError,
          	success:onDeleteSucess,
          	beforeSubmit:function(){}
   		} );
		$( this ).dialog( "close" );
	}
	/**
	 *
	 */
	function setCheckAll()
	{
		var isChecked = $( "#datagrid-item_checkall" ).checkbox( "isChecked" );
		$( "#datagrid-tbody" ).find( "input[type=checkbox]" ).checkbox( ( ( isChecked ) ? "check" : "uncheck" ) );
	}

$(function()
{
	$( "input[type=checkbox]" ).checkbox();
	$( ".new-entry" ).button( { icons:{ primary:"ui-icon-circle-plus" } } );
	$( "#datagrid-item_checkall" ).click( function(){ setCheckAll(); } );
	$( "#datagrid-pagination-select" ).combobox( { select:onPageSizeChange } );
	$( "#datagrid-pagination" ).tablepagination( { table:$( "#datagrid-table" ) } );
	$( "#datagrid-filter-input" ).datagridfilter( { targetBody:$( "#datagrid-tbody" ) } );
});