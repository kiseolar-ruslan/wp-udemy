jQuery(document).ready(function ($){
    $('#button_car').on('click', function (e) {
        e.preventDefault;

        $.ajax({
            url  : firsttheme_ajax_script.ajaxurl,
            data : {
                'action' : 'firsttheme_ajax_example',
                'nonce'  : firsttheme_ajax_script.nonce
            },
            success : function (data) {
                $('#car_content').html(data);
            },
            error   : function (errorThrown) {
                console.log(errorThrown);
            }
        })
    });
});