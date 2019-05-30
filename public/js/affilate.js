$(document).ready(function () {
    $(document).ready(function(){
        $.ajax({
            url: 'http://localhost:8000/api/action',
            type: 'post',
            cache: false,
            dataType: 'JSON',
            data: {
                'user_code': getCookie('uc'),
                'data_customer': data_info
            },
            success: function(data) {
            //    console.log(data);
                if (data.message == 'error') {
                    return false;
                } 
    
            }
        });
    })
});