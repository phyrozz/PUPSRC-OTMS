$(document).ready(function(){
    $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
    });

    $('#submitBtn').click(function() {
        /* when the button in the form, display the entered values in the modal */
        $('#lname').text($('#lastname').val());
        $('#fname').text($('#firstname').val());
    });

    $('#submit').click(function(){
        /* when the submit button in the modal is clicked, submit the form */
        $('#appointment-form').submit();
    });
});