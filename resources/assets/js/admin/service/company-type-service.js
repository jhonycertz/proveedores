"use strict"

const url ='/api/company-type';

class CompanyTypeService {

  static index(search, page = 1){
  	return axios.get(`${url}`,{ params:{ page: page, search: search }});
  }

  static getById(id) {
    return axios.get(`${url}/${id}`);
  }

  static delete(id) {
    return axios.delete(`${url}/${id}`);
  }

  static save(data) {
  	if(data.id){
	    return axios.put(`${url}/${data.id}`,{
	    	type: data.type,
        requeriments: data.requeriments,
	    });
	}
	else{
	    return axios.post(`${url}`,{
	    	type: data.type,
        requeriments: data.requeriments,
	    });
	}
  }

}

module.exports = CompanyTypeService;