$(document).on('click', '#register-membership', function() {
    const url = $('#base_url').val();
    const uniqueToken =  $('#unique_token').val(); // Replace with a generated token
    const routeUrl = url+'register-membership'; 

    $.ajax({
        url: routeUrl,
        type: 'POST', 
        data: { token: uniqueToken }, 
        success: function(response) {
            console.log('Success:', response);

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});
