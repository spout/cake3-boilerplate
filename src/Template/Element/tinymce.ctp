<?php $this->append('script'); ?>
    <?php
    $lang = $this->request->params['lang'];
    $languageUrl = sprintf('/js/tinymce/langs/%s_%s.js', $lang, strtoupper($lang));

    $elFinderUrl = $this->request->webroot . 'elfinder/?' . http_build_query([
        'lang' => $this->request->param('lang'),
        'optionsCallback' => 'elFinderOptionsCallback()'
    ]);
    ?>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea.wysiwyg',
            height : "200",
            <?php if($lang != 'en'): ?>
            language_url: '<?php echo $languageUrl; ?>',
            <?php endif; ?>
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            <?php if(!empty($contentCss)): ?>
            content_css: <?php echo json_encode($contentCss); ?>,
            <?php endif; ?>
            // https://github.com/Studio-42/elFinder/wiki/Integration-with-TinyMCE-4.x
            file_browser_callback: elFinderBrowser,
            relative_urls: false
        });

        function elFinderBrowser(field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '<?php echo $elFinderUrl; ?>',// use an absolute path!
                title: '<?php echo __("File manager"); ?>',
                width: 900,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    console.log('setUrl', url);
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
        }

        function elFinderOptionsCallback() {
            return {
                getFileCallback: function(file) { // editor callback
                    // file.url - commandsOptions.getfile.onlyURL = false (default)
                    // file     - commandsOptions.getfile.onlyURL = true
                    FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
                }
            };
        }

        var FileBrowserDialogue = {
            init: function() {
                // Here goes your code for setting your custom things onLoad.
            },
            mySubmit: function (URL) {
                console.log('mySubmit', URL);
                // pass selected file path to TinyMCE
                parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

                // force the TinyMCE dialog to refresh and fill in the image dimensions
                var t = parent.tinymce.activeEditor.windowManager.windows[0];
                t.find('#src').fire('change');

                // close popup window
                parent.tinymce.activeEditor.windowManager.close();
            }
        };
    </script>
<?php $this->end(); ?>