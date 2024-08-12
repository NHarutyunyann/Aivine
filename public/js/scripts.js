$(document).ready(function () {
    // Open Left
    const openMenu = document.querySelector('.menu_icon');
    const closeMenu = document.querySelector('.close-menu-btn');
    const leftMenu = document.querySelector('#left_menu');
    const bodyOverlay = document.querySelector('.body_overlay');
    const body = document.querySelector('.tilton_body');

    if(openMenu) {
        openMenu.addEventListener('click', (event) => {
            event.preventDefault();
            leftMenu.classList.add('left');
            bodyOverlay.style.display = "block";
            body.style.overflow = "hidden"
        });
    }

    if(closeMenu) {
        closeMenu.addEventListener('click', (event) => {
            event.preventDefault();
            leftMenu.classList.remove('left');
            bodyOverlay.style.display = "none";
            body.style.overflow = "auto"
        })
    }

    $('span.zoom-btn').click(function () {
        $(this).next('img').trigger("click");
    })
})
const flickityArr = [];
$(document).ready(function() {
    $('body .init-flickity').show()
    $('body .init-flickity-nav').show()

    let elements = document.querySelectorAll('.init-flickity');
    elements.forEach(el => {
        flickityArr.push(new Flickity( el, {
            cellAlign: 'left',
            contain: true,
            arrowShape: 'M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zM256 472c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm-12.5-92.5l-115.1-115c-4.7-4.7-4.7-12.3 0-17l115.1-115c4.7-4.7 12.3-4.7 17 0l6.9 6.9c4.7 4.7 4.7 12.5-.2 17.1L181.7 239H372c6.6 0 12 5.4 12 12v10c0 6.6-5.4 12-12 12H181.7l85.6 82.5c4.8 4.7 4.9 12.4.2 17.1l-6.9 6.9c-4.8 4.7-12.4 4.7-17.1 0z',
        }))
    })

    elements = document.querySelectorAll('.init-flickity-nav');

    elements.forEach(el => {
        flickityArr.push(new Flickity( el, {
            asNavFor: '#' + el.getAttribute('data-main'),
            contain: true,
            pageDots: false,
        }))
    })

    const navBtns = document.querySelectorAll('body .init-flickity .flickity-button-icon')
    navBtns.forEach(el => {
        el.setAttribute('viewBox', '0 0 512 512')
    })

    // setTimeout(() => {
    //     flickityArr.map(i => {
    //         i.resize()
    //     })
    // }, 400)
    $('.image-carousel').each(function (element, index) {
        $(this).attr('src', $(this).attr('data-large'))
    })

    Fancybox.bind("[data-fancybox]");
    console.log("window is ready");
});


$(window).on('load', function() {
    flickityArr.map(i => {
        i.resize()
    })
    console.log("window is loaded: ", flickityArr);
});
