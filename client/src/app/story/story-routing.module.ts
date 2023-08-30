import { RouterModule, Routes } from '@angular/router'
import { NgModule } from '@angular/core'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryDetailComponent } from './components/storyDetail/storyDetail.component'
import { StoryReadComponent } from './components/storyRead/storyRead.component'
import { prefectStoriesGuard, prefectStoryDetailGuard } from './guards/prefect.guard'

const routes: Routes = [
  {
    path: '',
    component: StoriesListComponent,
    canActivate: [prefectStoriesGuard]
  },
  {
    path: ':id',
    component: StoryDetailComponent,
    canActivate: [prefectStoryDetailGuard]
  },
  {
    path: ':id/read',
    component: StoryReadComponent,
    canActivate: [prefectStoryDetailGuard]
  },
  {
    path: '**',
    redirectTo: '/stories'
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StoryRoutingModule {}
