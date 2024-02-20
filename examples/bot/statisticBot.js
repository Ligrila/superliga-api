import Bot from './bot'
import Config from './config'
const usersCount = Config.bots;
const usernamePresset = "test-user-{NUMBER}@mocla.us";
const userPassword = "mocla_11";

for (let index = 1; index <= 1; index++) {
    console.log(index);
    const username = usernamePresset.replace("{NUMBER}",index);

    let bot = new Bot(username,userPassword);
    bot.init(false);
    setTimeout(
        () => {
            bot.finish("0e596162-1460-4009-b639-445509f2ce19");
        },
        1000
    )
    
    
}
