import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from 'src/app/service/auth.service'
import { Router } from '@angular/router';
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
 
  registerForm: FormGroup;
  loading = false;
  submitted = false;

  constructor(
      private router: Router,
      private formBuilder: FormBuilder,
      private service: AuthService,
     
  ) {
      
  }

  ngOnInit() {
      this.registerForm = this.formBuilder.group({
          username: ['', Validators.required],
          password: ['', Validators.required]
      });
  }

  // convenience getter for easy access to form fields
  get f() { return this.registerForm.controls; }

  onSubmit(data) {
    // console.log(data.username)
    // console.log(data.password)
    const DATA = {
      username: data.username,
      password: data.password,
    };
    if (this.registerForm.invalid) {
      alert('Please Fill All Required Fields');
    } else {
      this.service.register(DATA).subscribe(successResponse => {
        var res = JSON.parse(successResponse);
        // console.warn(res.status)
        if(res.status === true){
          this.service.isLoggedIn = true;
          // location.reload();
          this.router.navigateByUrl('/login');
        }
      });
    }
    // this.service.register()
     
  }

}
