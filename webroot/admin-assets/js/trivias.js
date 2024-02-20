Trivias = {};

Trivias.ioClient = function(){
    var socket = io('https://www.jugadasuperliga.com');
    socket.on('connect', function () {
      socket.on('updateConnectedUsers', function (msg) {
          var n = (msg.payload);
        $("#connected-users-2").text(n);
      });
    });
}


Trivias.socketClient = function(){
    //"ws://superliga.mocla.us:8889"
    var connection = new WebSocket(Request.websocketUrl);


    connection.onopen = function(){
      console.log("init websocket");
    } ;

    connection.onerror = function(e){
      console.log(e);
    };

    var self = this;

    connection.onmessage = function(payload)
    {
      var data = JSON.parse(payload.data);
      if(data.eventName == 'updateConnectedUsers'){
        $("#connected-users").text(data.payload - 1000);
      }

    };
}

Trivias.currentGameStatus = function(){
    Trivias.socketClient();
    Trivias.ioClient();
}

Trivias.nextTrivia = function(){
    countdown.setLabels(
        ' milisegundo | segundo | minuto | hora | día | semana | meses | año | década | siglo | milenio',
        ' milisegundos | segundos | minutos | horas | días | semana | meses | años | décadas | siglos | milenios',
        ' y ',
        ' , ',
        'ahora');
    if($("#countdown").length>0){
        countdown( new Date($("#countdown").data().date),
            function(ts){
                $("#countdown").html(ts.toHTML('strong'));
            },
            countdown.HOURS|countdown.MINUTES|countdown.SECONDS
        );
    }
    if($("#countdown-generic-question").length>0){
    var redirected = false;
    countdown( new Date($("#countdown-generic-question").data().date),
        function(ts){
            $("#countdown-generic-question").html(ts.toHTML('strong'));
            if(ts.value > 0 && !redirected){
                redirected = true;
                window.location = $("#finish-question-button").attr("href");
                $("#finish-question-button").click();
            }
            //console.log(ts);
        },
         countdown.HOURS|countdown.MINUTES|countdown.SECONDS
        );
    }

}

Trivias.current = function(){
    Trivias.nextTrivia();
    $(".btn-add-question").click(function(){
        var $this = $(this);
        var loadingText = '<i class="fas fa-spinner fa-spin"></i> enviando pregunta...';
        $this.html(loadingText);
        return true;
    })
    var correctOptionModalTimeout = null;
    var optionsSteps = ["Cerrando respuestas correctas","Cerrando respuestas incorrectas","Generando puntos", "Actualizando vidas", "Notificando usuarios"];
    var currentOptionStep = 0;
    $(".btn-correct-option").click(function(){
        $("#set-correct-option-modal").modal('show');
        clearInterval(correctOptionModalTimeout);
        correctOptionModalTimeout = setInterval(function(){
            if(optionsSteps.length<=currentOptionStep){
                currentOptionStep = 0;
            }
            $("#modal-current-status").text(optionsSteps[currentOptionStep]);
            currentOptionStep++;
        },2000)

        return true;
    })
}
