//these are reused function all throughout
function setSideBarActive(menuId)
{
    $('.sidebar-menu > li').removeClass('active');

    elem = $('#' + menuId);
    if(elem.parent().hasClass('treeview-menu')) {
        elem.parent().addClass('menu-open');
        elem.parent().parent().addClass('active');
        elem.siblings('li').removeClass('active');
    }
    $('#' + menuId).addClass('active');
};
$(document).ready(function() {
    //add active class to sidebar-menu
    $('.sidebar-menu li').click(function() {
        $('.sidebar-menu > li').removeClass('active');

        elem = $(this)
        if(elem.parent().hasClass('treeview-menu')) {
            elem.parent().addClass('menu-open');
            elem.parent().parent().addClass('active');
            elem.siblings('li').removeClass('active');
        }

        $(this).addClass('active');
    });
});
