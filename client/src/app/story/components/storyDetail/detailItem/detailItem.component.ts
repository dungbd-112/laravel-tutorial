import { Component, Input } from '@angular/core'

@Component({
  selector: 'app-detail-item',
  templateUrl: './detailItem.component.html'
})
export class DetailItemComponent {
  @Input() title!: string

  @Input() content!: any

  constructor() {}
}
