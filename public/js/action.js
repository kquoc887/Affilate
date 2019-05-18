$(document).ready(function () {
    $(document).on('click', '.btn-register', function(event) {
        $(this).parents('div.region-action').find('h2').text('Đăng nhập');
        $(this).parents('div.region-action').find('.btn-group').empty().append('<button id="btn-login">Đăng nhập</button>');
        
        if ($(this).val() == 'Advertiser') {
            $('#frmRegisterAd').css('display', 'block');
        }

        if ($(this).val() == 'Publisher') {
            $('#frmRegisterPub').css('display', 'block');
        }

        $('#frmLogin').css('display', 'none');
    });

    $(document).on('click', '#btn-login', function(event) {
        var create_button = '<button class="btn btn-success btn-register" value="Advertiser">Advertise</button>';
            create_button += '<button class="btn btn-danger btn-register" value="Publisher">Publisher</button>'
        $(this).parents('div.region-action').find('h2').text('Đăng ký');
        $(this).parents('div.region-action').find('.btn-group').empty().append(create_button);
        $('#frmRegisterAd, #frmRegisterPub').css('display', 'none');
        $('#frmLogin').css('display', 'block');
    });

    $(document).on('click', 'li.nav-item', function() {
        $('li.nav-item').removeClass('menu-open');
        $('a.nav-link').removeClass('active');
        $('ul.nav-treeview').css('display', 'none');
        $(this).find('ul.nav-treeview').css('display', 'block');
        nav_link = $(this).find('a.nav-link');
        nav_link[0].classList.add('active');
    });

    // $('#frmRegisterAd, #frmRegisterPub').on('submit', function(event) {
    //     event.preventDefault();
    //     var formId = $(this).attr('id');
    //     // console.log($(this).find('input[name=_token]').val());
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $(this).find('input[name=_token]').val()
    //         }
    //     })

    //     $.ajax({
    //         url: route('postSignUp'),
    //         type: 'POST',
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function(data, status) {
    //             refreshValidate(formId);
    //             //Kiểm tra người dùng có nhập đầy đủ thông tin không.
    //             if (data.errors) {
    //                 checkValidate(data.errors, formId);
    //             } 

    //             if (data.success) {
    //                 console.log(data.success)
    //                 // $('#' + formId + ' #form_result').html(data.success);
    //                 // $('#' + formId)[0].reset();
    //             } else {
    //                 console.log(123);
                    
    //                 // $('#' + formId + ' #form_result').html('');
    //             }
    //         }
    //     });
    // });

  
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