import { inject } from '@angular/core'
import { Actions, createEffect, ofType } from '@ngrx/effects'
import { catchError, map, switchMap } from 'rxjs'
import { HttpErrorResponse } from '@angular/common/http'
import { NzMessageService } from 'ng-zorro-antd/message'

import { StoryService } from '../services/story.service'
import { StoriesResponseInterface } from '../types/response.interface'
import { storyActions } from './actions'

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
          map((response: StoriesResponseInterface) => {
            return storyActions.getStoriesSuccess({ stories: response.data })
          })
        )
      })
    )
  },
  { functional: true }
)
