import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TopicQuestionnariePage } from './topic-questionnarie.page';

const routes: Routes = [
  {
    path: '',
    component: TopicQuestionnariePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TopicQuestionnariePageRoutingModule {}
