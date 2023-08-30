import { Component, OnInit } from '@angular/core'
import { ActivatedRoute } from '@angular/router'
import { Store } from '@ngrx/store'
import { combineLatest } from 'rxjs'

import { StoryStateInterface } from '../../types/storyState.interface'
import { storyActions } from '../../store/actions'

@Component({
  selector: 'app-story-detail',
  templateUrl: './storyDetail.component.html'
})
export class StoryDetailComponent implements OnInit {
  data$ = combineLatest({
    isLoading: this.store.select(state => state.story.isLoading),
    story: this.store.select(state => state.story.story)
  })

  array = [1, 2, 3, 4]

  constructor(
    private activeRoute: ActivatedRoute,
    private store: Store<{ story: StoryStateInterface }>
  ) {}

  ngOnInit(): void {
    this.activeRoute.params.subscribe(params => {
      const storyId = params['id']

      this.store.dispatch(storyActions.getStoryDetail({ id: storyId }))
    })
  }

  onStartReading(): void {}
}
