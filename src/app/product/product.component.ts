import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/service/user.service'
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {
  productData: any;
  optnForDelete: boolean = false;
  documentType: any;
  deleteArr: any = [];
  arrLen: any = 0;

  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private service: UserService,
  ) { }

  ngOnInit(): void {
    this.getAllProducts();
  }

  public getAllProducts(){
    this.service.getAllProduct().subscribe(successResponse => {
      if (successResponse !== null && successResponse.length !== 0) {
        this.productData = successResponse;
      } else {
        alert('Something Went Wrong..!!');
      }
    });
  }
  public openAddPage(){
    this.router.navigateByUrl('/add-product');
  }
  public openEditPage(id, i1, i2){
    let item = btoa(id);
    let item1 = btoa(i1);
    let item2 = btoa(i2);
    this.router.navigate(
      ['/add-product'],
      { queryParams: { data: item, data1: item1, data2:item2 } }
    )
  }
  public count = 0;
  public showDeleteOptn(event){
    // let count = 0;
    // // console.log(indx, event.target.checked);
    if (event.target.checked) {
      this.deleteArr.push(event.target.value)
    } else {
      if(this.deleteArr.includes(event.target.value))
      {
        var indx = this.deleteArr.indexOf(event.target.value);
        this.deleteArr.splice(indx, 1)
      }
    }
    this.arrLen = this.deleteArr.length;
    // this.documentType.find(e => {
    //   if(e.checkedStatus === 1){
    //     count++
    //   }
    // });
  }
  public deleteSelected(){
      this.service.deleteProduct(this.deleteArr).subscribe(successResponse => {
        var res = JSON.parse(successResponse);
        if(res.status == true)
        {
          this.arrLen = 0;
          this.getAllProducts();
        }
      });
    }
  }

