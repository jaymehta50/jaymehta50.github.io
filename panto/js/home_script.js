jQuery(document).ready(function ($) {

    function goToByScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
        }, 2000, 'easeInOutQuint');
    }

    var togoto = 1;
    switch(document.URL.split('#')[1]) {
        case 'home':
            togoto = 1;
            break;
        case 'tickets':
            togoto = 2;
            break;
        case 'charities':
            togoto = 3;
            break;
        case 'committee':
            togoto = 4;
            break;
        case 'pastpantos':
            togoto = 5;
            break;
        default:
            togoto = 1;
    }
    goToByScroll(togoto);

});