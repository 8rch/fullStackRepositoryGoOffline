import {Injectable} from '@angular/core';

import {Plugins} from '@capacitor/core';
import {from} from 'rxjs';
import {HttpHeaders, HttpOptions} from '@capacitor-community/http';
import {UtilService} from './util.service';
import {catchError, finalize, map, tap} from 'rxjs/operators';
import {ResponseCustom} from '../interfaces/response.interface';

const {Http} = Plugins;

@Injectable({
    providedIn: 'root'
})
export class ObservableService {

    private headers: HttpHeaders;

    constructor(private utilService: UtilService) {
        this.headers = {'Content-Type': 'application/json; charset=utf-8'};
    }

    doPost = (url, data): any => {
        this.utilService.presentLoading();
        const accessToken = localStorage.getItem('access_token');
        if (accessToken) {
            this.headers = {
                'Content-Type': 'application/json; charset=utf-8',
                Authorization: `Bearer ${accessToken}`
            };
        }
        const httpOptions: HttpOptions = {
            method: 'POST',
            url,
            headers: this.headers,
            data
        };

        console.log(httpOptions);

        return from(
            Http.request(httpOptions)
        ).pipe(
            map(res => {
                this.handleError(res);
                return res.data.data as unknown as any[];
            }),
            tap(console.log),
            finalize(() => this.utilService.dismissLoading())
        );
    }

    doGet = (url, data) => {
        const httpOptions: HttpOptions = {
            method: 'GET',
            url,
            headers: this.headers,
            data
        };
        return from(Http.request(httpOptions));
    }

    handleError(request) {
        if (request.status === 504) {
            this.utilService
                .presentErrorAlert({
                    title: 'Error en la comunicacion',
                    subtitle: 'Esperando respuesta del servidor',
                    msg: 'Intente esta actividad despues de un tiempo o comuniquete con el responsable.',
                    type: 'error',
                    code: request.status,
                });
        }

        if (request.status === 500) {
            this.utilService
                .presentErrorAlert({
                    title: 'Se ha caducado tu tiempo',
                    subtitle: '',
                    msg: 'Ha pasado mucho tiempo desde tu ultima conexion, por favor vuelve a ingresar.',
                    type: 'error',
                    code: request.status,
                });
        }

        if (request.status >= 400 && request.status <= 499) {
            this.utilService
                .presentErrorAlert({
                    title: 'Error en la comunicacion',
                    subtitle: 'Codigo: ' + request.status,
                    msg: 'Comunicate con el responsable.',
                    type: 'error',
                    code: request.status,
                });
        }
        if (request.status > 500 && request.status <= 599) {
            this.utilService
                .presentErrorAlert({
                    title: 'Error en la servidor',
                    subtitle: 'Codigo: ' + request.status,
                    msg: 'Comunicate con el responsable.',
                    type: 'error',
                    code: request.status,
                });
        }
    }
}
