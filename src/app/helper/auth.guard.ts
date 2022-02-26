import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

import { of } from 'rxjs/internal/observable/of';

@Injectable({ providedIn: 'root' })
export class AuthGuard implements CanActivate {
    constructor(
        private router: Router,
    ) {}

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        if(sessionStorage.getItem('username') !== null && sessionStorage.getItem('loggedIn') === 'yes'){
            return of(true);
        }else{
            return of(false);   
        }
    }
}