import { StoryInterface } from './story.interface'

export interface StoryStateInterface {
  isLoading: boolean
  stories: StoryInterface[]
  error: any | null
}
