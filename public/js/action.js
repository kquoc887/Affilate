$(document).ready(function () {
    // alert(123);
    $(document).on('click', '#btn_register', function(event) {
        $(this).text('Đăng nhập');
        $(this).attr('id', 'btn_login');
        $('#frmLogin').css('display', 'none');
        $('.region-login').css('padding-top', '1px');
        $('#frmRegister').css('display', 'block');
    });
    $(document).on('click', '#btn_login', function(event) {
        $(this).text('Đăng ký');
        $(this).attr('id', 'btn_register');
        $('#frmLogin').css('display', 'block');
        $('.region-login').css('padding-top', '10%');
        $('#frmRegister').css('display', 'none');
    });
});