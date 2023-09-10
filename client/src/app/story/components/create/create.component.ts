import { Component } from '@angular/core'
import { NzContextMenuService, NzDropdownMenuComponent } from 'ng-zorro-antd/dropdown'

import { PreviewFile } from 'src/app/shared/types/common'
import { PageInterface } from '../../types/story.interface'

@Component({
  selector: 'app-create',
  templateUrl: './create.component.html'
})
export class CreateComponent {
  currentThumbnail!: PreviewFile

  pages: PageInterface[] = []

  constructor(private nzContextMenuService: NzContextMenuService) {}

  contextMenu($event: MouseEvent, menu: NzDropdownMenuComponent): void {
    this.nzContextMenuService.create($event, menu)
  }

  closeMenu(): void {
    this.nzContextMenuService.close()
  }

  handleChangeImage(event: Event): void {
    if (!event.target) return

    const input = event.target as HTMLInputElement

    const image = input.files?.[0]
    if (!image) return

    const previewUrl = URL.createObjectURL(image)
    this.currentThumbnail = Object.assign(image, { preview: previewUrl })
  }

  handleAddPage(): void {}
}
