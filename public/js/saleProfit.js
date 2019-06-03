var  click = 0;
var click_to_date = 0;
$(document).on('click','#addFieldSearch',function(){
    if(click == 0){
        var html = '<div id="FromDate" class="form-inline offset-md-5 mb-2" style="padding-top:2%">';
        html += '<input type="text" style="width:70px;height:40px" disabled placeholder="Từ Ngày:">';
        html += '<input type="Date" class="form-control" id="from-date" />' ;
        html += '<button type="button" class="btn btn-flat btn-success ml-1" id="to-date">Đến Ngày</button>';
        html += '<button type="button" class="btn btn-flat btn-success ml-1" id="FromToDate">Tìm kiếm</button>';
        html += '<button type="button" class="btn btn-flat btn-success ml-1" id="close-all-field">-</button></div>';
        $(this).parents('div.region-search').append(html);
        click+=1;
    }
    return click;
})
$(document).on('click','#to-date',function(){
    if(click_to_date == 0)
    {
        var html = '<div id="ToDate" class="form-inline offset-md-5 mb-2" style="padding-top:2%">';
        html += '<input type="text" style="width:80px;height:40px" disabled placeholder="Đến Ngày:">';
        html += '<input type="Date" class="form-control" id="toDate"/>' ;
        html += '<button type="button" class="btn btn-flat btn-success ml-1" id="close-field-todate">-</button></div>';
        $(this).parents('div.region-search').append(html);
        click_to_date+=1;
    }
    return click_to_date;
})
$(document).on('click', '#close-all-field', function() {
    $('#FromDate').remove();
    $('#ToDate').remove();
    return click = 0,click_to_date = 0;
});
$(document).on('click', '#close-field-todate', function() {
    $('#ToDate').remove();
    return click_to_date = 0;
});

$(document).on('click','#FromToDate',function(){
    if(click_to_date==0)
    {
        
        $('#sale_profit_ad').dataTable().fnDestroy();
        var t = $('#sale_profit_ad').DataTable({
            searching: false,
            language: {
                "lengthMenu": "Hiển thị _MENU_ đơn hàng"
            },
           processing : true,
           severSide: true,
           ajax:{
              url: route('SaleProfitFromToDate'),
              data:{
                    fromdate: $('#from-date').val()
              }
           },
           columns: [
                {data:'STT',name:'STT'},
                {data:'fullname',name:'fullname'},
                {data:'order_id',name:'order_id'},
                {data:'total',name:'total'},
                {data:'created_at',name : 'created_at'},
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
              } ).draw();
        
      }
    else{
        $.ajax({
            url: route('SaleProfitFromToDate'),
            data:{
                fromdate: $('#from-date').val(),
                todate : $('#toDate').val()
            },
            success:function(data){
                console.log(data);
            }
        });
        // $('#sale_profit_ad').dataTable().fnDestroy();
        // var t = $('#sale_profit_ad').DataTable({
        //     searching: false,
        //     language: {
        //         "lengthMenu": "Hiển thị _MENU_ đơn hàng"
        //     },
        //    processing : true,
        //    severSide: true,
        //    ajax:{
        //       url: route('SaleProfitFromToDate'),
        //       data:{
        //             fromdate: $('#from-date').val(),
        //             todate : todate,
        //       },
        //       success:function(data){
        //           console.log(data);
        //       }
        //    },
        //    columns: [
        //         {data:'STT',name:'STT'},
        //         {data:'fullname',name:'fullname'},
        //         {data:'order_id',name:'order_id'},
        //         {data:'total',name:'total'},
        //         {data:'created_at',name : 'created_at'},
        //         {data:'action',name:'action'},
        //    ],
        //    columnDefs: [ {
        //               "searchable": false,
        //               "orderable": false,
        //               "targets": 0
        //       } ],
        //  });
        //  t.on( 'order.dt search.dt', function () {
        //           t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //               cell.innerHTML = i+1;
        //           } );
        //       } ).draw();
        
    }
})