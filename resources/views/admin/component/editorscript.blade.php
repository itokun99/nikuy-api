<!-- tinymce -->
<script src="/assets/admin/js/tinymce.js?v=1.0.0"></script>
<script>
    tinymce.init({
        selector: '.ckeditor',
        force_br_newlines: false,
        force_p_newlines: false,
        forced_root_block: '',
        height: 500,

        menubar: 'file insert format table tools',
        plugins: 'paste table print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists code textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar: "code |",
        theme_advanced_buttons3_add: "pastetext,pasteword,selectall",
        paste_word_valid_elements: "b,i,p,a[href],ol,ul,li,em,br",
        toolbar: "undo redo | bold italic underline | forecolor backcolor | responsivefilemanager code",
        image_advtab: true,

        relative_urls: false,
        remove_script_host: false,
        external_filemanager_path: "/filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {
            "responsivefilemanager": "/filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js",
            "filemanager": "/filemanager/plugin.min.js"
        },

        // external_filemanager_path:"/filemanager/",
        // filemanager_title:"Responsive Filemanager" ,
        // external_plugins: {
        //     "responsivefilemanager": "/assets/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js",
        //     "filemanager": "/filemanager/plugin.min.js"
        // },

        entity_encoding: "named",
        extended_valid_elements: "em[class|name|id]",
        setup: function(editor) {
            editor.on('change', function(e) {
                editor.save();
            });
        }

    });
</script>
