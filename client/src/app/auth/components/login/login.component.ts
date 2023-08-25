import { Component } from '@angular/core'
import { FormBuilder, Validators } from '@angular/forms'
import { Store } from '@ngrx/store'
import { combineLatest } from 'rxjs'
import { AuthStateInterface } from '../../types/authState.interface'
import { selectIsSubmitting, selectValidationErrors } from '../../store/selectors'
import { authActions } from '../../store/actions'
import { LoginRequestInterface } from '../../types/loginRequest.interface'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html'
})
export class LoginComponent {
  form = this.fb.nonNullable.group({
    email: ['', [Validators.required]],
    password: ['', [Validators.required]]
  })

  isShowPassword: boolean = false

  data$ = combineLatest({
    isSubmitting: this.store.select(selectIsSubmitting)
  })

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

    const request: LoginRequestInterface = this.form.getRawValue()

    this.store.dispatch(authActions.login({ request }))
  }
}
