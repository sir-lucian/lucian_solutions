function agree() {
    $("#comm-details").removeClass('d-none');
    $("#comm-details").removeClass('invisible');
    $("#comm-details").addClass('visible');
    scroll('comm-details');
    return null;
}

function scroll(x){
    var getMeTo = document.getElementById(x);
    getMeTo.scrollIntoView({behavior: 'smooth'}, true);
}

function navBurger() {
    $("#navTrigger").toggleClass('active');
    $("#mainListDiv").toggleClass("show_list");
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}