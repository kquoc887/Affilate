$(document).ready(function () {
    $(document).ready(function(){
        $.ajax({
            url: 'http://192.168.1.30:8080/Affilate/public/api/action',
            type: 'post',
            cache: false,
            dataType: 'JSON',
            data: {
                'user_code': getCookie('uc'),
                'data_customer': data_info
            }
        });
    })
});