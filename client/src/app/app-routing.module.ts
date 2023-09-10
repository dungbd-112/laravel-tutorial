import { NgModule } from '@angular/core'
import { RouterModule, Routes } from '@angular/router'

import { requireLoginGuard } from './shared/guards/requireLogin.guard'
import { LoginComponent } from './auth/components/login/login.component'
import { RegisterComponent } from './auth/components/register/register.component'
import { publicRouteGuard } from './shared/guards/publicRoute.guard'

const routes: Routes = [
  {
    path: 'login',
    component: LoginComponent,
    canActivate: [publicRouteGuard]
  },
  {
    path: 'register',
    component: RegisterComponent,
    canActivate: [publicRouteGuard]
  },
  {
    path: '',
    loadChildren: () => import('./story/story.module').then(m => m.StoryModule),
    canActivate: [requireLoginGuard]
  },
  {
    path: '**',
    redirectTo: ''
  }
]

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
