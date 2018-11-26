"use strict"

const url ='/api/login';

class AuthService {

  static login(data) {
	  return axios.post(`${url}`,{
	   	email: data.email,
      password: data.password
    });
  }

  static logout(){
  	return axios.delete('/api/logout');
  }

  static usuario(){
  	return axios.get('/api/usuario');
  }

}

module.exports = AuthService;