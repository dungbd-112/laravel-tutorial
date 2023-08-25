import { Component } from '@angular/core'
import { Store } from '@ngrx/store'
import { combineLatest } from 'rxjs'
import { selectCurrentUser } from 'src/app/auth/store/reducers'
import { AuthStateInterface } from 'src/app/auth/types/authState.interface'

@Component({
  selector: 'app-stories-list',
  templateUrl: './storiesList.component.html'
})
export class StoriesListComponent {
  data$ = combineLatest({
    currentUser: this.store.select(selectCurrentUser)
  })

  constructor(private store: Store<{ auth: AuthStateInterface }>) {}
}
