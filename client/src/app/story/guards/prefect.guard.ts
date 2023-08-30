import { inject } from '@angular/core'
import { CanActivateFn } from '@angular/router'
import { Store } from '@ngrx/store'
import { map } from 'rxjs'

import { StoryStateInterface } from '../types/storyState.interface'
import { storyActions } from '../store/actions'
import { selectStories } from '../store/reducers'
import { selectStory } from '../store/selectors'

export const prefectStoriesGuard: CanActivateFn = (route, state) => {
  const store = inject(Store<{ story: StoryStateInterface }>)

  return store.select(selectStories).pipe(
    map(stories => {
      if (!stories || stories.length === 0) store.dispatch(storyActions.getStories())

      return true
    })
  )
}

export const prefectStoryDetailGuard: CanActivateFn = (route, state) => {
  const store = inject(Store<{ story: StoryStateInterface }>)

  return store.select(selectStory).pipe(
    map(story => {
      const storyId = route.params['id']

      if (!story || story.id.toString() !== storyId)
        store.dispatch(storyActions.getStoryDetail({ id: storyId }))

      return true
    })
  )
}
