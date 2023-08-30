import { NgModule } from '@angular/core'
import { CommonModule } from '@angular/common'
import { EffectsModule } from '@ngrx/effects'
import { StoreModule } from '@ngrx/store'
import { NzIconModule } from 'ng-zorro-antd/icon'
import { NzCarouselModule } from 'ng-zorro-antd/carousel'
import { NzButtonModule } from 'ng-zorro-antd/button'
import { NzToolTipModule } from 'ng-zorro-antd/tooltip'

import { StoriesListComponent } from './components/storiesList/storiesList.component'
import { StoryDetailComponent } from './components/storyDetail/storyDetail.component'
import { StoryRoutingModule } from './story-routing.module'
import { DefaultLayoutComponent } from '../shared/modules/defaultLayout/defaultLayout.component'
import { storyFeatureKey, storyReducer } from './store/reducers'
import * as storyEffects from './store/effects'
import { DetailItemComponent } from './components/storyDetail/detailItem/detailItem.component'
import { StoryReadComponent } from './components/storyRead/storyRead.component'

@NgModule({
  declarations: [
    StoriesListComponent,
    StoryDetailComponent,
    DetailItemComponent,
    StoryReadComponent
  ],
  imports: [
    CommonModule,
    StoryRoutingModule,
    DefaultLayoutComponent,
    NzIconModule,
    NzCarouselModule,
    NzButtonModule,
    NzToolTipModule,
    StoreModule.forFeature(storyFeatureKey, storyReducer),
    EffectsModule.forFeature([storyEffects])
  ]
})
export class StoryModule {}
