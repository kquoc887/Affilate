$(document).ready(function () {

    // Bắt sự kiển đổi giao diện khi người dùng bấm vào nút đăng ký trên trang
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

    $(document).on('click', 'button#clickNotifi',function(){
        
        $.ajax({
            url : route('saleProFit'),
            type : 'get',
            data : {
                id : $('#hidden-read').val(),
            },
            dataType :"JSON",
            success: function(data){
                if(data.success){
                    window.location.href = route('saleProFit');
                }
            }
        })
    })
   

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

        $.ajax({
            url: route('postSignUp'),
            type: 'post',
            data: new FormData(this),
            headers: {   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
                $('.loader').css('display', 'block');
            },
            success: function(data, status) {
                refreshValidate(formId);
                if (data.errors) {
                    checkValidate(data.errors, formId);
                } 

                if (data.success) {
                    $('#' + formId)[0].reset();
                } 
            },
            complete: function(data) {
                $('.loader').css('display', 'none');
                if (data.responseJSON.errors) {
                        swal("Thông báo", "Bạn đã gặp một số lỗi vui lòng kiểm tra lại");
                        return false;
                } 
                swal("Thông báo", "Bạn đã đăng ký thành công vui lòng kiểm tra mail để kích hoạt");
              
            }
        });
    });

    // Bắt sự kiện khi người dùng đăng nhập
    $(document).on('click', '#login', function(event) {
        event.preventDefault();
        var email = $(this).parents('#frmLogin').find('input[name=email]').val();
        var password = $(this).parents('#frmLogin').find('input[name=password]').val();
        var formId = $(this).parents('#frmLogin').attr('id');

        $.ajax({
            url: route('checkLogin'),
            type: 'post',
            cache: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
            },
          
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

    // Bắt đầu phần JS tìm kiếm theo ngày
    //Bắt sự kiện tạo vùng search theo ngày
    $(document).on('click','#addFieldSearch',function(){
            var html = '<div id="FromDate" class="form-inline offset-md-5 mb-2" style="padding-top:2%">';
            html += '<input type="text" style="width:70px;height:40px" disabled placeholder="Từ Ngày:">';
            html += '<input type="Date" class="form-control" id="inputFromdate" />' ;
            html += '<button type="button" class="btn btn-flat btn-success ml-1" id="btn-to-date">Đến Ngày</button>';
            html += '<button type="button" class="btn btn-flat btn-success ml-1" id="btn-search">Tìm kiếm</button>';
            html += '<button type="button" class="btn btn-flat btn-success ml-1" id="close-all-field">-</button></div>';
            $(this).parents('div.region-search').append(html);
            $(this).attr('disabled', true);
     
    })

    // Bắt sự kiện tạo ra vùng search đến ngày nào
    $(document).on('click','#btn-to-date',function(){
            var html = '<div id="ToDate" class="form-inline offset-md-5 mb-2" style="padding-top:2%">';
            html += '<input type="text" style="width:80px;height:40px" disabled placeholder="Đến Ngày:">';
            html += '<input type="Date" class="form-control" id="inputToDate"/>' ;
            html += '<button type="button" class="btn btn-flat btn-success ml-1" id="close-field-todate">-</button></div>';
            $(this).parents('div.region-search').append(html);
            $(this).attr('disabled', true);
    });

    // Đóng tất cả các vùng search
    $(document).on('click', '#close-all-field', function() {
        $('#FromDate').remove();
        $('#ToDate').remove();
        $('#addFieldSearch').attr('disabled', false);
        $('#table-sale').DataTable({
            destroy: true,
            searching: true,
            language: {
                "lengthMenu": "Hiển thị _MENU_ đơn hàng"
            },
           processing : true,
           severSide: true,
           ajax:{
              url: route('publisher.getDataOrder'),
           },
           columns: [
                { data: 'rownum', name: 'rownum'},
                { data: 'order_id', name: 'order_id' },
                { data: 'total', name:'total' },
                { data:'created_at', name:'created_at' },
            ],
        });
    });

    // Đòng vùng search đến ngày nào
    $(document).on('click', '#close-field-todate', function() {
        $('#ToDate').remove();
        $('#btn-to-date').attr('disabled', false);
    });

    $(document).on('click', '#btn-search', function(event) {
        var object = $('#btn-to-date').attr('disabled');
        if (typeof object === "undefined") {
            console.log(123);
        } else {
            $('#table-sale').DataTable({
                destroy: true,
                searching: false,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ đơn hàng"
                },
               processing : true,
               severSide: true,
               ajax:{
                  url: route('publisher.searchOrder'),
                  data:{
                        fromDate: $('#inputFromdate').val(),
                        toDate : $('#inputToDate').val(),
                  }
               },
               columns: [
                    { data: 'rownum', name: 'rownum'},
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total', name:'total' },
                    { data:'created_at', name:'created_at' },
                ],
            });
        }
    });
    // Kết thúc phần JS tìm kiếm theo ngày

  
    $(document).on('click', 'button[name=register-advertiser]' ,function(){
        var org_id = $(this).attr('id');
        var button_register = $(this);
        $.ajax({
            url: route('publisher.registerAdvertiser'),
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                'org_id': org_id,
            },
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                swal("Thông báo", "Bạn đã đăng ký làm công tác viên của công ty " + data.org_name, "success");
                button_register.attr('disabled', true);
            },
        });
    });



    $(document).on('click','#request',function(e){
        e.preventDefault();
        var email =  $(this).parents('#frmForgotPass').find('input[name=email]').val();
        var span_error = $(this).parents('#frmForgotPass').find('div.form-group label>span#email_error');
        $.ajax({
            url : route('check-email'),
            type : 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data : {
                postMail :email,
            },
            cache:false,
            dataType:"JSON",
            beforeSend: function() {
                $('.loader').css('display', 'block');
            },
            success:function(data){
               
                
                if (data.error) {
                  span_error.html(data.error);
                  $('.loader').css('display', 'none');
                  swal("Thông báo", "Bạn đã gặp một số lỗi vui lòng kiểm tra lại");
                }
                if (data.message) {
                    $('#frmForgotPass').submit();
                }
            },
        });
    });

   $(document).on('change', '#ckcChangePass', function() {
        var isChangePass = $('#ckcChangePass').is(":checked");
        if (isChangePass == true) {
            $('#frmUpdateProfile input[name=password]').removeAttr('disabled');
            $('#frmUpdateProfile input[name=repass]').removeAttr('disabled');
           
        } else {
            $('#frmUpdateProfile input[name=password]').attr('disabled','disabled');
            $('#frmUpdateProfile input[name=repass]').attr('disabled','disabled');
        }

   });

   $(document).on('change', '#frmUpdateProfile input[name=fileAvatar]', function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $('#frmUpdateProfile img#img-avatar').fadeIn('fast').attr('src', tmppath);
        
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