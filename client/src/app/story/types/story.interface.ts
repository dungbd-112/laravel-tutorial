export interface StoryInterface {
  id: number
  title: string
  thumbnail: string
  bonus: number
  createdUser: {
    id: number
    name: string
  }
  createdAt: Date
  updatedAt: Date
}
