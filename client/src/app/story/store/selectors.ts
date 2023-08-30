import { createSelector } from '@ngrx/store'
import { StoryStateInterface } from '../types/storyState.interface'

export const storyFeature = (state: { story: StoryStateInterface }) => state.story

export const selectStories = createSelector(storyFeature, state => state.stories)

export const selectStory = createSelector(storyFeature, state => state.story)
