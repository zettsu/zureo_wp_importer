jQuery(document).on('click', "#zureo-importer-sync",function(){
    jQuery.ajax({
        type: "get",
        url: zureo_ajax.ajaxurl,
        data: { action: 'get_today_sync' },
        dataType: 'json'
    }).success(function(data){
        console.log(data);
    }).done(function( msg ) {
        alert( "Finalizado: " + msg );
    });

});

//jQuery("#datepicker").datepicker();
jQuery(document).on('submit','#zureo-importer-period', function(e){
    e.preventDefault();
    jQuery.ajax({
        type: "get",
        url: zureo_ajax.ajaxurl,
        data: { action: 'get_period_sync', start_date: jQuery("#start_date").val(), end_date: jQuery("#end_date").val()  },
        dataType: 'json'
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
    });
});
