import {Injectable} from '@angular/core';
import {ObservableService} from './observable.service';
import {environment} from '../../../environments/environment';
import {Geolocation} from '@capacitor/core';
import {UtilService} from './util.service';

@Injectable({
    providedIn: 'root'
})
export class GeoService {
    private baseUrl = `${environment.base_url}/geodata`;
    private savegeoUrl = `${this.baseUrl}/savegeo`;

    constructor(
        private observableService: ObservableService,
        private utilService: UtilService
    ) {
    }

    getCurrentPosition() {
        Geolocation.getCurrentPosition().then(
            coordinates => {
                const userId = this.utilService.getParsedJwt().id;
                this.saveGeoData(coordinates.coords.longitude.toString(), coordinates.coords.latitude.toString(), userId).subscribe();
            }
        );
    }

    saveGeoData(long, lat, userId) {
        return this.observableService.doPost(this.savegeoUrl, {GeoUserData: {long, lat, user_id: userId}});
    }


}
