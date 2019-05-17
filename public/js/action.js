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
});