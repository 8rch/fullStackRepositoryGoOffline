import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TopicResumePage } from './topic-resume.page';

const routes: Routes = [
  {
    path: '',
    component: TopicResumePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TopicResumePageRoutingModule {}
