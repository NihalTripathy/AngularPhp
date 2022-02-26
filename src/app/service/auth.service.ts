import { Injectable } from '@angular/core';
import { HttpClientService } from 'src/app/service/httpClient/http-client.service';
import {config} from '../config';
@Injectable({
  providedIn: 'root'
})
export class AuthService {
  isLoggedIn = false;
  constructor(
    private httpClient: HttpClientService,
  ) { }
  public register(REGISTER_DATA) {
    let DATA = null;
    const data: object = {
      'username': REGISTER_DATA.username,
      'password': REGISTER_DATA.password,
    };
    return this.httpClient.postRegister(config.apiUrl+'/Auth/registration', data);
  }
  public login(LOGIN_DATA) {
    let DATA = null;
    const data: object = {
      'username': LOGIN_DATA.username,
      'password': LOGIN_DATA.password,
    };
    return this.httpClient.postRegister(config.apiUrl+'/Auth/registration_login', data);
  }
}
