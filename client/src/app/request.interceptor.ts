import { Injectable } from '@angular/core'
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http'
import { Observable } from 'rxjs'
import { AuthService } from './auth/services/auth.service'

@Injectable()
export class RequestInterceptor implements HttpInterceptor {
  constructor(private authService: AuthService) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    const accessToken = this.authService.getCurrentToken()

    if (accessToken) {
      const requestWithToken = request.clone({
        setHeaders: {
          authorization: `Bearer ${accessToken}`
        }
      })

      return next.handle(requestWithToken)
    }

    return next.handle(request)
  }
}
