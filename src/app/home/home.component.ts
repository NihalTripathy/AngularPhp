import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/service/user.service'

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  productData: any;

  constructor(
    // private router: Router,
    // private formBuilder: FormBuilder,
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

}
