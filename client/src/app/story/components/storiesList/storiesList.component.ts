import { Component, OnInit } from '@angular/core'
import { Store } from '@ngrx/store'

import { AuthStateInterface } from 'src/app/auth/types/authState.interface'
import { selectStories } from '../../store/reducers'
import { storyActions } from '../../store/actions'

@Component({
  selector: 'app-stories-list',
  templateUrl: './storiesList.component.html'
})
export class StoriesListComponent implements OnInit {
  stories$ = this.store.select(selectStories)

  constructor(private store: Store<{ auth: AuthStateInterface }>) {}

  ngOnInit(): void {
    this.store.dispatch(storyActions.getStories())
  }
}
