import { RouterModule, Routes } from '@angular/router'
import { NgModule } from '@angular/core'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryDetailComponent } from './components/storyDetail/storyDetail.component'
import { StoryReadComponent } from './components/storyRead/storyRead.component'
import { prefectStoriesGuard, prefectStoryDetailGuard } from './guards/prefect.guard'
import { CreateComponent } from './components/create/create.component'
import { requireAdminGuard } from '../shared/guards/requireAdmin.guard'

const routes: Routes = [
  {
    path: '',
    component: StoriesListComponent,
    canActivate: [prefectStoriesGuard]
  },
  {
    path: 'create',
    component: CreateComponent,
    canActivate: [requireAdminGuard]
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
    redirectTo: '/'
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StoryRoutingModule {}
