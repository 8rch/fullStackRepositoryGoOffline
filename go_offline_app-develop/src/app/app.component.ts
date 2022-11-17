import {Component, OnInit} from '@angular/core';

import {ActionSheetController, MenuController, Platform} from '@ionic/angular';
import {SplashScreen} from '@ionic-native/splash-screen/ngx';
import {StatusBar} from '@ionic-native/status-bar/ngx';
// @ts-ignore
import {Plugins} from '@capacitor/core';
import {registerWebPlugin} from '@capacitor/core';
import {HttpPluginWeb} from '@capacitor-community/http';
import {AuthService} from './@core/services/auth.service';
import {BehaviorSubject, Subject} from 'rxjs';
import {map} from 'rxjs/operators';
import {Router} from '@angular/router';
import {UtilService} from './@core/services/util.service';


@Component({
    selector: 'app-root',
    templateUrl: 'app.component.html',
    styleUrls: ['app.component.scss']
})
export class AppComponent implements OnInit {
    public selectedIndex = 0;
    public user$;
    public appPages = [
        {
            title: 'Pensum',
            url: '/folder/Inbox',
            icon: 'mail'
        },
        {
            title: 'Materias',
            url: '/topic/',
            icon: 'mail'
        },
        {
            title: 'Calendario de Tareas',
            url: '/folder/Inbox',
            icon: 'mail'
        },
        {
            title: 'Evaluaciones',
            url: '/folder/Inbox',
            icon: 'mail'
        },
        {
            title: 'Notas',
            url: '/folder/Inbox',
            icon: 'mail'
        },
    ];

    constructor(
        private platform: Platform,
        private splashScreen: SplashScreen,
        private statusBar: StatusBar,
        private authService: AuthService,
        private actionSheetController: ActionSheetController,
        private router: Router,
        private menu: MenuController,
        private utilService: UtilService,
    ) {
        this.initializeApp();
    }

    initializeApp() {
        this.platform.ready().then(() => {
            this.statusBar.styleDefault();
            this.splashScreen.hide();
            const Http = new HttpPluginWeb();

            registerWebPlugin(Http);

        });
    }

    ngOnInit() {
        const path = window.location.pathname.split('folder/')[1];
        if (path !== undefined) {
            this.selectedIndex = this.appPages.findIndex(page => page.title.toLowerCase() === path.toLowerCase());
        }
        this.user$ = this.authService.user$;
    }


    logout() {
        this.menu.close('main-sidebar');
        this.utilService.logout();
    }

    async presentProfileOptions() {
        const actionSheet = await this.actionSheetController.create({
            header: 'Perfil',
            buttons: [{
                text: 'Salir',
                icon: 'exit-outline',
                handler: () => {
                    this.logout();
                    console.log('Delete clicked');
                }
            }]
        });
        await actionSheet.present();
    }
}
