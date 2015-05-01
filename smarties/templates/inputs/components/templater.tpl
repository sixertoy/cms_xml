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
	<input
		type="file"
		id="<!--{$id}-->-file"
		name="<!--{$id}-->-file"
		/>
	</dd>
	<dt>
		<label for="<!--{$id}-->-body">Body</label>
		</dt>
	<dd>
		<textarea 
			id="<!--{$id}-->-body"
			class="texteditor"
			name="<!--{$id}-->-body"
			cols="<!--{$width}-->"
			rows="<!--{$height}-->"
			<!--{if !$value}-->
			placeholder="Votre <!--{$label}-->"
			<!--{/if}-->
			<!--{if $required}-->required <!--{/if}-->
			<!--{if $autofocus}-->autofocus <!--{/if}-->
		>
		<!--{$value}-->
		</textarea>
		</dd>
		<hr class="clear" />
</dl>
<script type="text/javascript">
	//<![CDATA[
	$(function()
	{
		$( "#<!--{$id}-->-body" ).wysiwyg( { css:"skin/css/jquery/jquery.ueditorcontent.css" }  );
	});
	//]]>
</script>