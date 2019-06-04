$(document).ready(function () {
    $(document).ready(function(){
        $.ajax({
            url: 'http://localhost:7000/Affilate/public/api/action',
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