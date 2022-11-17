import { Injectable } from '@angular/core';
import {
    CanActivate,
    ActivatedRouteSnapshot,
    RouterStateSnapshot,
    UrlTree,
    Router,
} from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { map } from 'rxjs/operators';
import {UtilService} from '../services/util.service';

@Injectable({
    providedIn: 'root',
})
export class AuthGuard implements CanActivate {
    constructor(private router: Router, private authService: AuthService, private utilService: UtilService) {
    }

    canActivate(
        next: ActivatedRouteSnapshot,
        state: RouterStateSnapshot
    ):
        | Observable<boolean | UrlTree>
        | Promise<boolean | UrlTree>
        | boolean
        | UrlTree {
        const data: any = {token: localStorage.getItem('access_token')};
        return this.authService.user$.pipe(
            map((user) => {
                if (user || data) {
                    return true;
                } else {
                    this.router.navigate(['login'], {
                        queryParams: { returnUrl: state.url },
                    });
                    return false;
                }
            })
        );
    }
}
