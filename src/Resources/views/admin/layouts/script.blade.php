<script type="text/javascript">
	function elFinderBrowser (field_name, url, type, win) {
    	tinymce.activeEditor.windowManager.open({
	  		file: "{{ route('admin.mediamanager.popup') }}",
		    title: "{{ __('mediamanager::app.admin.menu.title') }}",
		    width: 900,
		    height: 450,
		    resizable: 'yes'
		}, {
		    setUrl: function (url) {
		    	win.document.getElementById(field_name).value = url;
		    }
		});

		return false;
	}

	try {
		tinymce.overrideDefaults({
			plugins: 'image media wordcount fullscreen code',
			file_browser_callback: elFinderBrowser,
			image_dimensions: false,
			relative_urls: false,
			urlconverter_callback: function (url, node, on_save, name) {
				return url;
			}
		});
	} catch(err) {
		// do nothing
	}
</script>