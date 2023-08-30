import { Component, OnInit } from '@angular/core'
import { Store } from '@ngrx/store'

import { StoryStateInterface } from '../../types/storyState.interface'
import { selectStories } from '../../store/reducers'
import { combineLatest } from 'rxjs'

@Component({
  selector: 'app-stories-list',
  templateUrl: './storiesList.component.html'
})
export class StoriesListComponent {
  data$ = combineLatest({
    isLoading: this.store.select(state => state.story.isLoading),
    stories: this.store.select(selectStories)
  })

  constructor(private store: Store<{ story: StoryStateInterface }>) {}
}
