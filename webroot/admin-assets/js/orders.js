var Orders = {};

Orders.index = function(){
  $('.order-status-form select').change(function(){
    $(this).parents("form").submit();
  });;
}
