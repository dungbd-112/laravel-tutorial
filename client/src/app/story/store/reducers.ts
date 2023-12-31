import { createFeature, createReducer, on } from '@ngrx/store'

import { StoryStateInterface } from '../types/storyState.interface'
import { storyActions } from './actions'

const initialState: StoryStateInterface = {
  isLoading: false,
  stories: [],
  story: null,
  error: null
}

const storyFeature = createFeature({
  name: 'story',
  reducer: createReducer(
    initialState,

    on(
      storyActions.getStories,
      (state): StoryStateInterface => ({
        ...state,
        isLoading: true
      })
    ),

    on(
      storyActions.getStoriesSuccess,
      (state, action): StoryStateInterface => ({
        ...state,
        isLoading: false,
        stories: action.stories
      })
    ),

    on(
      storyActions.getStoriesFailure,
      (state): StoryStateInterface => ({
        ...state,
        isLoading: false
      })
    ),

    on(
      storyActions.getStoryDetail,
      (state): StoryStateInterface => ({
        ...state,
        isLoading: true
      })
    ),

    on(
      storyActions.getStoryDetailSuccess,
      (state, action): StoryStateInterface => ({
        ...state,
        isLoading: false,
        story: action.story
      })
    ),

    on(
      storyActions.getStoryDetailFailure,
      (state): StoryStateInterface => ({
        ...state,
        isLoading: false
      })
    )
  )
})

export const { name: storyFeatureKey, reducer: storyReducer, selectStories } = storyFeature
