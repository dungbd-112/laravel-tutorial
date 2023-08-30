import { inject } from '@angular/core'
import { Actions, createEffect, ofType } from '@ngrx/effects'
import { map, switchMap } from 'rxjs'
import { NzMessageService } from 'ng-zorro-antd/message'

import { StoryService } from '../services/story.service'
import { storyActions } from './actions'
import { ApiResponseInterface } from 'src/app/shared/types/apiResponse.interface'
import { StoryInterface } from '../types/story.interface'

export const getStoriesEffect = createEffect(
  (
    actions$ = inject(Actions),
    storyService = inject(StoryService),
    message = inject(NzMessageService)
  ) => {
    return actions$.pipe(
      ofType(storyActions.getStories),
      switchMap(() => {
        return storyService.getStories().pipe(
          map((response: ApiResponseInterface<StoryInterface[]>) => {
            return storyActions.getStoriesSuccess({ stories: response.data })
          })
        )
      })
    )
  },
  { functional: true }
)

export const getStoryDetailEffect = createEffect(
  (actions$ = inject(Actions), storyService = inject(StoryService)) => {
    return actions$.pipe(
      ofType(storyActions.getStoryDetail),
      switchMap(({ id }) => {
        return storyService.getStoryDetail(id).pipe(
          map((response: ApiResponseInterface<StoryInterface>) => {
            return storyActions.getStoryDetailSuccess({ story: response.data })
          })
        )
      })
    )
  },
  { functional: true }
)
