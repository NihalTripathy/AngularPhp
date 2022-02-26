import { Injectable } from '@angular/core';
import { HttpClientService } from 'src/app/service/httpClient/http-client.service';
import {config} from '../config';
@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(
    private httpClient: HttpClientService,
  ) { }

  public getAllProduct() {
    return this.httpClient.get(config.apiUrl+'/Auth/getProducts');
  }
  
  public deleteProduct(delete_data) {
    return this.httpClient.postRegister(config.apiUrl+'Auth/delete_product', delete_data);
  }
  public addProduct(REGISTER_DATA) {
    let DATA = null;
    const data: object = {
      'ptitle': REGISTER_DATA.ptitle,
      'pdesc': REGISTER_DATA.pdesc,
      'username': REGISTER_DATA.username,
    };
    return this.httpClient.postRegister(config.apiUrl+'Auth/add_product', data);
  }
  public updateProduct(REGISTER_DATA) {
    let DATA = null;
    const data: object = {
      'pid': REGISTER_DATA.pid,
      'ptitle': REGISTER_DATA.ptitle,
      'pdesc': REGISTER_DATA.pdesc,
      'username': REGISTER_DATA.username,
    };
    return this.httpClient.postRegister(config.apiUrl+'Auth/update_product', data);
  }
}
