$(document).ready(function () {
    // Xét trên url có tham số không có mới tạo cookie trên mấy client
    if (window.location.search.substring(1) != '') {
        var queryString = window.location.search.substring(1).split('=');
        // Xét thời gian tồn tại của cookie
        var date = new Date();
        date.setTime(date.getTime() + (30*24*60*60*1000));
        var expires = "expires=" + date.toUTCString();
        // Tạo cookie trên mấy client
        document.cookie = queryString[0] + '=' + queryString[1] + ';' + expires;
     
   }

  

});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

