import { createSelector } from '@ngrx/store'

import { AuthStateInterface } from '../types/authState.interface'

export const authFeature = (state: { auth: AuthStateInterface }) => state.auth

export const selectIsSubmitting = createSelector(authFeature, state => state.isSubmitting)

export const selectCurrentUser = createSelector(authFeature, state => state.currentUser)

export const selectIsLoggedIn = createSelector(authFeature, state => state.isLoggedIn)

export const selectValidationErrors = createSelector(authFeature, state => state.validationErrors)
