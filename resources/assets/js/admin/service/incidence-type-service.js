"use strict"

const url ='/api/incidence-type';

class IncidenceTypeService {

  static index(search, page = 1){
  	return axios.get(`${url}`,{ params:{ page: page, search: search }});
  }

  static indexAll(search, page = 1){
  	return axios.get(`${url}`,{ params:{ all: true } });
  }

	static getById(id) {
    return axios.get(`${url}/${id}`);
  }

  static delete(id) {
    return axios.delete(`${url}/${id}`);
  }

  static save(path, id,  data) {
    console.log(data, id);
      return axios.post(`${url}/${data.id}/save`, {
				description: data.description,
				incidence_type_id: data.tipo,
				document_id: id
	    });
  }
  
  static newType(data){
    return axios.post(`${url}/newType`, data);
  }

}

module.exports = IncidenceTypeService;