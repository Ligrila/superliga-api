import Api from './api'
import SocketClient from './SocketClient';

const fs = require('fs');



export default class Bot{
    constructor(username,password){
        this.username = username
        this.password = password
        this.logFile = "/tmp/bot_" + this.username.replace("@","_") + '.json'
        this.api = new Api
    }
    initFile(){
        fs.writeFile(
            this.logFile,             
             "BOT " + this.username + "\n ------------------ \n",
             function(err) {
                if(err) {
                    return console.log(err);
                }
            
                
            }
        );
    }
    log(msg, obj){
        fs.appendFile(
            this.logFile,             
             msg + '\n' + '-------------------------- \n' +
             JSON.stringify(obj) + "\n",
             function(err) {
                if(err) {
                    return console.log(err);
                }
            
                //console.log("The file was saved!");
            }
        );
    }
    async init(initWebsocket=true){
        try{
            const login = await this.login();

        } catch(e){
            console.log(e);

        }
        this.api.setToken(this.token);
        this.initFile();
        if(initWebsocket)
            this.initWebsocket();        

    }

    initWebsocket(){
        this.socket = new SocketClient(this);

    }

    async login(){
        try{
        const tokenPath = '/tmp/token_bot_' +  this.username.replace("@","_") + '.json';
        if (fs.existsSync(tokenPath)) {
            // Do something
            this.token = fs.readFileSync(tokenPath,'utf8');
            return true;
        }

            const ret = await this.api.login(this.username,this.password);
            if(ret && ret.success){
                this.token = ret.data.access_token;
                fs.writeFile(
                    tokenPath,             
                     this.token,
                     function(err) {                    
                    }
                );
            } else{
                console.warn("Cannot login with " + this.username);
                this.log("LOGIN ERROR",ret);
                return;
            }
            return ret;

        } catch(e){
            console.log(e);
        }
    }

    async answerQuestion(question){
        const timeout =  Math.floor((Math.random()*15000)+1)
        const q =  Math.floor((Math.random()*3)+1)
        Math.random()
        console.log(timeout);
        setTimeout(
            async () => {
                const response = await this.api.sendAnswer(question.id,q);
                console.log(response);
                this.log("sendAnswer " + timeout,response);
            },
            timeout
        )

    }
    async finish(id){
        const response = await this.api.getTriviaStatistics(id);
        this.log("finish",response);

    }
    async updateUser(){
        const info = await this.api.getUserInformation();
        if(this.username=='test-user-1@mocla.us'){
            console.log(info);
        }
        this.log("UPDATE USER",info);
    }

}