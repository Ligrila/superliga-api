var Table = {};

Table.removeRow = function(el){
      $(el).parents("tr").remove();
      return false;
}


$(function(){

})

  $("table tr .table-remove-row").click(function(e){
    e.preventDefault();
    Table.removeRow(this);
    return false;
  });
