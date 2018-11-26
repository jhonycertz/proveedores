"use strict"

const url ='/api/company';

class CompanyService {

  static index(search, page = 1, status = null ){
    let filter  = { page: page, search: search };
    if(status){
      filter.status = status;
    }
  	return axios.get(`${url}`,{ params: filter });
  }

  static nuevas(search, page = 1 ){
    return CompanyService.index(search,page,'ESPERA');
  }

  static enProceso(search, page =1 ){
    return CompanyService.index(search,page,'EN-PROCESO');
  }

  static aprobada(search, page =1 ){
    return CompanyService.index(search,page,'APROBADA');
  }

  static rechazada(search, page =1 ){
    return CompanyService.index(search,page,'RECHAZADA');
  }

  static getById(id) {
    return axios.get(`${url}/${id}`);
  }

  static getByIdFull(id) {
    return axios.get(`${url}/${id}/documents`);
  }

  static delete(id) {
    return axios.delete(`${url}/${id}`);
  }

  static save(data) {
    return axios.put(`${url}/${data.id}`,{
    	type: data.type,
      requeriments: data.requeriments,
    });
  }

  static procesar(data){
    return axios.put(`${url}/${data.id}/procesar`);
  }

  static reprobar(data){
    return axios.delete(`${url}/${data.id}/reprobar`);
  }

  static aprobarDocumento(data){
    return axios.put(`${url}/${data.id}/aprobar`);
  }
  
  static aprobarEmpresa(data){
    return axios.put(`${url}/${data.id}/aprobar-empresa`);
  }
  static acceptDocument(data){
    return axios.post(`${url}/${data.id}/accept-doc`, data);
  }
  static rejectDocument(data){
    return axios.post(`${url}/${data.id}/reject-doc`, data);
  }
  static createDate(data){
    return axios.post(`${url}/${data.id}/create-date`, data);
  }
  
  

}

module.exports = CompanyService;