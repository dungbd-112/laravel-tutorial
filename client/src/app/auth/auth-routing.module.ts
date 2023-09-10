import { RouterModule, Routes } from '@angular/router'
import { NgModule } from '@angular/core'

import { RegisterComponent } from './components/register/register.component'
import { LoginComponent } from './components/login/login.component'
import { publicRouteGuard } from '../shared/guards/publicRoute.guard'

const routes: Routes = [
  {
    path: 'register',
    component: RegisterComponent,
    canActivate: [publicRouteGuard]
  },
  {
    path: 'login',
    component: LoginComponent,
    canActivate: [publicRouteGuard]
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AuthRoutingModule {}
