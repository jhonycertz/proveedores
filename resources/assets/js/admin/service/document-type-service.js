"use strict"

const url ='/api/document-type';

class DocumentTypeService {

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
	    	type: data.type
	    });
	}
	else{
	    return axios.post(`${url}`,{
	    	type: data.type
	    });
	}
  }

}

module.exports = DocumentTypeService;