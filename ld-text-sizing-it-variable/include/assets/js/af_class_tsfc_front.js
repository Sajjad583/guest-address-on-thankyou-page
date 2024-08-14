jQuery(document).ready(function($){
  var ajax_url= TSFC_URL.admin_url;
  var nonce= TSFC_URL.nonce;

   $( 'input.variation_id' ).change( function(){
          $(".variation_label_data").remove();  
    });
  $( 'input.variation_id' ).change( function(){
     product_class=$(this);
            if( '' != $(this).val() ) {
               var variation_id = $(this).val();
               // alert('You just selected variation #' + variation_id);
            }
     jQuery.ajax({
               type: "post",
               dataType: "json",
               url: ajax_url,
               delay: 1,
               data: {
                    action: 'get_variation_data',
                    variation_id: variation_id,
                    nonce:nonce,
               },
               success: function(response){
                    if(response['variation_html']){
                         console.log(response['variation_html']);
                         $('#variation_data').append(response['variation_html']);
                         $('#variation_data').find('.variation_label_data').show();
                    }
                    // if(response['order_search_html'] != undefined){

                    //      jQuery('table.order_table').find('tbody').html(response['order_search_html']);
                    // }
               }
          });
     });
});