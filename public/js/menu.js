$(document).ready(function () {
    let arrayjson = [];
    try{
        arrayjson = JSON.parse($('body #menu_items').val());

    } catch (e) {
        arrayjson = [];
    }

    let editor = new MenuEditor('myEditor', { //#myEditor id-ov ul-i vra kpcnum enq plugin@
        listOptions: {placeholderCss: {'background-color': "#cccccc"}, insertZonePlus: true},
        iconPicker: {searchText: "Search...", labelHeader: "{0}/{1}"}});

    editor.setForm($('#frmEdit'));
    editor.setData(arrayjson);

    $('#btnAdd').click(function(){
        editor.add();
    });

    $('#btnUpdate').click(function(){
        $('#btnAdd').show()
        $('#btnUpdate').hide()
        editor.update();
    });

    $('body #category_id').change(function(){
        let catName = $(this).val();
        try {
            let locales = JSON.parse($('body #category_id option:checked').attr('data-locales'));
            $('body #frmEdit input[name="name"]').val(locales.name || '');
            $('body #frmEdit input[name="url"]').val(`${catName}`);
        } catch (e) {
            $('#frmEdit')[0].reset();
        }
    });

    $('body #page_id').change(function(){
        let catName = $(this).val();
        try {
            let locales = JSON.parse($('body #page_id option:checked').attr('data-locales'));
            $('body #frmEdit input[name="name"]').val(locales.title || '');
            $('body #frmEdit input[name="url"]').val(`${catName}`);
        } catch (e) {
            $('#frmEdit')[0].reset();
        }
    });

    $('body #save-menu').click(function(e){
        e.preventDefault();
        let items = editor.getString();
      $('body #menu_items').val(items);
        $('body #saveMenu').submit();
    });
});

