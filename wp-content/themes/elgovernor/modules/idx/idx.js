/**
 * Created by Bryan on 4/21/2017.
 */
function toggler(menuVar){
    $('#'+menuVar).toggle();
}
jQuery(function($) {
    $(document).ready(function () {
        $(".lazy").Lazy({
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onError: function(element) {
                console.log('error loading ' + element.data('src'));
            }
        })
    })
});
