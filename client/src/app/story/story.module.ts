import { NgModule } from '@angular/core'
import { CommonModule } from '@angular/common'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryRoutingModule } from './story-routing.module'

@NgModule({
  declarations: [StoriesListComponent],
  imports: [CommonModule, StoryRoutingModule]
})
export class StoryModule {}
