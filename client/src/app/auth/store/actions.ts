import { createActionGroup, emptyProps, props } from '@ngrx/store'

import { LoginRequestInterface } from '../types/loginRequest.interface'
import { CurrentUserInterface } from 'src/app/shared/types/currentUser.interface'
import { RegisterRequestInterface } from '../types/registerRequest.interface'

export const authActions = createActionGroup({
  source: 'Auth',
  events: {
    Login: props<{ request: LoginRequestInterface }>(),
    'Login success': props<{ currentUser: CurrentUserInterface }>(),
    'Login failure': props<{ errors: any }>(),
    'Get current user': emptyProps(),
    'Get current user success': props<{ currentUser: CurrentUserInterface }>(),
    Register: props<{ request: RegisterRequestInterface }>(),
    'Register submit done': emptyProps()
  }
})
