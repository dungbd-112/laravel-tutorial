import { Injectable } from '@angular/core'

@Injectable({
  providedIn: 'root'
})
export class PersitenceService {
  set(key: string, data: any): void {
    try {
      localStorage.setItem(key, JSON.stringify(data))
    } catch (error) {
      console.error('Error saving to localStorage', error)
    }
  }

  get(key: string): any {
    try {
      const item = localStorage.getItem(key)
      if (!item) return null

      return JSON.parse(item)
    } catch (error) {
      console.error('Error getting data from localStorage', error)
      return null
    }
  }
}
