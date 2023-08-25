import { CurrentUserInterface } from 'src/app/shared/types/currentUser.interface'

export interface LoginResponseInterface {
  user: CurrentUserInterface
  accessToken: string
}
