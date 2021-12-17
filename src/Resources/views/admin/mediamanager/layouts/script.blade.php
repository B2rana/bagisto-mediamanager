<script type="text/javascript">
	tinyMCEHelper = {
        initTinyMCE: function (config) {
            let self = this;

            tinymce.init({
                ...config,

                file_browser_callback: function(field_name, url, type, win) {
                	self.elFinderBrowser(field_name, url, type, win);
                },
                image_dimensions: false,
                relative_urls: false,
                urlconverter_callback: function (url, node, on_save, name) {
					return url;
				}
            });
        },

        elFinderBrowser: function (field_name, url, type, win) {
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
    };
</script>