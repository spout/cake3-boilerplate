<?php $this->append('script'); ?>
<script src="<?= \Cake\Core\Configure::read('Bower.path'); ?>ace-builds/src-min-noconflict/ace.js"></script>
<script>
    $(function () {
        // https://gist.github.com/duncansmart/5267653
        $('textarea[data-editor]').each(function () {
            var textarea = $(this);
            var mode = textarea.data('editor');
            var editDiv = $('<div>', {
                position: 'absolute',
                width: textarea.width(),
                //height: textarea.height(),
                height: '500px',
                'class': textarea.attr('class')
            }).insertBefore(textarea);
            textarea.css('display', 'none');
            var editor = ace.edit(editDiv[0]);
            //editor.renderer.setShowGutter(false);
            editor.getSession().setValue(textarea.val());
            editor.getSession().setMode("ace/mode/" + mode);
            editor.setTheme("ace/theme/<?php echo !empty($theme) ? $theme : 'monokai'; ?>");
            editor.setShowPrintMargin(false);

            // copy back to textarea on form submit...
            textarea.closest('form').submit(function () {
                textarea.val(editor.getSession().getValue());
            })
        });
    });
</script>
<?php $this->end(); ?>