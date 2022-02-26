import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AuthService } from 'src/app/service/auth.service'


@Component({ templateUrl: 'login.component.html' })
export class LoginComponent implements OnInit {
    loginForm: FormGroup;
    loading = false;
    submitted = false;
    returnUrl: string;

    constructor(
        private formBuilder: FormBuilder,
        private route: ActivatedRoute,
        private router: Router,
        private service: AuthService,
    ) {
       
        
    }

    ngOnInit() {
        this.loginForm = this.formBuilder.group({
            username: ['', Validators.required],
            password: ['', Validators.required]
        });

        // get return url from route parameters or default to '/'
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    // convenience getter for easy access to form fields
    get f() { return this.loginForm.controls; }

    onSubmit(data) {
       // console.log(data.username)
    // console.log(data.password)
    const DATA = {
        username: data.username,
        password: data.password,
      };
      if (this.loginForm.invalid) {
        alert('Please Fill All Required Fields');
      } else {
        this.service.login(DATA).subscribe(successResponse => {
          var res = JSON.parse(successResponse);
          // console.warn(res.status)
          if(res.status === true){
            this.service.isLoggedIn = true;
            sessionStorage.setItem('loggedIn', 'yes')
            sessionStorage.setItem('username', data.username)
            // location.reload();
            this.router.navigateByUrl('/home');
          }
          else
          {
              alert(res.msg);
          }
        });
      }
      // this.service.register()
       
    }
}
