import { ApiErrorInterface } from 'src/app/shared/types/apiError.interface'
import { CurrentUserInterface } from 'src/app/shared/types/currentUser.interface'

export interface AuthStateInterface {
  isSubmitting: boolean
  currentUser: CurrentUserInterface | null
  isLoggedIn: boolean | null
  validationErrors: ApiErrorInterface | null
}
