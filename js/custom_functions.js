
$(function() {
    $('.confirm').click(function(e) {
        e.preventDefault();
        if (window.confirm("Are you sure?")) {
            location.href = this.href;
        }
    });

    $('a.disabled').click(function(e) {
        e.preventDefault();
        
    });


});