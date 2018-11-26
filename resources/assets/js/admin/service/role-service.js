"use strict"

const url = '/api/roles';

class RoleService {

    static index() {

        return axios.get(`${url}`);
    }
    static getById(id) {
        var data = {id: id}
        return axios.post(`${url}/getRoleById`, data);
    }
    static getChargesTypes() {

        return axios.get(`${url}/getChargesTypes`);
    }
    static getMessages() {
        return axios.get(`${url}/getMessages`);
    }
    static storeRole(data) {
        return axios.post(`${url}/storeRol`, data);
    }
    static updateRole(data) {
        return axios.post(`${url}/updateRole`, data);
    }
    static deleteRole(id) {
        var data = {id: id};
        return axios.post(`${url}/deleteRol`, data);
    }


}

module.exports = RoleService;