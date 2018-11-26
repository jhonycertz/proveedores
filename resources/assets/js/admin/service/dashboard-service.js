"use strict"

const url = '/api/dashboard';

class DashboardService {

    static index() {
       
        return axios.get(`${url}`);
    }
    static getLogged() {
       
        return axios.get(`${url}/getLogged`);
    }
    static getMessages(){
        return axios.get(`${url}/getMessages`);
    }

    static nuevas(search, page = 1) {
        return CompanyService.index(search, page, 'ESPERA');
    }


}

module.exports = DashboardService;