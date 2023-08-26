import { StoryInterface } from './story.interface'

export interface StoriesResponseInterface {
  success: string
  data: StoryInterface[]
  message: string
}
