<?php
namespace Bluemagic\PHPUnit;

use PHPUnit_TextUI_TestRunner;

class HTMLResultPrinter extends PHPUnit_TextUI_TestRunner
{
	
	private $_project_name;
	
	public function projectName( $name )
	{
		$this->_project_name = $name;
	}
	
	/**
	 * echo "failures<br>";
		var_dump( $result->failures() );
		echo "skipped<br>";
		var_dump( $result->skipped() );
		echo "runTests<br>";
		var_dump( $result->count() );
		echo "time<br>";
		var_dump( $result->time() );
		echo "wasSuccessful<br>";
		var_dump( $result->wasSuccessful() );
		echo "getCodeCoverage<br>";
		var_dump( $result->getCodeCoverage() );
		//Gets the number of incomplete tests
		echo "notImplementedCount<br>";
		var_dump( $result->notImplementedCount() );
		//Returns TRUE if no incomplete test occured
		echo "allCompletlyImplemented<br>";
		var_dump( $result->allCompletlyImplemented() );
		//Returns an Enumeration for the incomplete tests
		echo "notImplemented<br>";
		var_dump( $result->notImplemented() );
	 */
	public function toHTML( $result )
	{
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
			<head>
    			<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    			<title><?php echo $this->_project_name; ?> Unit Tests</title>
    			<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
                <style type="text/css">
                    *{ margin:0;padding:0; }
                    body, html{ height:100%;min-height:100%; }
                    body{ font-size:12px;font-family:arial, verdana, sans-serif; }
                    table { width:100%; }
                </style>
			</head>
			<body style="background:#F0F0F0;">
                <div style="background-color:#FFF;padding:20px 0;text-align:center;">
                    <h1><?php echo strtoupper( $this->_project_name ); ?></h1>
                    <h4 style="color:#999;">PHPUNit Tests Unitaires</h4>
                 </div>
				<?php $runned = $result->count(); ?>
				<?php $failed = $result->failureCount(); ?>
				<?php $incomplete = $result->notImplementedCount() ?>
				<?php $successed = ( $runned - ( $failed + $incomplete ) ); ?>
				
				<?php if( !$result->wasSuccessful() ) : ?>
                <table style="text-align:center;" cellpadding="0" cellspacing="0" border="0">
                
                	<?php $percent_incomplete = round( ( ( 100 * floatval( $incomplete ) ) / floatval( $runned ) ), 2 ); ?>
                    <?php $percent_fails = round( ( ( 100 * floatval( $failed ) ) / floatval( $runned ) ), 2 ); ?>
                    <?php $percent_succes = round( ( 100 - ( $percent_fails + $percent_incomplete ) ), 2 ); ?>
                    
                    <tr>
                        <td style="padding:10px;width:<?php echo $percent_incomplete; ?>%;background:#FF6500;">
                            <p><b><?php echo $percent_incomplete; ?>%</b></p>
                            <p><small><b><?php echo $incomplete; ?></b>&nbsp;sont incomplets</small></p>
                        </td>
                        <td style="padding:10px;width:<?php echo $percent_succes; ?>%;background:#ACE539;">
                            <p><b><?php echo $percent_succes; ?>%</b></p>
                            <p><small><b><?php echo $successed; ?></b>&nbsp;ont r&eacute;ussi</small></p>
                        </td>
                        <td style="padding:10px;width:<?php echo $percent_fails; ?>%;background:#FB1006;color:#FFF;">
                            <p><b><?php echo $percent_fails; ?>%</b></p>
                            <p><small><b><?php echo $result->failureCount(); ?></b>&nbsp;sont en &eacute;checs</small></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="background-color:#0066FF;color:#C4C4C4;padding:12px;" colspan="3">
                            <p><b><?php echo $runned; ?></b>&nbsp;ont &eacute;t&eacute; execut&eacute;s</p>
                        </td>
                    </tr>
                    
                </table>
<!--

Fails


-->
                <table style="background:#999;margin-bottom:10px;" cellpadding="0" cellspacing="0" border="1">
                	<caption style="background:#4C4C4C;padding:10px;">Failed Details</caption>
                    <?php $array = $result->failures(); ?>
                    <?php foreach( $array as $entry ) : ?>
                    <tr>
                        <td style="padding:10px;width:25%;">
                        	<?php echo get_class( $entry->failedTest() ); ?>&nbsp;&nbsp;
                        	<i><?php echo $entry->failedTest()->getName( false ); ?></i>
                        	<b><?php echo $entry->failedTest()->getResult(); ?></b>
						</td>
                        <td style="padding:10px;width:75%;"><b><?php echo $entry->exceptionMessage(); ?></b></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
<!--
                
skipped
                
-->
				<table style="background:#F1F1F1;margin-bottom:10px;" cellpadding="0" cellspacing="0" border="0">
				<caption style="background:#4C4C4C;padding:10px;">Skipped Details</caption>
				<?php $old_class = ""; ?>
				<?php $array = $result->notImplemented(); ?>
                <?php foreach( $array as $entry ) : ?>
                	<?php if( empty( $old_class ) ) : ?>
                	<tr>
                		<td>
                	<?php endif; ?>
                	<?php $current_class = get_class( $entry->failedTest() ); ?>
                	
                	<?php if( $current_class != $old_class ) : ?>
                	<?php if( !empty( $old_class ) ) : ?>
								</table>
							</td>
						</tr>
                	</table>
                	<?php endif; ?>
                	<table  style="" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td style="border-bottom:1px solid #4C4C4C;font-weight:bold;text-align:right;width:25%;">
								<span style="margin-right:10px;"><?php echo $current_class; ?></span>
							</td>
							<td style="width:75%;">
								<table cellpadding="0" cellspacing="0" border="0"
									<tr>
										<td style="padding:5px;border:1px solid #4C4C4C;border-top:0;">
                        					<i><?php echo $entry->failedTest()->getName( false ); ?></i>
                        					<b><?php echo $entry->failedTest()->getResult(); ?></b>
                        				</td>
									</tr>
                	<?php else: ?>
                	<tr>
						<td style="padding:5px;border:1px solid #4C4C4C;border-top:0;">
                        	<i><?php echo $entry->failedTest()->getName( false ); ?></i>
                        	<b><?php echo $entry->failedTest()->getResult(); ?></b>
						</td>
					</tr>
                	<?php endif; ?>
                	
                	<?php $old_class = $current_class; ?>
                	<?php if( end( $array ) === $entry ) : ?>
								</table>
							</td>
						</tr>
                	</table>
                		</td>
					</tr>
                	<?php endif; ?>
                <?php endforeach; ?>
				</table>
<!--
                
end
                
-->
				<?php endif; ?>
                <div style="text-align:right;padding:10px;">Execution time: <?php echo $result->time(); ?>s</div>
			</body>
		</html>
        <?php
	}
	
}
/* 
<!-- Errors -->
<?php $array = $result->errors(); ?>
<?php foreach( $array as $entry ) : ?>
<td></td>
<?php endforeach; ?>
<!-- Deprecated -->
<?php $array = $result->deprecatedFeatures(); ?>
<?php foreach( $array as $entry ) : ?>
<td></td>
<?php endforeach; ?>
<!-- Skipped -->
<?php $array = $result->skipped(); ?>
<?php foreach( $array as $entry ) : ?>
<td></td><?php endforeach; ?>
*/