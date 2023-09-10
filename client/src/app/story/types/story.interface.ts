export interface StoryInterface {
  id: number
  title: string
  thumbnail: string
  bonus: number
  createdUser: {
    id: number
    name: string
  }
  pages?: PageInterface[]
  createdAt: Date
  updatedAt: Date
}

export interface PageInterface {
  id?: number
  background: string
  sentences: SentenceInterface[]
  objects: ObjectInterface[]
}

export interface SentenceInterface {
  content: string
  audio: string
  position: string
}

export interface ObjectInterface {
  content: string
  audio: string
  zone: string
}
