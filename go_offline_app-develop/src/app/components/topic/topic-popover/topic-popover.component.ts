import {Component, OnInit} from '@angular/core';
import {PopoverController} from '@ionic/angular';
import {Router} from '@angular/router';
import {environment} from '../../../../environments/environment';
import {DatePipe} from '@angular/common';

@Component({
    selector: 'app-topic-popover',
    templateUrl: './topic-popover.component.html',
    styleUrls: ['./topic-popover.component.scss'],
})
export class TopicPopoverComponent implements OnInit {

    maxAttempts = environment.env.max_attempt;
    group: any;

    constructor(
        private router: Router,
        private popover: PopoverController,
        public datepipe: DatePipe
    ) {
    }

    ngOnInit() {
    }

    goTo(pensumAssigned) {
        this.dismissClick();
        this.router.navigate([`topic-resume/${pensumAssigned.tema_id}`]);
    }

    async dismissClick() {
        await this.popover.dismiss();
    }

    hasValidDate(deadLine) {
        const deadLineTimesTamp = (new Date(deadLine)).getTime() / 1000;
        const currentTimesTamp = (new Date()).getTime() / 1000;
        return currentTimesTamp >= deadLineTimesTamp ? true : false;
    }

}
