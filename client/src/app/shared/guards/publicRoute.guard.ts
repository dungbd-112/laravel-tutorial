import { inject } from '@angular/core'
import { CanActivateFn, Router } from '@angular/router'
import { Store } from '@ngrx/store'
import { map } from 'rxjs'

import { AuthService } from 'src/app/auth/services/auth.service'
import { authActions } from 'src/app/auth/store/actions'
import { selectIsLoggedIn } from 'src/app/auth/store/reducers'
import { AuthStateInterface } from 'src/app/auth/types/authState.interface'

export const publicRouteGuard: CanActivateFn = (
  route,
  state,
  router = inject(Router),
  store = inject(Store<{ auth: AuthStateInterface }>),
  authService = inject(AuthService)
) => {
  const token = authService.getCurrentToken()

  if (!token || token === '') return true

  return store.select(selectIsLoggedIn).pipe(
    map(isLoggedIn => {
      if (!isLoggedIn) {
        store.dispatch(authActions.getCurrentUser())
        return router.parseUrl('/')
      }

      return router.parseUrl('/')
    })
  )
}
