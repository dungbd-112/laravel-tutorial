import { CommonModule } from '@angular/common'
import { Component } from '@angular/core'

import { HeaderComponent } from '../header/header.component'

@Component({
  selector: 'app-default-layout',
  templateUrl: './defaultLayout.component.html',
  standalone: true,
  imports: [CommonModule, HeaderComponent]
})
export class DefaultLayoutComponent {
  constructor() {}
}
