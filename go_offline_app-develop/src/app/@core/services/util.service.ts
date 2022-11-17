import {Injectable} from '@angular/core';
import jwtDecode, {JwtPayload} from 'jwt-decode';
import {Plugins} from '@capacitor/core';
import {AlertController, LoadingController, ToastController} from '@ionic/angular';
import {GeoService} from './geo.service';
import {Router} from '@angular/router';

const {Geolocation} = Plugins;

@Injectable({
    providedIn: 'root'
})
export class UtilService {

    private loading;
    private isLoadingHttpReq = false;
    private alert;
    private hasErrorFromAlerts = false;

    constructor(
        private loadingController: LoadingController,
        public alertController: AlertController,
        private router: Router,
        public toastController: ToastController
    ) {
    }

    parseJwt(token) {
        return jwtDecode<any>(token);
    }

    getParsedJwt() {
        return this.parseJwt(localStorage.getItem('access_token'));
    }


    async presentLoading() {
        if (!this.isLoadingHttpReq) {
            this.isLoadingHttpReq = !this.isLoadingHttpReq;
            this.loading = await this.loadingController.create({
                message: 'Cargando ...',
            });
            await this.loading.present();
        }
    }

    async dismissLoading() {
        const loadingExist = document.getElementsByTagName('ion-loading')[0];
        if (loadingExist || this.loading) {
            await this.loading.dismiss();
            this.isLoadingHttpReq = false;
        }
    }

    logout() {
        this.presentLoading();
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');
        localStorage.setItem('logout-event', 'logout' + Math.random());
        this.router.navigate([`login`]);
        setTimeout(() => window.location.reload(), 2000);
    }

    async presentErrorAlert(data) {
        if (!this.hasErrorFromAlerts) {
            this.hasErrorFromAlerts = data.type === 'error' ? true : false;
            this.alert = await this.alertController.create({
                cssClass: 'my-custom-class',
                header: data.title,
                subHeader: data.subtitle,
                message: data.msg,
                backdropDismiss: false,
                buttons: [
                    {
                        text: 'Entendido',
                        handler: () => {
                            if (data.code === 504 || data.code === 500) {
                                this.logout();
                            }

                        }
                    }
                ]
            });
            await this.alert.present();
        }

    }

    async presentAlert(data) {
        this.alert = await this.alertController.create({
            cssClass: 'my-custom-class',
            header: data.title,
            subHeader: data.subtitle,
            message: data.msg,
            backdropDismiss: false,
            buttons: [
                {
                    text: 'Entendido',
                }
            ]
        });
        await this.alert.present();
    }

    async presentToast(message) {
        const toast = await this.toastController.create({
            message,
            duration: 4000,
        });
        await toast.present();
    }
}
