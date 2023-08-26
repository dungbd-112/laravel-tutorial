import { HttpClient } from '@angular/common/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'

import { environment } from 'src/environments/environment'
import { StoriesResponseInterface } from '../types/response.interface'

@Injectable({
  providedIn: 'root'
})
export class StoryService {
  constructor(private http: HttpClient) {}

  getStories(): Observable<StoriesResponseInterface> {
    const url = environment.apiBaseUrl + '/stories'
    return this.http.get<StoriesResponseInterface>(url)
  }
}
