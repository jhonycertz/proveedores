"use strict"

const url ='/api/requeriment';

class RequerimentService {

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
        name: data.name,
        code: data.code,
        required: data.required,
        requeriment_type_id: data.requeriment_type.id,
	    });
	}
	else{
	    return axios.post(`${url}`,{
        name: data.name,
        code: data.code,
        required: data.required,
        requeriment_type_id: data.requeriment_type.id,
	    });
	}
  }

}

module.exports = RequerimentService;