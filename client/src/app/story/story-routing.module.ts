import { RouterModule, Routes } from '@angular/router'
import { NgModule } from '@angular/core'

import { StoriesListComponent } from './components/storiesList/storiesList.component'

const routes: Routes = [
  {
    path: '',
    component: StoriesListComponent
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StoryRoutingModule {}
