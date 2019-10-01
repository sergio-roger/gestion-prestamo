//Clase para peticiones  ajax
'use strict'

var Ajax = class Ajax{

  url;  method; type; data;
  dataString; json; ok;
 
  constructor(url, method, data){
    this.url = url; 
    this.method = method;
    // this.type = type;
    this.data = data;
    this.dataString = JSON.stringify(data);
    this.json = '';
  }

  parametros() {
    var json = {
      url: this.url,
      metho:this.method,
      type:this.type,
      data:this.data
    };

    console.log(json);
  }

  __ajax(){
    var ajax = $.ajax({
      'method': this.method,
      'url':    this.url,
      'data':   {data: this.dataString}
    })
    return ajax;
  }

}





    
