(function() {
  tinymce.PluginManager.add('expander_button', function( editor, url ) {
    editor.addButton( 'expander_button', {
      title: 'Expander',
      onclick: function() {
        editor.windowManager.open( {
          title: 'Create Expander',
          width: 500,
          minHeight: 350,
          body: [
            {
              type: 'textbox',
              multiline: true,
              name: 'wpex_content',
              label: 'Content',
              minHeight: 180
            },
            {
            type: 'textbox',
            name: 'wpex_read_more',
            label: 'Read more text',
            maxLength: 30
          },
          {
            type: 'textbox',
            name: 'wpex_read_less',
            label: 'Read less text',
            maxLength: 30
          },
          {
            type: 'textbox',
            name: 'wpex_class',
            label: 'Class',
            maxLength: 20
          }
        ],
        onsubmit: function( e ) {
          editor.insertContent( '[wpex' + ' more="' + e.data.wpex_read_more + '"' + ' less="' + e.data.wpex_read_less + '"' + ' class="' + e.data.wpex_class + '"' + ']' + e.data.wpex_content + '[/wpex]');
        }
      });
    }
  });
});
})();
