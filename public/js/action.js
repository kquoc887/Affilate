$(document).ready(function () {
   

    // Bắt sự kiển đổi giao diện khi người dùng bấm vào nút đăng ký trên trang
    $(document).on('click', '.btn-register', function(event) {
        $(this).parents('div.region-action').find('h2').text('Đăng nhập');
        $(this).parents('div.region-action').find('.btn-group').empty().append('<button id="btn-login">Đăng nhập</button>');
      
        // refreshValidate($('#frmLogin').attr('id'));
        if ($(this).val() == 'Advertiser') {
            $('#frmRegisterAd').css('display', 'block');
        }

        if ($(this).val() == 'Publisher') {
            $('#frmRegisterPub').css('display', 'block');
        }

        $('#frmLogin').css('display', 'none');
       
    });

    // Bắt sự kiển đổi giao diện khi người dùng bấm vào nút đăng nhập trên trang
    $(document).on('click', '#btn-login', function(event) {
        var create_button = '<button class="btn btn-success btn-register" value="Advertiser">Advertise</button>';
            create_button += '<button class="btn btn-danger btn-register" value="Publisher">Publisher</button>'
        $(this).parents('div.region-action').find('h2').text('Đăng ký');
        $(this).parents('div.region-action').find('.btn-group').empty().append(create_button);
        $('#frmRegisterAd, #frmRegisterPub').css('display', 'none');
        $('#frmLogin').css('display', 'block');
        $('p#form_result').html('');
    });

    $(document).on('click', 'li.nav-item', function() {
        $(this).next().find('a.nav-link').removeClass('active');
        $(this).prev().find('a.nav-link').removeClass('active');
        nav_link = $(this).find('a.nav-link');
        $('li.nav-item').removeClass('menu-open');
        $(this).find(nav_link[0]).toggleClass('active');
        $('ul.nav-treeview').css('display', 'none');
        $(this).find('ul.nav-treeview').css('display', 'block');
    });

    // Bắt sự kiện khi người dùng bấm đăng ký
    $('#frmRegisterAd, #frmRegisterPub').on('submit', function(event) {
        event.preventDefault();
        var formId = $(this).attr('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: route('postSignUp'),
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(data, status) {
                // console.log(data);
                refreshValidate(formId);
                //Kiểm tra người dùng có nhập đầy đủ thông tin không.
                if (data.errors) {
                    checkValidate(data.errors, formId);
                } 

                if (data.success) {
                    $('#' + formId + ' #form_result').html(data.success);
                    $('#' + formId)[0].reset();
                } else {
                    
                    $('#' + formId + ' #form_result').html('');
                }
            }
        });
    });

    // Bắt sự kiện khi người dùng đăng nhập
    $(document).on('click', '#login', function(event) {
        event.preventDefault();
        var email = $(this).parents('#frmLogin').find('input[name=email]').val();
        var password = $(this).parents('#frmLogin').find('input[name=password]').val();
        var formId = $(this).parents('#frmLogin').attr('id');
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: route('checkLogin'),
            type: 'post',
            cache: false,
            dataType: 'JSON',
            data: {
                'email': email,
                'password': password
            },
            success: function(data) {
                refreshValidate(formId);
                // Kiểm tra người dùng có nhập đầy đủ thông tin không.
                if (data.errors) {
                    checkValidate(data.errors, formId);   
                }                

                if (data.success) {
                    $('#frmLogin').submit();
                }
            }
        });
    });

    // Thêm các giá trị cần search
    $(document).on('click', '#addColumnSearch', function(event) {
        var html = '<div class="form-inline offset-md-5 mb-2">';
            html += '<select class="form-control"></select>';
            html += '<input type="text" class="form-control"/>' 
            html += '<button type="button" class="btn btn-flat btn-success ml-1" id="close-field">-</button></div>'
        $(this).parents('div.region-search').append(html);
    });

    // Bỏ đi một giá search
    $(document).on('click', '#close-field', function() {
        $(this).parent().remove();
    });

  
    $(document).on('click', 'button[name=register-advertiser]' ,function(){
        var org_id = $(this).attr('id');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $(this).parents('#frmLogin').find('input[name=_token]').val()
            }
        })

        $.ajax({
            url: route('publisher.registerAdvertiser'),
            type: 'post',
            data: {
                'org_id': org_id,
            },
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                swal("Thông báo", "Bạn đã đăng ký làm công tác viên của công ty " + data.org_name, "success");
            },
        });
    });



    $(document).on('click','#request',function(e){
        e.preventDefault();
       
        var email =  $(this).parents('#frmForgotPass').find('input[name=email]').val();
        var span_error = $(this).parents('#frmForgotPass').find('div.form-group label>span#email_error');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        $.ajax({
            url : route('check-email'),
            type : "post",
            data : {
                postMail :email,
            },
            // contentType: false,
            cache:false,
            // processData:false,
            dataType:"JSON",
            success:function(data){
               
                
                if (data.error) {
                  span_error.html(data.error);
                }
                if (data.message) {
                    $('#frmForgotPass').submit();
                }
            }

        });
    });
});


function checkValidate(arrayError, formId) {
    var arr = [];
    
    for (var i in arrayError) {
       arr[i] = arrayError[i];
       
    }

   for (var item in arr) {
        if (arr[item] != '') {
            $( '#' + formId  +' #'+ item +'_error').html(arr[item]);
        } else {
            $( '#' + formId  +' #'+ item +'_error').html(arr[item]);
        }
    }
}

function refreshValidate(formId) {
    var span_error = $('#' + formId + ' .form-group label>span');
    for (var index = 0; index < span_error.length; index++) {
        span_error[index].innerHTML = '';
     }
}