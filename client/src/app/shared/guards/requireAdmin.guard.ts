import { inject } from '@angular/core'
import { CanActivateFn, Router } from '@angular/router'
import { Store } from '@ngrx/store'
import { map } from 'rxjs'

import { AuthStateInterface } from 'src/app/auth/types/authState.interface'
import { userRole } from '../config/userRole'
import { selectCurrentUser } from 'src/app/auth/store/selectors'

export const requireAdminGuard: CanActivateFn = (
  route,
  state,
  router = inject(Router),
  store = inject(Store<{ auth: AuthStateInterface }>)
) => {
  return store.select(selectCurrentUser).pipe(
    map(currentUser => {
      console.log('==> current user role', currentUser?.role, userRole['Admin'])
      if (!currentUser || currentUser.role !== userRole['Admin']) return router.parseUrl('/')

      return true
    })
  )
}
