import { CommonModule } from '@angular/common'
import { Component } from '@angular/core'
import { Store } from '@ngrx/store'
import { NzPopoverModule } from 'ng-zorro-antd/popover'
import { NzDropDownModule } from 'ng-zorro-antd/dropdown'
import { NzIconModule } from 'ng-zorro-antd/icon'

import { selectCurrentUser } from 'src/app/auth/store/reducers'
import { AuthStateInterface } from 'src/app/auth/types/authState.interface'
import { authActions } from 'src/app/auth/store/actions'

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  standalone: true,
  imports: [CommonModule, NzPopoverModule, NzDropDownModule, NzIconModule]
})
export class HeaderComponent {
  currentUser$ = this.store.select(selectCurrentUser)

  accoutInfoVisible: boolean = false

  constructor(private store: Store<{ auth: AuthStateInterface }>) {}

  logout(): void {
    this.store.dispatch(authActions.logout())
  }
}
