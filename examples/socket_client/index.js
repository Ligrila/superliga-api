

var attemps = 0;
const endpoint = "ws://a63fdb5ed1d6e5f75.awsglobalaccelerator.com"
//const endpoint = "http://ec2-15-228-90-115.sa-east-1.compute.amazonaws.com";
function bindEvents(ws){
    ws.on('connect', function open() {
      console.log('Connected');
      attemps = 0;
    });

    ws.on('message', function incoming(data) {
      console.log(data,'message');
    });

    ws.on('message', function incoming(data) {
        console.log(data,'message');
      });

    ws.on('error', function incoming(data) {
        console.log(data,'error');
      });

      ws.on('newQuestion', function incoming(data) {
        console.log(data,'newQuestion');
      });

      ws.on('finishedQuestion', function incoming(data) {
        console.log(data,'finishedQuestion');
      });

    ws.on('close', function open() {
        console.log('Closed trying to recconect after 3 seconds. Attetmps: '+ attemps);
        setTimeout(function(){ recconect() }, 3000);

    });
}

function recconect(){
    attemps++;
    bindEvents(getClient());
}

function getClient(){
    try{
        return require('socket.io-client')(endpoint,{secure: true});
    } catch(e){
        console.log(e);
    }
}


//for (let index = 0; index < 425; index++) {
    //bindEvents(getClient());

//}

bindEvents(getClient());
