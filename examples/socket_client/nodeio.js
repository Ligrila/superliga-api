const WebSocket = require('ws');
var connection = new WebSocket("ws://localhost:8889");
console.log(connection);
connection.onopen = function(){
  console.log("init websocket");
} ;

connection.onerror = function(e){
  console.log(e);
};


connection.onmessage = function(payload) 
{
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
    self.onMessage(msg);
  }
};