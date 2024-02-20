const usersCount = 5000;
const sleepCount = 1500;
const sleepTime = 20000;

const usernamePresset = "test-user-{NUMBER}@mocla.us";
const userPassword = "mocla_11";
const sha1 = require('js-sha1');
//const endpoint = 'http://stageprod.jugadasuperliga.mocla.us/api/users/add';
const endpoint = 'http://afa-loadbalancer-1800168112.sa-east-1.elb.amazonaws.com/api/users/add';



const fetch = require("node-fetch");

async function add(opts){
    let ret = {};
    const response = await fetch(endpoint, opts)
    .then(async function(response) {
        ret  = (await response.text());
      })
console.log(ret);
      //console.log(ret);
      return ret.indexOf("success") >= 0;
}

let successCount = 0;
let failCount = 0;
async function addWrap(opts,index){
    const success = await add(opts);

    if(!success){
        console.log(index + " fail");
        failCount++;
    } else{
        successCount++;
    }
}

function sleep(ms){
    return new Promise(resolve=>{
        setTimeout(resolve,ms)
    })
}

async function start(){
for (let index = 1; index <= usersCount; index++) {
    const username = usernamePresset.replace("{NUMBER}",index);
    const hash = sha1( 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA' + username.toUpperCase() + 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA');
    const opts = {
        'method':'POST',
        body: JSON.stringify({
            email: username,
            hash: hash,
            first_name: 'Test',
            document: 123456789012 + index,
            mobile_number: 123456789012 + index,
            last_name : 'User ' + index,
            password: userPassword
            }),
            headers:{
                'Content-Type': 'application/json'
              }
        }


        addWrap(opts,index);
        if(index % sleepCount == 0 ){
            console.log("sleep :(",index  )
            await sleep(sleepTime)
        }

}

}

start();
