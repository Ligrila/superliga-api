const WebSocket = require('ws');
var connection = new WebSocket("ws://superliga.mocla.us:8889");
//var connection = new WebSocket("http://stage.jugadasuperliga.mocla.us/wss");

connection.onopen = function(){
  console.log("init websocket");
} ;

connection.onerror = function(e){
  console.log(e);
};


connection.onmessage = function(payload) 
{
  console.log(payload.data);
  var self = this;
  var data = payload.data;
  if(data.cmd)
  {
    data = JSON.parse(payload.data);
    var cmd = data.cmd;
    var func = 'on' + cmd.charAt(0).toUpperCase() + cmd.slice(1).toLowerCase();
    self[func](data.data);
  }
  else
  {
    var msg = payload.data;
    //self.onMessage(msg);
  }
};
