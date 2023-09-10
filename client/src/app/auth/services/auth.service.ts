import { HttpClient } from '@angular/common/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'

import { environment } from 'src/environments/environment'
import { LoginRequestInterface } from '../types/loginRequest.interface'
import { LoginResponseInterface } from '../types/loginResponse.interface'
import { CurrentUserInterface } from 'src/app/shared/types/currentUser.interface'
import { RegisterRequestInterface } from '../types/registerRequest.interface'
import { LocalStorageService } from 'src/app/shared/services/localStorage.service'

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(
    private http: HttpClient,
    private localStorageService: LocalStorageService
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
    return this.localStorageService.get('accessToken')
  }

  register(data: RegisterRequestInterface): Observable<any> {
    const url = environment.apiBaseUrl + '/auth/register'
    return this.http.post(url, data)
  }

  logout(): void {
    const url = environment.apiBaseUrl + '/auth/logout'
    this.http.post(url, {})
    this.localStorageService.remove('accessToken')
  }
}
