import {Component, OnInit} from '@angular/core';
import {LoadingController} from '@ionic/angular';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthService} from '../../@core/services/auth.service';
import {environment} from '../../../environments/environment';
import {Subscription} from 'rxjs';
import {ActivatedRoute, Router} from '@angular/router';
import {UtilService} from '../../@core/services/util.service';
import {GeoService} from '../../@core/services/geo.service';

@Component({
    selector: 'app-login',
    templateUrl: './login.page.html',
    styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
    loginFormGroup: FormGroup;
    busy = false;
    username = '';
    password = '';
    loginError = false;
    private subscription: Subscription;

    constructor(private formBuilder: FormBuilder,
                private loadingController: LoadingController,
                private authService: AuthService,
                private route: ActivatedRoute,
                private router: Router,
                private utilService: UtilService,
    ) {
    }

    ngOnInit() {
        this.presentLoading();
        this.loginFormGroup = this.formBuilder.group({
            username: [environment.user.username, Validators.required],
            password: [environment.user.password, Validators.required],
        });
        this.subscription = this.authService.user$.subscribe((x) => {
            if (this.router.url === 'login') {
                const accessToken = localStorage.getItem('access_token');
                const refreshToken = localStorage.getItem('refresh_token');
                if (x && accessToken && refreshToken) {
                    const returnUrl = this.route.snapshot.queryParams.returnUrl || '';
                    this.router.navigate([returnUrl]);
                }
            } // optional touch-up: if a tab shows login page, then refresh the page to reduce duplicate login
        });
    }

    public async presentLoading() {

    }

    submitForm() {
        this.presentLoading();
        console.log(this.loginFormGroup.value);
        this.authService.doLogin(this.loginFormGroup.value).subscribe(
            res => {
                if (res) {
                    this.router.navigate(['home']);
                } else {
                    this.utilService.presentErrorAlert({title: 'Credenciales incorrectas', subtitle: '', type: 'error',
                        msg: 'Si el problema persiste comuniquese con el encargado.'});
                }
            }
        );
    }

}
