// Check if dark mode is enabled in localStorage
var isDarkMode = localStorage.getItem('darkMode');
if (isDarkMode === 'true') {
    $('#darkModeSwitch').prop('checked', true);
    enableDarkMode();
}

$('#darkModeSwitch').change(function() {
    if ($(this).prop('checked')) {
        enableDarkMode();
    }
    else {
        disableDarkMode();
    }
});

function enableDarkMode() {     
    $('body').addClass('dark-mode');
    $('.dark-overlay').addClass('dark-mode');
    $('.table').addClass('table-dark');
    $('.table').addClass('text-light');
    $('.bg-maroon').addClass('dark-mode');
    $('#loader').addClass('dark-mode');
    $('.loading-text').addClass('dark-mode');
    $('.btn-primary').addClass('dark-mode');
    $('.btn-outline-primary').addClass('dark-mode');
    $('.input-group').addClass('bg-dark');
    $('.jumbotron').addClass('dark-mode');
    $('.accordion').addClass('dark-mode');
    $('.accordion-body').addClass('dark-mode');
    $('.card').addClass('bg-dark');
    $('.card-header').addClass('text-light');
    $('.card-body').addClass('text-light');
    $('.btn-close').addClass('bg-light');
    $('.modal-header').addClass('bg-dark');
    $('.modal-content').addClass('bg-dark');
    $('.modal-body').addClass('bg-secondary');
    $('.modal-footer').addClass('bg-dark');
    $('.dropdown-menu').addClass('bg-dark');
    $('.dropdown-item').addClass('dark-mode');
    $('.notification-item').addClass('dark-mode');
    $('.footer').addClass('bg-dark');
    $('.breadcrumb-item').removeClass('text-dark').addClass('text-light');
    $('.breadcrumb-separator').removeClass('text-dark').addClass('text-light');
    $('.breadcrumb-link').removeClass('text-dark').addClass('text-light');
    $('.payment-summary').addClass('bg-dark');
    $('.notification-item').addClass('text-light');

    // Store dark mode state in localStorage
    localStorage.setItem('darkMode', 'true');
}

function disableDarkMode() {
    $('body').removeClass('dark-mode');
    $('.dark-overlay').removeClass('dark-mode');
    $('.table').removeClass('table-dark');
    $('.table').removeClass('text-light');
    $('.bg-maroon').removeClass('dark-mode');
    $('#loader').removeClass('dark-mode');
    $('#loading-text').remove('dark-mode');
    $('.btn-primary').removeClass('dark-mode');
    $('.btn-outline-primary').removeClass('dark-mode');
    $('.input-group').removeClass('bg-dark');
    $('.jumbotron').removeClass('dark-mode');
    $('.accordion').removeClass('dark-mode');
    $('.accordion-body').removeClass('dark-mode');
    $('.card').removeClass('bg-dark');
    $('.card-header').removeClass('text-light');
    $('.card-body').removeClass('text-light');
    $('.btn-close').removeClass('bg-light');
    $('.modal-header').removeClass('bg-dark');
    $('.modal-content').removeClass('bg-dark');
    $('.modal-body').removeClass('bg-secondary');
    $('.modal-footer').removeClass('bg-dark');
    $('.dropdown-menu').removeClass('bg-dark');
    $('.dropdown-item').removeClass('dark-mode');
    $('.notification-item').removeClass('dark-mode');
    $('.footer').removeClass('bg-dark');
    $('.breadcrumb-item').addClass('text-dark');
    $('.breadcrumb-separator').addClass('text-dark');
    $('.breadcrumb-link').addClass('text-dark');
    $('.payment-summary').removeClass('bg-dark');
    $('.notification-item').removeClass('text-light');

    // Store dark mode state in localStorage
    localStorage.setItem('darkMode', 'false');
}

// Check if "Allow editing name fields" is enabled in localStorage
var isSwitchOn = localStorage.getItem('disabledFieldsOrNot') === 'true';
  
$('#disabledFieldsOrNot').prop('checked', isSwitchOn);
toggleFieldsDisabledState(isSwitchOn);

$('#disabledFieldsOrNot').change(function() {
  var isSwitchOn = $(this).prop('checked');
  toggleFieldsDisabledState(isSwitchOn);
  localStorage.setItem('disabledFieldsOrNot', isSwitchOn.toString());
});

function toggleFieldsDisabledState(isDisabled) {
    $('#contactNumber').prop('disabled', !isDisabled);
    $('#email').prop('disabled', !isDisabled);
  }
