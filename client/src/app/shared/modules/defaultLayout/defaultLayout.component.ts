import { CommonModule } from '@angular/common'
import { Component, Input } from '@angular/core'
import { NzIconModule } from 'ng-zorro-antd/icon'

import { HeaderComponent } from '../header/header.component'

@Component({
  selector: 'app-default-layout',
  templateUrl: './defaultLayout.component.html',
  standalone: true,
  imports: [CommonModule, HeaderComponent, NzIconModule]
})
export class DefaultLayoutComponent {
  @Input() isLoading: boolean = false

  constructor() {}
}
