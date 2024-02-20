/*
  Si hay problemas en IOS de user agent undefined cambiar
  vendor websockhop el archivo browserDetection.js al principio con
  esto:
    if(typeof(ua)=='undefined'){
        ua = 'react-native';
    }
*/
import WebSockHop from './websockhop/src/index';

//const WebSocket = require('ws');
//var WebSocket = require('websocket-lib');
var WebSocket = require('websocket').w3cwebsocket;




import ActionDispatcher from '../action_dispacther';
import Config from '../config';



export default class SocketClient{
    constructor(bot){
        //WebSockHop.logger = this.logger;
        this.bot = bot;
        try{
            WebSockHop.log = () => {};
            this.actionDispatcher = new ActionDispatcher(this.bot);
            this.socket = new WebSockHop(Config.socket, {
              createSocket: function (url) {
                const instance = new WebSocket(url);

                /*instance.close = function(){
                  console.log("trying to call close");
                }*/
                return instance;
              }
            });
      
            this.socket.formatter = new WebSockHop.JsonFormatter();

            this.socket.on('opened', function () {
              //ConnectionStatusActions.set(true);
              //console.log('open connection');
            });
            this.socket.on('message', (message) => {
              if(typeof(message.eventName)=='string'){
                this.actionDispatcher.dispatch(message);
              }
            });
      
            this.socket.on('error', function (v,c) {

            });
      
            this.socket.on('closed', function() {
              this.socket = null;
            });
        } catch(e){
          console.log("errir");
          console.log(e);
        }

    }

    close(){
      this.socket.close();
    }

    logger(type, message){
        if(__DEV__)
            console.log("Socket: " + type + "-" + message);
    }
}