import { UserRole } from './userRole.interface'

export interface CurrentUserInterface {
  id: number
  name: string
  email: string
  point: number
  role: UserRole
}
