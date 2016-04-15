$(document).ready(function() {
    //format all date class
    $( ".date" ).each(function( index ) {
        var date  = $(this).text();
        var odate = moment(date).format('MMMM Do YYYY, h:mm:ss a');
        $(this).text(odate);
    });
});
