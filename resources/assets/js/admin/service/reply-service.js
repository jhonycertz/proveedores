"use strict"

const url ='/api/reply';

class ReplyService {

  static index(search, page = 1){
  	return axios.get(`${url}`,{ params:{ page: page, search: search }});
  }

  static getById(id) {
    return axios.get(`${url}/${id}`);
  }

  static delete(id) {
    return axios.delete(`${url}/${id}`);
  }

  static save(data,item) {
  	if(data.id){
	    return axios.put(`${url}/${data.id}`,{
        reply: data.reply,
	    });
	}
	else{
	    return axios.post(`${url}`,{
	    	reply: data.reply,
        question_id: item.id
	    });
	}
  }

}

module.exports = ReplyService;