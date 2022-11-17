import {Injectable, OnDestroy} from '@angular/core';
import {Router} from '@angular/router';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {environment} from '../../../environments/environment';
import {BehaviorSubject, from, Observable, of, Subscription} from 'rxjs';
import {delay, finalize, map, tap} from 'rxjs/operators';
import {UtilService} from './util.service';
import {ApplicationUser} from '../interfaces/application-user.interface';
import {ObservableService} from './observable.service';
import {ResponseCustom} from '../interfaces/response.interface';

@Injectable({
    providedIn: 'root'
})
export class AuthService implements OnDestroy {
    base = environment.base_url;
    loginUrl = `${this.base}/site/login`;

// https://codeburst.io/jwt-authentication-in-angular-48cfa882832c
    private timer: Subscription;
    private user = new BehaviorSubject<ApplicationUser>(null);
    user$: Observable<ApplicationUser> = this.user.asObservable();

    private storageEventListener(event: StorageEvent) {
        if (event.storageArea === localStorage) {
            if (event.key === 'logout-event') {
                this.user.next(null);
            }
            if (event.key === 'login-event') {
                location.reload();
            }
        }
    }

    constructor(private router: Router,
                private http: HttpClient,
                private utilService: UtilService,
                private observableService: ObservableService,
    ) {
        window.addEventListener('storage', this.storageEventListener.bind(this));
        this.checkUserLogged();
    }

    checkUserLogged() {
        const data: any = {token: localStorage.getItem('access_token')};
        if (data.token) {
            console.log('checkUserLogged');
            const t: any = this.utilService.parseJwt(data.token);
            this.user.next({username: t.username, role: t.name});
        } else {
            this.router.navigate(['login']);
        }
    }

    ngOnDestroy(): void {
        // window.removeEventListener('storage', this.storageEventListener.bind(this));
    }

// https://github.com/capacitor-community/http
    doLogin = (login) => {
        return this.observableService.doPost(this.loginUrl, {LoginForm: login}).pipe(
            map(data => {
                if (data) {
                    // @ts-ignore
                    const t: any = this.utilService.parseJwt(data.token);
                    this.user.next({username: t.username, role: t.name});
                    // @ts-ignore
                    this.setLocalStorage(data);
                    localStorage.setItem('login-event', 'login' + Math.random());
                    this.startTokenTimer();
                }

                // @ts-ignore
                return data;
            })
        );
    }


    refreshToken() {
        const refreshToken = localStorage.getItem('refresh_token');
        if (!refreshToken) {
            this.clearLocalStorage();
            return of(null);
        }

        return this.http
            .post<ResponseCustom>(`${this.base}/refresh-token`, {refreshToken})
            .pipe(
                map((x) => {
                    const t = this.utilService.parseJwt(x.data.token);
                    this.user.next({
                        username: t.username,
                        role: t.name,
                    });
                    this.setLocalStorage(x);
                    this.startTokenTimer();
                    return x;
                })
            );
    }

    setLocalStorage(data: any) {
        localStorage.setItem('access_token', data.token);
        // localStorage.setItem('refresh_token', x.refreshToken);
        localStorage.setItem('login-event', 'login' + Math.random());

    }

    clearLocalStorage() {
        // debugger;
        //    localStorage.removeItem('access_token');
        //    localStorage.removeItem('refresh_token');
        //   localStorage.setItem('logout-event', 'logout' + Math.random());
    }

    getTokenRemainingTime() {
        const accessToken = localStorage.getItem('access_token');
        if (!accessToken) {
            return 0;
        }
        const jwtToken = JSON.parse(atob(accessToken.split('.')[1]));
        const expires = new Date(jwtToken.exp * 1000);
        return expires.getTime() - Date.now();
    }

    private startTokenTimer() {
        const timeout = this.getTokenRemainingTime();
        this.timer = of(true)
            .pipe(
                delay(timeout),
                //   tap(() => this.refreshToken().subscribe())
            )
            .subscribe();
    }

    private stopTokenTimer() {
        this.timer?.unsubscribe();
    }
}
