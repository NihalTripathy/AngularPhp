import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { ProductComponent } from './product/product.component';
import { AddProductComponent } from './add-product/add-product.component';
import { AuthGuard } from './helper/auth.guard';

const routes: Routes = [
  { path: 'login', component: LoginComponent},
  { path: '', component: HomeComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'home', component: HomeComponent},
  { path: 'product', component: ProductComponent, canActivate: [AuthGuard]},
  { path: 'add-product', component: AddProductComponent, canActivate: [AuthGuard]},
  { path: '**', redirectTo: '' },
  // {
  //   path: '',
  //     canActivateChild: [AuthGuard],
  //     children: [
  //       { path: 'login', component: LoginComponent},
  //       { path: 'register', component: RegisterComponent},
  //       { path: 'home', component: HomeComponent},
  //       { path: 'product', component: ProductComponent},
  //       { path: 'add-product', component: AddProductComponent},
  //         // { path: '** ', component: Error404Component }
  //     ]
  // }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
