import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {environment} from '../../../environments/environment';
import {ObservableService} from './observable.service';

@Injectable({
    providedIn: 'root'
})
export class UserService {

    base = environment.base_url;
    loginUrl = `${this.base}/site/login`;
    getOwnLoginLogsUrl = `${this.base}/user/get-own-login-logs`;

    constructor(
        private observableService: ObservableService,
    ) {
    }


    getOwnLoginLogs() {
        return this.observableService.doPost(this.getOwnLoginLogsUrl, {});
    }

}
