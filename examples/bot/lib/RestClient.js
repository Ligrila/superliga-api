const fetch = require("node-fetch");


export default class RestClient {
    constructor (baseUrl = '', { headers = {}, devMode = false, simulatedDelay = 0 } = {}) {
      if (!baseUrl) throw new Error('missing baseUrl');
      this.headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      };
      Object.assign(this.headers, headers);
      this.baseUrl = baseUrl;
      this.simulatedDelay = simulatedDelay;
      this.devMode = devMode;
    }
    setToken(token){
      this.token = token;
    }
    async replayLastFetch(){

    }
    async accessTokenExpired(){
      console.warn("accessTokenExpired");
    }
    _simulateDelay () {
      return new Promise(resolve => {
        setTimeout(() => {
          resolve();
        }, this.simulatedDelay);
      });
    }
  
    _fullRoute (url) {
      return `${this.baseUrl}${url}`;
    }
  
    async _fetch (route, method, body, isQuery = false,options={}) {
      const defaultOptions = {
        authorizationHeader : true,
        redirect: 'follow'
      };
      options = {...defaultOptions,...options};
      if (!route) throw new Error('Route is undefined');
      var fullRoute = this._fullRoute(route);
      console.log("API REQUEST: " + fullRoute + " body: " + JSON.stringify(body));
      if (isQuery && body) {
        var qs = require('qs');
        const query = qs.stringify(body);
        fullRoute = `${fullRoute}?${query}`;
        body = undefined;
      }

      if(options.authorizationHeader){
        //add user token if it exists
        const userToken = this.token;
        if(userToken){
          this.headers = {...this.headers,'Authorization': 'Bearer ' + userToken};
        }
      }

      let opts = {
        method,
        headers: this.headers
      };
      if (body) {
        if(body.constructor.name!='FormData'){
          Object.assign(opts, { body: JSON.stringify(body) });
        } else{
          Object.assign(opts, { body: body });
          opts.headers['Content-Type'] = 'multipart/form-data';
          //console.log('opts',opts);

        }
      }
      const fetchPromise = () => fetch(fullRoute, opts);

      
      const extractResponse = response => {
        if (response.status >= 200 && response.status < 300) {
            return response.text().then(
              text => {
                return text? JSON.parse(text) : undefined
              }
            )
          }else {
            return Promise.reject(response)
          }

        };

      const manageError = async response => {
        console.log('reject url', this.url)
        console.log('reject',await response.text());
        
        try{
          if(typeof(response.text)!=='function'){
            return {
              success: false,
              error: response
            };
          }
          responseData = await response.text().then(
            (text) => {
              var ret = {
                success: false,
                error: response
              };
              //console.log(text);
              try{
                ret = text? JSON.parse(text) : undefined;
              } catch(e){
                return {
                  success: false,
                  response: response,
                  error: e
                };
              }
              return ret;
            }
          ).catch(e=>{
            return {
              success: false,
              response: response,
              error: e
            };
          });
          if(typeof(responseData.access_token_expired!='undefined') && responseData.access_token_expired){
            // call renew access token method
            this.accessTokenExpired();
          }

        } catch(e){
          return {
            success: false,
            response: response,
            error: e
          };
        }
      }
  
      if (this.devMode && this.simulatedDelay > 0) {
        // Simulate an n-second delay in every request
        return this._simulateDelay()
          .then(() => fetchPromise())
          .then(extractResponse)
          .catch(manageError);
      } else {
        return fetchPromise()
          .then(extractResponse)
          .catch(manageError);
      }
    }
  
    GET (route, query,options={}) { return this._fetch(route, 'GET', query, true, options); }
    POST (route, body, options={}) { return this._fetch(route, 'POST', body, false, options); }
    PUT (route, body,options={}) { return this._fetch(route, 'PUT', body,false,options); }
    DELETE (route, query,options={}) { return this._fetch(route, 'DELETE', query, true,options); }
  }