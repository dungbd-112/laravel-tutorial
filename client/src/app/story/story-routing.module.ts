import { RouterModule, Routes } from '@angular/router'
import { NgModule } from '@angular/core'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryDetailComponent } from './components/storyDetail/storyDetail.component'
import { StoryReadComponent } from './components/storyRead/storyRead.component'

const routes: Routes = [
  {
    path: '',
    component: StoriesListComponent
  },
  {
    path: ':id',
    component: StoryDetailComponent
  },
  {
    path: ':id/read',
    component: StoryReadComponent
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StoryRoutingModule {}
