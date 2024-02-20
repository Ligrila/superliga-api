var  matchController = function(){
  var c = Request.controller;
  var a = Request.action;

  if(typeof(window[c])=='object'&&typeof(window[c][a])=='function'){
      console.log("Loading " + c + "::"+a);
      window[c][a]();
  }

}()
