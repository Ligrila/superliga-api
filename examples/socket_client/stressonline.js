const WebSocket = require('ws');
const maxClients = 100;

for (let index = 0; index < maxClients; index++) {
    startClient(index);
    
}


function startClient(index) {
    //var connection = new WebSocket("ws://localhost:8889");
    var connection = new WebSocket("http://stage.jugadasuperliga.mocla.us/wss");
//    var connection = new WebSocket("https://www.jugadasuperliga.com/wss");
    
    connection.onopen = function(){
      console.log("init websocket " + index);
    } ;
    
    connection.onerror = function(e){
      console.log(e);
    };
    
    
    connection.onmessage = function(payload) 
    {
     if(index!=maxClients-1){
         return;
     }
      console.log(payload.data);
    };
        
}
