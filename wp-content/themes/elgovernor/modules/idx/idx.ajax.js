/**
 * Created by Bryan on 4/21/2017.
 */
function loadIdxAjax(){
    $.ajax({
        type : 'post',
        dataType : 'json',
        url : wpAjax.ajaxurl,
        data : {
            action: 'loadIdx'
        },
        success: function(data) {
            console.dir(data);

            $(".area-select").select2({
                placeholder: 'City / Area',
                width: '100%',
                dataType: 'json',
                data: data
            });

        }

    });
}

$( document ).ready(function(){
    loadIdxAjax();
});