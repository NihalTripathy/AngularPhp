import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from 'src/app/service/user.service'
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css']
})
export class AddProductComponent implements OnInit {

  public myform: FormGroup;
  data1: any;
  data2: any;
  editable: boolean = false;
  edit_id: any;

  constructor(
    private router: Router,
    private fb: FormBuilder,
    private service: UserService,
    private route: ActivatedRoute
  ) { }
  
  ngOnInit(): void {
    this.createStartupFormInstance();
    if(this.route.queryParams){
      this.route.queryParams.subscribe(params => {
          // console.log(atob(params.data)); // { order: "popular" }
          this.edit_id = atob(params.data);
          this.data1 = params.data1;
          this.data2 = params.data2;

          // console.log(this.order); // popular
        }
      );
    }
    if(this.data1 && this.data2){
      let data1 = atob(this.data1)
      let data2 = atob(this.data2)
      this.editable = true;
      this.myform.controls.ptitle.patchValue(data1);
      this.myform.controls.pdesc.patchValue(data2);
    }
  }

  public createStartupFormInstance() {
    this.myform = this.fb.group({
      ptitle: ['', Validators.compose([Validators.required])],
      pdesc: ['', Validators.compose([Validators.required])]
    },
    {
      // this.handleFormChanges()
    });
  }

  public submitForm(data){
    if(!this.editable){
      const DATA = {
        ptitle: data.ptitle,
        pdesc: data.pdesc,
        username: sessionStorage.getItem('username')
      };
      if (this.myform.invalid) {
        alert('Please Fill All Required Fields');
      } else {
        this.service.addProduct(DATA).subscribe(successResponse => {
          var res = JSON.parse(successResponse);
          // console.warn(res.status)
          if(res.status === true){
            alert(res.msg)
            this.router.navigateByUrl('/product');
          }
        });
      }
    }else if(this.editable){
      const DATA = {
        pid: this.edit_id,
        ptitle: data.ptitle,
        pdesc: data.pdesc,
        username: sessionStorage.getItem('username')
      };
      if (this.myform.invalid) {
        alert('Please Fill All Required Fields');
      } else {
        this.service.updateProduct(DATA).subscribe(successResponse => {
          var res = JSON.parse(successResponse);
          // console.warn(res.status)
          if(res.status === true){
            alert(res.msg)
            this.router.navigateByUrl('/product');
          }
        });
      }
    }
  }

}
