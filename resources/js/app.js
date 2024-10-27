import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery'; // Import jQuery

window.Alpine = Alpine;
Alpine.start();

$(document).ready(function() {
    // Handle form submissions
    $('form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: $(this).attr('action'), // URL from the form action
            method: $(this).attr('method'), // HTTP method
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Handle success, e.g., show a success message or redirect
                console.log('Success:', response);
            },
            error: function(xhr) {
                // Handle errors, e.g., show validation errors
                console.log('Error:', xhr.responseJSON);
            }
        });
    });
});
