import { HttpClient } from '@angular/common/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'

import { environment } from 'src/environments/environment'
import { ApiResponseInterface } from 'src/app/shared/types/apiResponse.interface'
import { StoryInterface } from '../types/story.interface'

@Injectable({
  providedIn: 'root'
})
export class StoryService {
  constructor(private http: HttpClient) {}

  getStories(): Observable<ApiResponseInterface<StoryInterface[]>> {
    const url = environment.apiBaseUrl + '/stories'
    return this.http.get<ApiResponseInterface<StoryInterface[]>>(url)
  }

  getStoryDetail(id: string): Observable<ApiResponseInterface<StoryInterface>> {
    const url = environment.apiBaseUrl + '/stories/' + id
    return this.http.get<ApiResponseInterface<StoryInterface>>(url)
  }
}
