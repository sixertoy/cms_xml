<?php
namespace Pure\Install\Blocks;

use Pure\Interfaces\IAsynchronous;
use Pure\Abstracts\AbstractAsynchronous;
use Bluemagic\Core\Debug;

class InstallAsync extends AbstractAsynchronous implements IAsynchronous
{   
	public function ajax()
	{
		$service = $this->getAsyncURL();
		
		Debug::trace( "Appel du service AJAX -> ".$service, Debug::INFO );
		
		echo $service;
		
		?>
		<script type="text/javascript">
		//<![CDATA[
		jQuery( document ).ready( function ()
		{
			// ?view=install&async=1&action=installAsync
			var ajax = jQuery.ajax( "<?php echo $service; ?>" )
    		.fail( function( response ){ alert( "Call ajax fail" ); } )
    	    .done( function( response )
            {
    	    	response = jQuery.parseJSON( response );
                var result = ( eval( response.result ) == true );
                if( !result )
                {
                	message = '<div class="alert alert-error"><ul><li>'+response.message+'</li></ul></div>';
                	jQuery( jQuery( ".notifications" ).get( 0 ) ).html( message );
				}
                else document.location.href = "<?php echo $this->getSuccessResponse(); ?>";
	    	});
		});
		//]]>
		</script>
		<?php
	}
}