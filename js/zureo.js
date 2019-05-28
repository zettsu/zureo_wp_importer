jQuery(document).on('click', "#zureo-importer-buttom",function(){
    jQuery.ajax({
        type: "get",
        url: zureo_ajax.ajaxurl,
        data: { action: 'get_last_sync' },
        dataType: 'json'
    }).done(function( msg ) {
        alert( "Data Saved: " + msg.last_sync );
    });
});