import {Component, OnInit} from '@angular/core';
import {AcademicService} from '../../@core/services/academic.service';
import {UtilService} from '../../@core/services/util.service';
import {UserPeriod} from '../../@core/interfaces/user-period.interface';
import {finalize, map, tap} from 'rxjs/operators';
import {Observable} from 'rxjs';
import {Router} from '@angular/router';
import {GeoService} from '../../@core/services/geo.service';
import {UserService} from '../../@core/services/user.service';
import {PopoverController} from '@ionic/angular';
import {TopicPopoverComponent} from '../../components/topic/topic-popover/topic-popover.component';
import {CalendarComponentOptions, DayConfig} from 'ion2-calendar';
import {DatePipe} from '@angular/common';

@Component({
    selector: 'app-topic',
    templateUrl: './topic.page.html',
    styleUrls: ['./topic.page.scss'],
})
export class TopicPage implements OnInit {

    userData;
    pensumAssigned$: Observable<any>;
    loginLogs$: Observable<any>;
    pensumAssignedDay$: Observable<any>;
    isLoading = true;
    progressBySubject = new Array();
    dateMulti: string[] = new Array<string>();
    type: 'string';
    pensumPeriod = 0;

    optionsMulti: CalendarComponentOptions = {
        pickMode: 'multi',
        weekStart: 1,
        monthPickerFormat: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'],
        weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
    };
    formatDateCalendar = 'yyyy-MM-dd';

    constructor(
        private academicService: AcademicService,
        private utilService: UtilService,
        private router: Router,
        private geoService: GeoService,
        private userService: UserService,
        private popover: PopoverController,
        public datepipe: DatePipe
    ) {
    }

    async ngOnInit() {
        await this.geoService.getCurrentPosition();
        this.userData = this.utilService.getParsedJwt();
    }

    ionViewWillEnter() {
        this.getUserPeriod();
    }

    checkIf(data) {
        debugger;
    }

    async onClickCalendar($event) {
        await this.utilService.presentLoading();
        const refDate = this.datepipe.transform($event.time, this.formatDateCalendar);
        this.academicService.getPensumAssignedByDay(refDate, this.pensumPeriod).subscribe(
            async data => {
                await this.utilService.dismissLoading();
                if (data) {
                    await this.callPopover($event, data);
                } else {
                    await this.utilService.presentToast('No tienes tareas para la fecha');
                }
            }
        );
    }

    getUserPeriod() {
        this.isLoading = true;
        const userId = this.userData.id;
        let userPeriod: UserPeriod;
        this.academicService.getUserPeriod(userId)
            .subscribe(res => {
                if (res) {
                    userPeriod = {
                        first_partial_note: res.first_partial_note, id: res.id, pensum_id: res.pensum_id,
                        period_id: res.period_id, second_partial_note: res.second_partial_note, user_id: res.user_id
                    };
                    this.pensumPeriod = userPeriod.period_id;
                    this.pensumAssigned$ =
                        this.academicService.getPensumAssigned(userPeriod.period_id)
                            .pipe(map(
                                data => this.filterByMateria(data)
                            ))
                            .pipe(finalize(() => this.isLoading = false));
                }
                this.loginLogs$ = this.userService.getOwnLoginLogs()
                    .pipe(tap(() => {
                            if (!res) {
                                this.isLoading = false;
                            }
                        }
                    ));
            });
    }

    async filterByMateria(pensumAssigned: any) {
        const topics = new Array();
        const filteredData = new Array();
        await pensumAssigned.forEach(
            data => {
                if (typeof topics[data.career_subject_id] === 'undefined') {
                    topics[data.career_subject_id] = new Array();
                }
                topics[data.career_subject_id].push(data);
            }
        );
        topics.forEach( // clean array
            data => filteredData.push(data)
        );

        const dayConfigs: DayConfig[] = [];

        filteredData.forEach(
            group => {
                let qtySubjectWithAttempt = 0;
                let nameSubject = '';

                group.forEach(
                    subject => {
                        nameSubject = subject.materia_code;
                        let date = subject.dead_line;
                        if (date && date != null) {
                            date = new Date(date);
                            dayConfigs.push({
                                date,
                                marked: true,
                                subTitle: '*',
                                cssClass: 'custom-day'
                            });
                        }

                        if (subject.attempt > 0) {
                            qtySubjectWithAttempt++;
                        }
                    }
                );
                qtySubjectWithAttempt = qtySubjectWithAttempt / group.length;
                this.progressBySubject[nameSubject] = qtySubjectWithAttempt;
            }
        );
        this.optionsMulti.daysConfig = dayConfigs;

        return filteredData;
    }

    async callPopover(ev: any, group: any) {
        const pop = await this.popover.create({
            component: TopicPopoverComponent,
            cssClass: 'topic-popover',
            event: ev,
            translucent: true,
            componentProps: {
                group
            }
        });
        return await pop.present();
    }

    doRefresh(event) {
        this.isLoading = true;
        this.getUserPeriod();

        setTimeout(() => {
            event.target.complete();
        }, 2000);
    }
}
