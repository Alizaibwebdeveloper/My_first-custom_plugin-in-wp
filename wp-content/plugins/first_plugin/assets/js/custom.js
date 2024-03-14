jQuery(function($) {
    $('#Ajax_form').on('submit', function(e) {
        e.preventDefault();
        $.post(
            ajax_object.ajax_url, // Properly defined AJAX URL
            { 
                action: 'my_ajax_action', 
                option1: e.target.first_plugin_option1.value 
            },
            function(val) {
                alert('val'); // Display response
            }
        );
    });
});
