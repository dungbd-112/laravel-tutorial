import { StoryInterface } from './story.interface'

export interface StoryStateInterface {
  isLoading: boolean
  stories: StoryInterface[]
  story: StoryInterface | null
  error: any | null
}
