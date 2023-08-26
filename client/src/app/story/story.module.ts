import { NgModule } from '@angular/core'
import { CommonModule } from '@angular/common'
import { EffectsModule } from '@ngrx/effects'
import { StoreModule } from '@ngrx/store'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryRoutingModule } from './story-routing.module'
import { DefaultLayoutComponent } from '../shared/modules/defaultLayout/defaultLayout.component'
import { storyFeatureKey, storyReducer } from './store/reducers'
import * as storyEffects from './store/effects'

@NgModule({
  declarations: [StoriesListComponent],
  imports: [
    CommonModule,
    StoryRoutingModule,
    DefaultLayoutComponent,
    StoreModule.forFeature(storyFeatureKey, storyReducer),
    EffectsModule.forFeature([storyEffects])
  ]
})
export class StoryModule {}
