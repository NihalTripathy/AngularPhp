import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from './service/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  isLoggedin: any = false;
  constructor(
    private router: Router,
    private auth: AuthService,
  ){}
  ngOnInit(): void {
    this.router.events.subscribe(event => {
      if (event.constructor.name === "NavigationEnd") {
       this.isLoggedin = sessionStorage.getItem('loggedIn') === 'yes' ? true : false;
      }
    })
  }
  title = 'frontend';
  public loggedIn = sessionStorage.getItem('loggedIn');
  public logout() {
    sessionStorage.clear();
    this.auth.isLoggedIn = false;
    this.router.navigateByUrl('/login');
  }
  
}
