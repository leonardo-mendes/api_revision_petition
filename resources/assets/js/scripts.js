$(document).ready(function() {
    alert('hello');
    $('.modal').show();
    $('.modal').addClass('in');
    $('body').addClass('modal-open');
    $('body').append("<div class='modal-backdrop fade in'></div>");

    $('.closeModal, .saveChanges').click(function() {
        $('.modal').hide();
        $('.modal').removeClass('in');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });
});