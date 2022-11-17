import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { TopicQuestionnariePageRoutingModule } from './topic-questionnarie-routing.module';

import { TopicQuestionnariePage } from './topic-questionnarie.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    TopicQuestionnariePageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [TopicQuestionnariePage]
})
export class TopicQuestionnariePageModule {}
