"use strict"

const url = '/api/users';

class UsersService {

    static index() {

        return axios.get(`${url}`);
    }
    static getById(id) {
        var data = {id: id}
        return axios.post(`${url}/getUserById`, data);
    }
    static getRoles() {

        return axios.get(`${url}/getRoles`);
    }
    static getMessages() {
        return axios.get(`${url}/getMessages`);
    }
    static storeUser(data) {
        return axios.post(`${url}/storeUser`, data);
    }
    static updateUser(data) {
        return axios.post(`${url}/updateUser`, data);
    }
    static deleteUser(id) {
        var data = {id: id};
        return axios.post(`${url}/deleteUser`, data);
    }


}

module.exports = UsersService;