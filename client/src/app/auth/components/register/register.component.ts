import { Component } from '@angular/core'
import { FormBuilder, Validators } from '@angular/forms'
import { Store } from '@ngrx/store'

import { RegisterRequestInterface } from '../../types/registerRequest.interface'
import { AuthStateInterface } from '../../types/authState.interface'
import { authActions } from '../../store/actions'
import { combineLatest } from 'rxjs'
import { selectIsSubmitting } from '../../store/reducers'

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html'
})
export class RegisterComponent {
  form = this.fb.nonNullable.group({
    name: ['', [Validators.required]],
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required]]
  })

  data$ = combineLatest({
    isSubmitting: this.store.select(selectIsSubmitting)
  })

  isShowPassword: boolean = false

  constructor(
    private fb: FormBuilder,
    private store: Store<{ auth: AuthStateInterface }>
  ) {}

  onSubmit(): void {
    if (this.form.invalid) {
      Object.values(this.form.controls).forEach(control => {
        if (control.invalid) {
          control.markAsDirty()
          control.updateValueAndValidity({
            onlySelf: true
          })
        }
      })
      return
    }

    const request: RegisterRequestInterface = this.form.getRawValue()

    this.store.dispatch(authActions.register({ request }))
  }
}
