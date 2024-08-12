function generatePassword() {
    $('body #password').val(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15))
}
$(document).ready(function () {
    $("body").on('click', '.cart-header-actions', function(event){
        event.stopPropagation();
    });

    $('body').on('keyup', '.generate-slug input', function () {
        const $self = $(this)
        $self.parents('.generate-slug').siblings('.input-search_words').find('input').val($self.val())
        axios.post('/admin/slugify', {text: $self.val()}).then(({data}) => {
            if(data && data.slug) {
                console.log(' $self.siblings(\'.input-slug\'): ',  $self.siblings('.input-slug'))
                $self.parents('.generate-slug').siblings('.input-slug').find('input').val(data.slug)
            }
        })
    })

    $('.admin-account-box').click(function () {
        $('.logout-box').fadeToggle();
        $('.admin-account-box').toggleClass('active');
    })
    $('.sidebar-bars-icon-box').click(function () {
        $('.sidebar-bars-icon-box').fadeOut();
        $('#admin header.admin-header').animate({width: "+=250"}, 500);
        $('.main-sidebar').animate({left: "-=250"}, 500);
        $('#admin').animate({'padding-left' : 0}, 500);
        setTimeout(function(){
            $('.header-bars-icon-box').fadeIn();
        },500);
    });
    $('.header-bars-icon-box').click(function () {
        $('.header-bars-icon-box').fadeOut();
        $('#admin header.admin-header').animate({width: "-=250"}, 500);
        $('.main-sidebar').animate({left: "+=250"}, 500);
        $('#admin').animate({'padding-left' : 250}, 500);
        setTimeout(function(){
            $('.sidebar-bars-icon-box').fadeIn();
        },500);
    });

    $('a.add-attribute-btn').click(function () {
        $('.add-attribute-box').fadeToggle();
    });

    $('.card-tools button').click(function () {
        $('.add-attribute-box').fadeToggle();
    });

    jQuery('.settings-shipping-tab-btn').click(function () {
        jQuery('.settings-shipping-tab-btn').removeClass('active');
    })

    $('.using-image-text-select').change(function () {
        if($(this).find('.using-text-option').is(':selected')) {
            $('.using-text-tr').show();
            $('.image-url-tr').hide();
        }else if ($(this).find('.using-image-option').is(':selected')) {
            $('.using-text-tr').hide();
            $('.image-url-tr').show();
        }
    })
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:10,
        searchResultLimit:10,
        renderChoiceLimit:10
      }); 
});

function capitalize(str) {
    const arr = str.split(' ')

    for (let i = 0; i < arr.length; i++) {
        arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1)
    }

    return arr.join(' ')
}

function priceFormatter(data) {
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    return formatter.format(data)
}

if($('.login-box').length > 0 ) {
    console.log('ksfhksjdfg');
    $("#show_hide_password .btn-hide-password").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye" );
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye" );
            $('#show_hide_password i').addClass( "fa-eye-slash" );
        }
    });
}


