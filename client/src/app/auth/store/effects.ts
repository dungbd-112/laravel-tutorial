import { inject } from '@angular/core'
import { HttpErrorResponse } from '@angular/common/http'
import { Router } from '@angular/router'
import { Actions, createEffect, ofType } from '@ngrx/effects'
import { catchError, map, of, switchMap, tap } from 'rxjs'
import { NzMessageService } from 'ng-zorro-antd/message'

import { authActions } from './actions'
import { AuthService } from '../services/auth.service'
import { LoginResponseInterface } from '../types/loginResponse.interface'
import { PersitenceService } from 'src/app/shared/services/persitence.service'

export const loginEffect = createEffect(
  (
    actions$ = inject(Actions),
    authService = inject(AuthService),
    presitenceService = inject(PersitenceService),
    message = inject(NzMessageService)
  ) => {
    return actions$.pipe(
      ofType(authActions.login),
      switchMap(({ request }) => {
        return authService.login(request).pipe(
          map((response: LoginResponseInterface) => {
            presitenceService.set('accessToken', response.accessToken)
            return authActions.loginSuccess({ currentUser: response.user })
          }),

          catchError((errorResponse: HttpErrorResponse) => {
            const errors = errorResponse.error.error
            Object.keys(errors).map(key => {
              message.create('error', errors[key].join(', '))
            })
            return of(authActions.loginFailure({ errors: errorResponse.error.error }))
          })
        )
      })
    )
  },
  { functional: true }
)

export const loginSuccessEffect = createEffect(
  (actions$ = inject(Actions), router = inject(Router), message = inject(NzMessageService)) => {
    return actions$.pipe(
      ofType(authActions.loginSuccess),
      tap(() => {
        message.create('success', 'Login successfully!')
        router.navigateByUrl('/stories')
      })
    )
  },
  { functional: true, dispatch: false }
)

export const getCurrentUserEffect = createEffect(
  (actions$ = inject(Actions), authService = inject(AuthService)) => {
    return actions$.pipe(
      ofType(authActions.getCurrentUser),
      switchMap(() => {
        return authService.getCurrentUser().pipe(
          map(currentUser => {
            return authActions.getCurrentUserSuccess({ currentUser })
          })
        )
      })
    )
  },
  { functional: true }
)

export const registerEffect = createEffect(
  (
    actions$ = inject(Actions),
    authService = inject(AuthService),
    router = inject(Router),
    message = inject(NzMessageService)
  ) => {
    return actions$.pipe(
      ofType(authActions.register),
      switchMap(({ request }) => {
        return authService.register(request).pipe(
          map(() => {
            router.navigateByUrl('/login')
            message.create('success', 'Create new account successfully!')
            return authActions.registerSubmitDone()
          }),

          catchError((errorResponse: HttpErrorResponse) => {
            const errors = errorResponse.error.error
            Object.keys(errors).map(key => {
              message.create('error', errors[key].join(', '))
            })
            return of(authActions.registerSubmitDone())
          })
        )
      })
    )
  },
  { functional: true }
)
