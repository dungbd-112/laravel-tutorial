import { CommonModule } from '@angular/common'
import { Component } from '@angular/core'
import { Store } from '@ngrx/store'
import { NzPopoverModule } from 'ng-zorro-antd/popover'

import { selectCurrentUser } from 'src/app/auth/store/reducers'
import { AuthStateInterface } from 'src/app/auth/types/authState.interface'

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  standalone: true,
  imports: [CommonModule, NzPopoverModule]
})
export class HeaderComponent {
  currentUser$ = this.store.select(selectCurrentUser)

  accoutInfoVisible: boolean = false

  constructor(private store: Store<{ auth: AuthStateInterface }>) {}

  showAccoutInfo(): void {
    this.accoutInfoVisible = true
  }
}
