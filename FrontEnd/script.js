var $li = $('#pills-tab li').click(function() {
    $li.removeClass('selected');
    $(this).addClass('selected');
});