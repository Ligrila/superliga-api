var Site = {};


Site.init = function(){

  $('#calendar-carousel').carousel({ 
              interval: 10000
  });

  $("#date-id").change(function(){
      $("#date-id").parents("form").submit();
    }
  );


}

$(Site.init);
