<form>
	<div style="padding: 2px;">
		<label for="apikey">
			<strong>Google Analytics API key:</strong>
			<input type="text" size="30" maxlength="30" name="apikey" id="apikey" value="<?php echo $module_configs[$module_configs->configs['apikey']]->val; ?>" />
		</label>
	</div>
	<div style="padding: 2px;">
		<button type="button" name="submit">Save configuration</button> 
		<button type="button" name="cancel">Cancel</button>
	</div>
</form>
<script language="JavaScript" type="text/javascript" id="ajax-callback">
$(function() {
	$('button[name="cancel"]').click(function(event) {
		Fabriq.UI.Overlay.close();
	});
	$('button[name="submit"]').click(function(event) {
		$.ajax({
			type: 'POST',
			url: Fabriq.build_path('fabriqmodules', 'configure', '<?php echo PathMap::arg(2); ?>'),
			data: {
				apikey: $('input[name="apikey"]').val(),
				submit: true
			},
			dataType: 'json',
			success: function(data, status) {
				if (data.success) {
					Fabriq.UI.Overlay.close();
					$('#message-box')
						.addClass('successes')
						.html('Google Analytics module configuration has been saved')
						.fadeIn();
				}
			}
		});
	});
});
</script>