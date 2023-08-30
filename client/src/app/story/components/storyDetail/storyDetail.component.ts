import { Component } from '@angular/core'
import { Store } from '@ngrx/store'
import { combineLatest } from 'rxjs'

import { StoryStateInterface } from '../../types/storyState.interface'

@Component({
  selector: 'app-story-detail',
  templateUrl: './storyDetail.component.html'
})
export class StoryDetailComponent {
  data$ = combineLatest({
    isLoading: this.store.select(state => state.story.isLoading),
    story: this.store.select(state => state.story.story)
  })

  constructor(private store: Store<{ story: StoryStateInterface }>) {}
}
