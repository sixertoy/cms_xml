(function($,undefined)
{

var lastActive,
wrapperClasses = "ui-element-wrapper";
	wrappedClasses = "ui-element-wrapped";
	stateClasses = "ui-state-hover ui-state-active",
	baseClasses = "ui-widget ui-button ui-state-default ui-corner-all";
$.widget( "ui.fileuploader",
{
	options:
	{
		service:"",
		label:"&nbsp;S&eacute;lectionner&nbsp;",
	},
	_init: function() { this.refresh(); },
	widget:function(){ return this.inputElement; },
	/**
	 * Constructeur de la checkbox
	 */
	_create: function()
	{
		var self = this;
		this.wrapperForm = $( "<div>" ).addClass( wrapperClasses )/*.attr( "method", "post" ).attr( "enctype", "multipart/form-data" )
		.attr( "action", "index/update/getuploadfile" ).attr( "target", "upload-iframe" );*/
		this.element.wrap( this.wrapperForm );
		//
		this.fileinput = $( '<input type="text">' ).insertBefore( this.element ).attr( "disabled", "disabled" ).addClass(  "ui-widget ui-state-hover ui-corner-all" );
		this.filebutton = $( "<span>" + this.options.label + "</span>" ).insertAfter( this.fileinput ).addClass( baseClasses );
		// Element
		this.element.attr( "role", "fileuploader" ).addClass( wrappedClasses );
        if( $.browser.mozilla )
        {
            if( /Win/.test( navigator.platform ) ) this.element.css("margin-left", "-142px");                    
            else this.element.css( "margin-left", "-168px" );
        }else this.element.css( "margin-left", "-205px" );
        this.element.bind( "change", function()
        {
        	self.fileinput.val( $( this ).val() );
//        	self._startUpload();
        	return false;
        });
        /*
        // ProgressBar
        this.progressBar = $( "<div>" ).insertAfter( this.filebutton ).hide();
        // iFrame
        this.uploadFrame = $( "<iframe></iframe>" ).css( { "width":"0", "height":"0", "border":"0" } ).insertAfter( this.progressBar )
        .attr( "id", "upload-iframe" ).attr( "name", "upload-iframe" ).attr( "src", "#" );
        */
	},
	/**
	 * 
	 */
	/*
	_startUpload:function()
	{
//		$( this.progressBar ).show();
//		$( this.progressBar ).progressbar( { value:50 } );
//		$( this.wrapperForm ).submit();
	},
	_stopUpload:function( pSucess )
	{
		var result = "";
		if( pSucess )
		{
//			 $( this.progressBar ).hide();
		}
		else
		{
//			 $( this.progressBar ).progressbar( { value:50 } );			
		}
	},
	*/
	/**
	 * 
	 */
	_setOption: function( key, value ){ $.Widget.prototype._setOption.apply( this, arguments ); },
	destroy: function()
	{
		this.fileinput.remove();
		this.filebutton.remove();
		this.element.removeClass( wrappedClasses ).unwrap( this.wrapperForm );
		this.wrapperForm.remove();
		$.Widget.prototype.destroy.call( this );
	},
	/**
	 * 
	 */
	reset: function() { this.fileinput.text( "" ); },
	getValue: function(){ return this.element.val(); },
	refresh: function(){}
});
}( jQuery ) );