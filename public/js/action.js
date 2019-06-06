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
    $(document).on('click', '#btn-search-all', function() {
        $('#inputFromdate').val(''),
        $('#inputToDate').val(''),
        $('#table-sale').DataTable({
            destroy: true,
            searching: true,
            paging: true,
            language: {
                "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                "search" : "Tìm kiếm:",
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
                { data: 'discount', name: 'discount'},
                { data:'created_at', name:'created_at' },
            ],
            columnDefs: [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
           
            
        });
    });
  
    $(document).on('click', '#btn-search', function(event) {
        if ( $('#inputFromdate').val() == '' ||  $('#inputToDate').val() == '') {
            swal({
                title: 'Lỗi',
                text: 'Bạn chưa chọn ngày bắt đầu hoặc ngày kết thúc',
                icon: 'error'
              });
            return false;
        }
    
        $('#table-sale').DataTable({
            destroy: true,
            searching: true,
            paging: true,
            language: {
                "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                "search" : "Tìm kiếm:",
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
                { data: 'discount', name: 'discount'},
                { data:'created_at', name:'created_at' },
            ],
            columnDefs: [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
             } ],
        });
        
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


   $(document).on('change', '#frmUpdateProfile input[name=fileAvatar]', function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $('#frmUpdateProfile img#img-avatar').fadeIn('fast').attr('src', tmppath);
        
   });
     //Tim hoa hong theo thang
     $(document).on('change','select[name=selectMonth]',function(){

        var option = $(this).val();
        var t = $('#payment_ad').DataTable({
            destroy:true,
            searching: false,
            language: {
                "lengthMenu": "Hiển thị _MENU_ đơn hàng",
                "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
            },
            processing : true,
            severSide: true,
            ajax:{
                url: route('getDataPayment'),
                data:{
                    optionMonth: option
                }
            },
            columns: [
                {data:'STT',name:'STT'},
                {data:'fullname',name:'fullname'},
                {data:'totalProfit',name:'totalProfit'},
                {data:'commision',name : 'commision'},
                {data:'total',name:'total'},
                {data:'action',name:'action'},
            ],
            columnDefs: [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
            } ],
        });
        t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            }).draw();
        })
    })

    $(document).on('click', '.btn_payment', function(event) {

        var btnPayment = $(this);
        $.ajax({
                url : route('postPay'),
                type : 'post',
                headers: {   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : {
                    user_link_id : $(this).attr('data-content'),
                },
                dataType :"JSON",
                success: function(data){
                    if (data.message == 'success'){
                        swal("Thông báo", "Thanh toán thành công").then(() => {
                            btnPayment.attr('disabled', true);
                        });
                    
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