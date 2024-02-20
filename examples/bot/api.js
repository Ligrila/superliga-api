
import Config from './config'
import RestClient from './lib/RestClient'
export default class Api extends RestClient {
  constructor () {
    // Initialize with your base URL
    super(Config.endpoint);
  }
  async accessTokenExpired(){
    
    var user = await this.token(refreshToken)
    if(user.success){

    } else{
     
    }
  }
  // Now you can write your own methods easily
  login (email, password) {
    // Returns a Promise with the response.
    return this.POST('/users/login', { email, password },{authorizationHeader:false});
  }
  register (first_name,last_name,email, password,referral_username) {
    const sha1 = require('js-sha1');
    // Returns a Promise with the response.
    const hash = sha1( 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA' + email.toUpperCase() + 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA');
    return this.POST('/users/add', { first_name,last_name,email, password, referral_username, hash },{authorizationHeader:false});
  }
  token (refresh_token) {
    // Returns a Promise with the response.
    return this.POST('/users/token', { refresh_token },{authorizationHeader:false});
  }
  getTeams(){
    return this.GET('/teams/index',{authorizationHeader:false});
  }
  googleLogin (access_token) {
    // Returns a Promise with the response.
    return this.POST('/users/google-login', { access_token });
  }
  facebookLogin (access_token) {
    // Returns a Promise with the response.
    return this.POST('/users/facebook-login', { access_token });
  }
  getCurrentUser () {
    // If the request is successful, you can return the expected object
    // instead of the whole response.
    return this.GET('/auth')
      .then(response => response.user);
  }
  
  getUserInformation(){
    return this.GET('/users/me');
  }

  getTrivias(){
    return this.GET('/trivias/index');
  }
  getNextTrivia(){
    return this.GET('/trivias/next');
  }
  getCurrentTrivia(){
    return this.GET('/trivias/current');
  }

  sendAnswer(question_id,option){
    return this.POST('/answers/add',{
      question_id: question_id,
      selected_option: "option_" + option
    });
  }

  changeAvatar(uri){
    
    let formData = new FormData();
    let uriParts = uri.split('.');
    let fileType = uriParts[uriParts.length - 1];
    const photorand = Math.floor(Math.random()* 1000000);

    formData.append('picture', {
      uri,
      name: `photo_${photorand}.${fileType}`,
      type: `image/${fileType}`,
    });

    return this.POST('/users/edit',formData);
  }

  // premios

  getAwards(){
    return this.GET('/awards/index');
  }

  changePoints(award_id){
    return this.POST('/awards/change-points',{award_id});
  }

  //calendario
  // Dates -> Trivia

  calendar(){
    return this.GET('/dates/calendar');
  }

  viewCalendar(id){
    return this.GET(`/dates/view/${id}`);
  }

  getLivePacks(){
    return this.GET('/live-packs/index');
  }

  purchase(item){
    return this.GET('/payments/buy/'+item.id);
  }

  pushNotificationsRegister(token){
    return this.POST('/push-notifications/add',{
      token
    });
  }

  getStatistics(){
    return this.GET('/users/statistics');
  }
  getTriviaStatistics(trivia_id){
    return this.GET('/users/trivia_statistics/'+trivia_id);
  }

};


