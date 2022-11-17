import {NgModule} from '@angular/core';
import {CommonModule, DatePipe} from '@angular/common';
import {FormsModule} from '@angular/forms';

import {IonicModule} from '@ionic/angular';

import {TopicPageRoutingModule} from './topic-routing.module';

import {TopicPage} from './topic.page';
import {TopicPopoverComponent} from '../../components/topic/topic-popover/topic-popover.component';
import {CalendarModule} from 'ion2-calendar';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        IonicModule,
        TopicPageRoutingModule,
        CalendarModule
    ],
    declarations: [TopicPage, TopicPopoverComponent],
    entryComponents: [TopicPopoverComponent],
    providers: [DatePipe]
})
export class TopicPageModule {
}
