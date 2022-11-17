import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { TopicResumePageRoutingModule } from './topic-resume-routing.module';

import { TopicResumePage } from './topic-resume.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    TopicResumePageRoutingModule
  ],
  declarations: [TopicResumePage]
})
export class TopicResumePageModule {}
