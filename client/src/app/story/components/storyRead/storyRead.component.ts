import { AfterViewInit, Component, ViewChild } from '@angular/core'
import { Store } from '@ngrx/store'

import { StoryStateInterface } from '../../types/storyState.interface'

@Component({
  selector: 'app-story-read',
  templateUrl: './storyRead.component.html'
})
export class StoryReadComponent implements AfterViewInit {
  story$ = this.store.select(store => store.story.story)

  @ViewChild('rootCanvas', { static: false }) rootCanvas: any

  currentPage = 0

  constructor(private store: Store<{ story: StoryStateInterface }>) {}

  ngAfterViewInit(): void {
    this.drawBackground()
  }

  drawBackground(): void {
    this.story$.subscribe(story => {
      if (!story || !story.pages) return
      if (this.currentPage >= story.pages.length) return

      const page = story.pages[this.currentPage]

      const canvas = this.rootCanvas.nativeElement
      const ctx = canvas.getContext('2d')

      // clear canvas
      ctx.clearRect(0, 0, canvas.width, canvas.height)

      // draw text
      ctx.textAlign = 'center'
      ctx.font = '36px Arial'
      ctx.fillText(page.sentences[0].content, canvas.width / 2, 100)

      // draw background
      const img = new Image()
      img.src = page.background

      img.onload = () => {
        ctx.drawImage(img, 0, 150, canvas.width, canvas.height - 150)
      }

      // play audio
      const audio = new Audio()
      audio.src = page.sentences[0].audio
      setTimeout(() => {
        audio.play()
      }, 1000)

      // add click object event
      canvas.addEventListener('click', (e: any) => {
        const mouseX = e.clientX - canvas.getBoundingClientRect().left
        const mouseY = e.clientY - canvas.getBoundingClientRect().top

        console.log('mouse target', mouseX, mouseY)
      })
    })
  }

  nextPage(): void {
    this.currentPage++
    console.log('nextPage', this.currentPage)
    this.drawBackground()
  }

  prevPage(): void {
    if (this.currentPage === 0) return

    this.currentPage--
    this.drawBackground()
  }
}
