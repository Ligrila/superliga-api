




export default class ActionDispatcher{
    constructor(bot){
        this.bot = bot;
    }
    
    dispatch(message){
        switch(message.eventName){
            case 'updateConnectedUsers':
                // nuevos usuarios
                break;
            case 'newQuestion':
                // preguntas
                this.bot.answerQuestion(message.payload)
                break;
            case 'finishHalfTime':
                // no importa
                break;
            case 'startHalfTimePlay':
                // no importa
                break;
            case 'startExtraPlay':
                // no importa
                break;
            case 'startHalfTime':
                // no importa
                break;
            case 'finishGame':
                // no importa
                break;
            case 'finishTrivia':
                // terminar app
                this.bot.finish(message.payload.id);

                break;
            case 'startTrivia':
                // no importa
                break;
            case 'finishedQuestion':
                // reproducir update
                // -> UsersActions.update();
                this.bot.updateUser();
                break;
            default:
                console.warn("Unknow action name : " + message.eventName);
                break;
        }
    }
}