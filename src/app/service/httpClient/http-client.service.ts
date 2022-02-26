import { HttpClient, HttpHeaders, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Location } from '@angular/common';
import { Observable } from 'rxjs/internal/Observable';

// import { AppConstants } from '@app/app.constants';
// import { StorageService } from '@app/services/storage/storage.service';
// import { MenuModel } from '@app/menu/menu-model';
import { catchError } from 'rxjs/operators';
import { ClientErrorHandlerService } from '../ErrorHandler/client-error-handler.service';


@Injectable({
    providedIn: 'root'
})
export class HttpClientService {

    constructor(
        private http: HttpClient,
        // private appStorage: StorageService,
        private location: Location,
        private clientErrorHandler: ClientErrorHandlerService
    ) { }

    // USED FOR METHOD TYPE GET & CONTENT TYPE IS JSON
    get(url: string, opt?: object): Observable<any> {
     
        const HEADERS = new HttpHeaders()
            .set('Content-Type', 'application/json')
           
        const options = opt ? opt : {
            headers: HEADERS,
            params: {}
        };
        // console.log(options);
        return this.http.get(url, options).pipe(catchError(this.clientErrorHandler.handleError));
    }
   
    // USED FOR METHOD TYPE POST & CONTENT TYPE IS JSON
    post(url: string, data: object, opt?: object): Observable<any> {
       
        const HEADERS = new HttpHeaders()
            .set('Content-Type', 'application/json')
            .set('token', sessionStorage.getItem('token'))
          
        const options = opt ? opt : {
            headers: HEADERS,
            params: {}
        };
        return this.http.post(url, data, options).pipe(catchError(this.clientErrorHandler.handleError));
    }
    // USED FOR METHOD TYPE POST & HEADER TYPE IS JSON
    postRH(url: string, data: any, opt?: object): Observable<any> {
        // const accessToken = AppConstants.AUTHORIZATION_HEADER;
        const HEADERS = new HttpHeaders()
            // .set('Authorization', accessToken)
            .set('ackNo', data);
        const options = opt ? opt : {
            headers: HEADERS,
            params: {}
        };
        return this.http.post(url, null, options).pipe(catchError(this.clientErrorHandler.handleError));
    }


    postRegister(url: string, data: object, opt?: object): Observable<any> {
        return this.http.post(url, data,{headers: new HttpHeaders({ 'Content-Type': 'application/json' }), responseType: 'text' as 'json'}).pipe(catchError(this.clientErrorHandler.handleError));
    }
    createpassword(url: string, data: object, opt?: object): Observable<any> {
        return this.http.post(url, data,{headers: new HttpHeaders({ 'Content-Type': 'application/json' }), responseType: 'text' as 'json'}).pipe(catchError(this.clientErrorHandler.handleError));
    }

    changePassword(url: string, data: object, opt?: object): Observable<any> {
        return this.http.post(url, data,{headers: new HttpHeaders({ 'Content-Type': 'application/json' }), responseType: 'text' as 'json'}).pipe(catchError(this.clientErrorHandler.handleError));
    }

    
}
