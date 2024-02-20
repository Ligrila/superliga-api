import Bot from './bot'
import Config from './config'
const usersCount = Config.bots;
const usernamePresset = "test-user-{NUMBER}@mocla.us";
const userPassword = "mocla_11";
let offset = 0;
if(Config.offset){
    offset = Config.offset;
}

for (let index = 1; index <= usersCount; index++) {
    console.log(index);

    const username = usernamePresset.replace("{NUMBER}",index + offset);
    try{

        let bot = new Bot(username,userPassword);
        bot.init();
    } catch(e){

    }
    
}
