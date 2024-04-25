
$(document).ready(function() {
    $("#content_snote").summernote({
        height: 250
    });

});




document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    var formData = new FormData(this); // Get form data

    // Send AJAX request to upload.php
    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
        // Check if imageUrl key exists in the response
        if (data.imageUrl) {
            // Update HTML content with uploaded image URL
            var imageUrlContainer = document.getElementById('imageUrl');
            imageUrlContainer.textContent = data.imageUrl; // Display image URL
        } else if (data.error) {
            // Display error message
            alert(data.error);
        } else {
            // Unexpected response
            alert('Unexpected response from server');
        }
    })
    .catch(error => console.error('Error:', error));
});



// $(document).ready(function() {
//     $("#content_snote").summernote({
//         height: 250
//     });

//     $('#submit-post').click(function(e) {
//         e.preventDefault();

//         // Get form data
//         var formData = new FormData($('#postForm')[0]);

//         // Send AJAX request
//         $.ajax({
//             url: 'create.php',
//             type: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function(response) {
//                 try {
//                     // Parse the JSON response
//                     var data = JSON.parse(response);

//                     // Check if the response indicates success
//                     if (data.status === 0) {
//                         alert(data.message);
//                         window.location.href = 'show-post.php?success=true';
//                     } else {
//                         alert(data.message);
//                     }
//                 } catch (error) {
//                     // Handle JSON parsing error
//                     console.error('Error parsing JSON response:', error);
//                     // alert('An error occurred while processing your request.');
//                 }
//             },
//             error: function(xhr, status, error) {
//                 // Handle AJAX error
//                 console.error('AJAX error:', error);
//                 alert('An error occurred while communicating with the server.');
//             }
//         });
//     });
// });