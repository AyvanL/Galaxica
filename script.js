$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        let username = $('#username').val(); // Get the username value and trim whitespace
        let password = $('#password').val();
        
        $('.alert').remove(); // Remove any existing alert messages
        
        if (username === '' || password === '') {
            // If username or password is empty, show error messages
            let errorMessage = '<div class="alert alert-danger mt-3" role="alert">';
            errorMessage += username === '' ? 'Username is required.<br>' : '';
            errorMessage += password === '' ? 'Password is required.' : '';
            $('#loginModal .modal-body').prepend(errorMessage);
        } else {
            // If both fields are filled, show a success message
            let successMessage = `<div class="alert alert-success mt-3" role="alert">
                                   Welcome to Galaxica Playland, ${username}!
                                  </div>`;
            $('#loginModal .modal-body').prepend(successMessage);
            
            // Update the <p> element with the username
            $('.username').text(username); // Change this line to update the username display
            
            $('#loginForm')[0].reset(); // Reset the form
            
            // Optionally close the modal after 1 second
            setTimeout(function() {
                $('#loginModal').modal('hide');
            }, 1000);
        }
    });

    $('.content1').hide();
    $('.content1').slideDown(1000);
});