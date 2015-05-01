<dl>
	<dt>
        <!--{if $label}-->
        <label for="<!--{$id}-->">
            <b><!--{$label}--></b>
            <!--{if $description}-->
            <br><i><!--{$description}--></i>
            <!--{/if}-->
        </label>
        <!--{/if}-->
    </dt>
	<dd>
		<fieldset id="<!--{$id}-->">
			<div id="<!--{$id}-->holder-0" class="clonable">
				<ul>
					<!--{foreach from=$options key=label item=input name=clonable}-->
					<li>
						<label><!--{$input->getLabel()}--></label><br>
						<!-- switch sur le type d'elements a ajouter au clonable -->
						<!--{if $input->getType() eq "text"}-->
							<input type="text" name="" />
						<!--{elseif $input->getType() eq "select"}-->
							<select name="" >
								<!--{html_options options=$input->getOptions()}-->
							</select>
						<!--{elseif $input->getType() eq "checkbox"}-->
							<input type="checkbox" name="" />
						<!--{/if}-->
					</li>
					<!--{/foreach}-->
				</ul>
				<span class="button"  >+</span>
				<div class="clearer"></div>
			</div>
		</fieldset>
	</dd>
</dl>
<script type="text/javascript">
//	smarty.foreach.clonable.index
	$( document ).ready( function()
	{
		$( $( "#<!--{$id}-->" ).find( ".button" )[ 0 ] ).bind( "click",  { index:0 }, addCloneRow );
	});
	//]]>
</script>
