"use strict"

const url = '/api/dates';

class DatesService {

    static index() {

        return axios.get(`${url}`);
    }
    static getById(id) {
        var data = {
            id: id
        }
        return axios.post(`${url}/getUserById`, data);
    }
    static updateDate(data, newdate) {
        data.newdate = newdate;
        return axios.post(`${url}/updateDate`, data);
    }
    static getOnlyOne(data) {
        return axios.post(`${url}/getOnlyOne`, data);
    }
    static updateAttendant(data) {
        return axios.post(`${url}/updateAttendant`, data);
    }
    static updateUser(data) {
        return axios.post(`${url}/updateUser`, data);
    }
    static deleteUser(id) {
        var data = {
            id: id
        };
        return axios.post(`${url}/deleteUser`, data);
    }


}

module.exports = DatesService;