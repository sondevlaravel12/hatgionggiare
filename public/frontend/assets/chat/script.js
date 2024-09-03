//Open dialog after 10s
$(function(){
    $('.offline_heading').click(function(){
        //Close popup
        if( $('#popup_chat').hasClass('popup_open') ){
            $('#popup_chat').removeClass('popup_open').addClass('popup_close');
            $('.toggle_popup').removeClass('fa-angle-down').addClass('fa-angle-up');
            return;
        }

        //Open popup
        if( $('#popup_chat').hasClass('popup_close') ){
            $('#popup_chat').removeClass('popup_close').addClass('popup_open');
            $('.toggle_popup').removeClass('fa-angle-up').addClass('fa-angle-down');
        }
    })

    setTimeout(function(){
        if( $('#popup_chat').hasClass('popup_close') ){
            $('.offline_heading').click();
            play_sound();
        }
    }, 120000);

    //Submit form
    $('#contactForm').submit(function(e){

        e.preventDefault();
        $contactForm = $('form#contactForm');

        var hoten = $contactForm.find('#client_name').val();
        var dienthoai = $contactForm.find('#phone_number').val();
        var diachi = $contactForm.find('#address').val();
        var sanphamdat = $contactForm.find('#product').val();
        var submitInfo = $contactForm.find('#submitInfo').val();

        // Check validate
        // if( !hoten || !dienthoai || !diachi || !sanphamdat ){
        //     alert('Vui lòng nhập thông tin');
        //     return false;
        // }

        var form_data = $(this).serialize();

        //Call Ajax
        $.post('/don-hang-form-chat/dat-hang',form_data,function(data){
            // 2 lines of code for what ?
            // var chat_url = $('#chat_url').val();
            // chat_url = chat_url.replace('/index.php','');
            //Success
            // Notification();
            // displayNotification(response['message']);
            if (data.success) {
                // Start Message
                Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                  //   icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                  })
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                });
                $('#popup_chat .popup_body').html(" <a href='" +"'><img src='/frontend/assets/chat/dat-hang-thanh-cong.png' /></a> ");
            }

        })
    })

})
function clearContractForm(){
    $contactForm = $('form#contactForm');
    $contactForm.find('#client_name').val('');
    $contactForm.find('#phone_number').val('');
    $contactForm.find('#address').val('');
    $contactForm.find('#product').val('');
    $contactForm.find('#submitInfo').val('');
}

function play_sound(){
    // var audio = new Audio('/asset/chat/ting.mp3');
    // audio.play();
}
// no need this custome serialize , use serialize() is enough
// (function ($) {
//     $.fn.serializeFormJSON = function () {

//         var o = {};
//         var a = this.serializeArray();
//         $.each(a, function () {
//             if (o[this.name]) {
//                 if (!o[this.name].push) {
//                     o[this.name] = [o[this.name]];
//                 }
//                 o[this.name].push(this.value || '');
//             } else {
//                 o[this.name] = this.value || '';
//             }
//         });
//         return o;
//     };
// })(jQuery);
