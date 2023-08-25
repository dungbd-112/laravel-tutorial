import { HttpClient } from '@angular/common/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'

import { environment } from 'src/environments/environment'
import { LoginRequestInterface } from '../types/loginRequest.interface'
import { LoginResponseInterface } from '../types/loginResponse.interface'
import { CurrentUserInterface } from 'src/app/shared/types/currentUser.interface'
import { PersitenceService } from 'src/app/shared/services/persitence.service'
import { RegisterRequestInterface } from '../types/registerRequest.interface'

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(
    private http: HttpClient,
    private persitenceSerivce: PersitenceService
  ) {}

  login(data: LoginRequestInterface): Observable<LoginResponseInterface> {
    const url = environment.apiBaseUrl + '/auth/login'
    return this.http.post<LoginResponseInterface>(url, data)
  }

  getCurrentUser(): Observable<CurrentUserInterface> {
    const url = environment.apiBaseUrl + '/auth/me'
    return this.http.get<CurrentUserInterface>(url)
  }

  getCurrentToken(): string {
    return this.persitenceSerivce.get('accessToken')
  }

  register(data: RegisterRequestInterface): Observable<any> {
    const url = environment.apiBaseUrl + '/auth/register'
    return this.http.post(url, data)
  }
}
