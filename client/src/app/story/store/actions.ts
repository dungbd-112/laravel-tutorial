import { createActionGroup, emptyProps, props } from '@ngrx/store'
import { StoryInterface } from '../types/story.interface'

export const storyActions = createActionGroup({
  source: 'Story',
  events: {
    'Get stories': emptyProps(),
    'Get stories success': props<{ stories: StoryInterface[] }>(),
    'Get stories failure': emptyProps(),
    'Get story detail': props<{ id: string }>(),
    'Get story detail success': props<{ story: StoryInterface }>(),
    'Get story detail failure': emptyProps()
  }
})
