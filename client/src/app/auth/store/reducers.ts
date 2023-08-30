import { createFeature, createReducer, on } from '@ngrx/store'

import { AuthStateInterface } from '../types/authState.interface'
import { authActions } from './actions'

const initalState: AuthStateInterface = {
  isSubmitting: false,
  currentUser: null,
  isLoggedIn: null,
  validationErrors: null
}

const authFeature = createFeature({
  name: 'auth',
  reducer: createReducer(
    initalState,

    on(
      authActions.login,
      (state): AuthStateInterface => ({
        ...state,
        isSubmitting: true
      })
    ),

    on(
      authActions.loginSuccess,
      (state, action): AuthStateInterface => ({
        ...state,
        isSubmitting: false,
        isLoggedIn: true,
        currentUser: action.currentUser
      })
    ),

    on(
      authActions.loginFailure,
      (state, action): AuthStateInterface => ({
        ...state,
        isSubmitting: false,
        validationErrors: action.errors
      })
    ),

    on(
      authActions.getCurrentUser,
      (state): AuthStateInterface => ({
        ...state,
        isSubmitting: true
      })
    ),

    on(
      authActions.getCurrentUserSuccess,
      (state, action): AuthStateInterface => ({
        ...state,
        isSubmitting: false,
        isLoggedIn: true,
        currentUser: action.currentUser
      })
    ),

    on(
      authActions.getCurrentUserFailure,
      (state): AuthStateInterface => ({
        ...state,
        isSubmitting: false
      })
    ),

    on(
      authActions.register,
      (state): AuthStateInterface => ({
        ...state,
        isSubmitting: true
      })
    ),

    on(
      authActions.registerSubmitDone,
      (state): AuthStateInterface => ({
        ...state,
        isSubmitting: false
      })
    )
  )
})

export const {
  name: authFeatureKey,
  reducer: authReducer,
  selectIsSubmitting,
  selectCurrentUser,
  selectIsLoggedIn
} = authFeature
