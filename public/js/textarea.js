$(document).ready(function () {
    tinymce.init({
        selector: 'textarea.tinymce',
        toolbar: 'bold italic | numlist bullist | blockquote | alignleft aligncenter alignright alignjustify |  link | table | fullscreen | undo redo | outdent indent gallery | Insert tables |Insert Topics | code quickbars |',
        menubar: 'file edit insert view format tools table',
        plugins: 'link table fullscreen code lists',
        selection_toolbar: 'bold italic | h2 h3 | blockquote quicklink',
        setup: function (editor) {
            if(typeof galleries !== 'undefined' && galleries.length) {
                editor.ui.registry.addMenuButton('gallery', {
                    text: 'Gallery',
                    tooltip: 'Insert gallery',
                    fetch: function (callback) {
                        let items = []

                        for(let i = 0; i < galleries.length; i++) {
                            items.push( {
                                type: 'menuitem',
                                text: galleries[i].title,
                                onAction: function () {
                                    editor.insertContent(`{||gallery_${galleries[i].id}||}`);
                                }
                            })
                        }
                        callback(items);
                    }
                });
            }

            if(typeof tables !== 'undefined' && tables.length) {
                editor.ui.registry.addMenuButton('tables', {
                    text: 'Tables',
                    tooltip: 'Insert tables',
                    fetch: function (callback) {
                        let items = []

                        for(let i = 0; i < tables.length; i++) {
                            items.push( {
                                type: 'menuitem',
                                text: tables[i].title,
                                onAction: function () {
                                    editor.insertContent(`{||table_${tables[i].id}||}`);
                                }
                            })
                        }
                        callback(items);
                    }
                });
            }

            if(typeof topics !== 'undefined' && topics.length) {
                editor.ui.registry.addMenuButton('topics', {
                    text: 'Topics',
                    tooltip: 'Insert Topics',
                    fetch: function (callback) {
                        let items = []

                        for(let i = 0; i < topics.length; i++) {
                            items.push( {
                                type: 'menuitem',
                                text: topics[i].name,
                                onAction: function () {
                                    editor.insertContent(`{||topic_${topics[i].id}||}`);
                                }
                            })
                        }
                        callback(items);
                    }
                });
            }
        },
    });
})
