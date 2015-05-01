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
var lastActive,
	stateClasses = "ui-state-hover ui-state-active",
	typeClasses = "ui-button-icon-only ui-button-text-icon-primary",
	baseClasses = "ui-widget ui-button ui-state-default ui-corner-all ui-checkbox";
$.widget( "ui.checkbox",
{
	options:
	{
		label:null,
		disabled:null,
		iconOnly:true,
		icon:"ui-icon-check"
	},
	_init: function() { this.refresh(); },
	widget:function(){ return this.checkboxElement; },	
	/**
	 * Constructeur de la checkbox
	 */
	_create: function()
	{
		if( typeof this.options.disabled !== "boolean" ) this.options.disabled = this.element.attr( "disabled" );		
		this._initCheckboxType(); // Initialization de la checkbox		
		//{ On considere qu'une checkbox n'a pas de titre
		// this.hasTitle = !!this.checkboxElement.attr( "title" );
		//}		
		var self = this;
		var toggleButton = true;
		var options = this.options;
		var hoverClass = "ui-state-hover";
		var focusClass = "ui-state-focus";
		//{ On considere qu'une checkbox aura toujours un label
		// options.label = this.checkboxElement.html();
		if( options.label === null ) options.label = this.checkboxElement.html();
		//}		
		// verifie si l'element est actif
		if( this.element.is( ":disabled" ) ) options.disabled = true;
		// var bases = "ui-button ui-widget ui-state-default ui-corner-all ui-checkbox";
		this.checkboxElement.addClass( baseClasses );		
		// On definit le type de comportement des checkbox sur le label
		// MouseOver, MouseOut, Click, Focus(tabulation), Blur
		this.checkboxElement.attr( "role", "checkbox" );		
		// Mouse over
		this.checkboxElement.bind( "mouseenter.checkbox", function() // MouseOver
		{
			if ( options.disabled )return;// Si desactive on arrete le traitement
			$( this ).addClass( "ui-state-hover" ); // Style du border, background, color, graisse			
			// if( this === lastActive ) $( this ).addClass( "ui-state-active" ); // Etat precedent du de la checkbox
		}).bind( "mouseleave.checkbox", function() // MouseOut
		{
			if ( options.disabled ) return;
			$( this ).removeClass( hoverClass );
		})
		.bind( "focus.checkbox", function(){$( this ).addClass( focusClass ); }) // Focus
		.bind( "blur.checkbox", function(){ $( this ).removeClass( focusClass ); }); // Blur/unfocused		
		// { On considere que l'element est de type "toggle"
		this.element.bind( "change.checkbox", function(){ self.refresh(); } );
		// Click sur la checkbox
		this.checkboxElement.bind( "click.checkbox", function()
		{
			if ( options.disabled ) return false;
			$( this ).toggleClass( "ui-state-active" );
			self.iconElement.toggleClass( "ui-icon " + self.options.icon );
			self.checkboxElement.attr( "aria-pressed", self.element[ 0 ].checked );
		});
		this._setOption( "disabled", options.disabled );
		// Si l'element est de type "reset" ???
		// this.element.closest( "form" ).unbind( "reset.button" ).bind( "reset.button", formResetHandler );>
	},
	/**
	 * Definition graphique du type "checkbox"
	 * La checkbox est créée dans le label
	 */
	_initCheckboxType: function()
	{
		this.type = "checkbox";		
		// !!!!!!!!!!!!!!!!!TODO!!!!!!!!!!!!!!!!!!!!!		
		// Pour les AbstractInput du framework PHP
		// Solution passé par un decorateur PHP ???
		// var hasClassFormInput = this.element.parent().hasClass( "form-input" );
		// if( hasClassFormInput ){ this.checkboxElement = this.element.parent( "span" ).get( 0 ); }
		// !!!!!!!!!!!!!!!!!TODO!!!!!!!!!!!!!!!!!!!!!
		this.checkboxElement = this.element.parents().last().find( "label[for=" + this.element.attr( "id" ) + "]" );
		this.element.addClass( "ui-helper-hidden-accessible" ); // On ajoute la classe de qui permet de cacher l'input
		//
		var checked = this.element.is( ":checked" );// Si l'element est coche
		if ( checked ) this.checkboxElement.addClass( "ui-state-active" );// Si coche on ajoute la classe active	
		this.checkboxElement.attr( "aria-pressed", checked );
	},
	/**
	 *
	 */
	destroy: function()
	{
		this.element.removeClass( "ui-helper-hidden-accessible" );
		this.checkboxElement.removeClass( baseClasses + " " + stateClasses + " " + typeClasses );
		this.checkboxElement.removeAttr( "role" ).removeAttr( "aria-pressed" ).html( this.checkboxElement.find(".ui-button-text").html() );
		// if ( !this.hasTitle ) this.checkboxElement.removeAttr( "title" );
		$.Widget.prototype.destroy.call( this );
	},
	/**
	 * On active l'option disabled sur la checkbox
	 * Permet de le rendre accessible depuis le constructeur
	 */
	_setOption: function( key, value )
	{
		$.Widget.prototype._setOption.apply( this, arguments );
		if ( key === "disabled" )
		{
			if ( value ) this.element.attr( "disabled", true );
			else this.element.removeAttr( "disabled" );
		}
		this._resetButton();
	},
	/**
	 *
	 */
	refresh: function()
	{
		var isDisabled = this.element.is( ":disabled" );
		if ( isDisabled !== this.options.disabled ) this._setOption( "disabled", isDisabled );
		var checked = this.element.is( ":checked" );// Si l'element est coche
		if( checked )this.checkboxElement.addClass( "ui-state-active" ).attr( "aria-pressed", true );
		else this.checkboxElement.removeClass( "ui-state-active" ).attr( "aria-pressed", false );
		if ( checked ) this.iconElement.addClass( "ui-icon " + this.options.icon );
		else this.iconElement.removeClass( "ui-icon " + this.options.icon );
	},
	isChecked:function(){ return this.element.is( ":checked" ); },
	check:function()
	{
		this.element.attr( "checked", true );
		this.refresh();
	},
	uncheck:function()
	{
		this.element.attr( "checked", false );
		this.refresh();
	},
	/**
	 * Init de la skin des checkbox
	 */
	_resetButton: function()
	{
		var buttonElement = this.checkboxElement.removeClass( typeClasses );	
		buttonElement.addClass( "ui-button-text-icon-primary" );
		// Ajout du span du texte dans le label
		var buttonText = $( "<span></span>" ).addClass( "ui-button-text" )
		.html( this.options.label ).appendTo( this.checkboxElement.empty() ).text(); // Ecrit le contenu
		this.iconElement = $( "<span></span>" ).addClass( "ui-button-icon-primary" ).appendTo( this.checkboxElement );
		// On cache le texte
		if( this.options.iconOnly )
		{				
			buttonElement.addClass( "ui-button-icon-only" ); // Cache le texte et cente l'icone
			buttonElement.removeClass( "ui-button-text-icon-primary" );
		}
		// buttonElement.attr( "title", buttonText );
		//{
		// buttonElement.addClass( "ui-button-text-icon" );
		// buttonElement.addClass( "ui-button-text-only" ); // Ajoute le padding necessaire au texte
		// buttonElement.removeClass( "ui-button-text-icon ui-button-text-icon-secondary" );
		//}
	}
});

}( jQuery ) );
