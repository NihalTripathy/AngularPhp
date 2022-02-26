import { Injectable, ErrorHandler } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { throwError } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ClientErrorHandlerService implements ErrorHandler {

    constructor() { }

    handleError(error: Error | HttpErrorResponse) {
        console.log('Something Went Wrong. Please Check Error As Following::');
        if (!navigator.onLine) {
            // Handle offline error
            console.error('Browser Offline!');
        } else {
            if (error instanceof HttpErrorResponse) {
                // Server or connection error happened
                if (!navigator.onLine) {
                    // Handle offline error
                    console.error('Browser Offline!');
                } else  if (error.status === 401) {
                    // Handles Unauthorised error
                    window.location.href = "/login";
                } else{
                    // Handle Http Error (4xx, 5xx, ect.)
                    console.log(error);
                    return throwError(error);
                }
            } else {
                // Handle Client Error (Angular Error, ReferenceError...)
                console.log('Client Error!');
                console.error(error);
                return throwError(error);
            }
            // Always log the error
            return throwError(error);
        }
    }
}
