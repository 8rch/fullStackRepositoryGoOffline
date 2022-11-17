import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {TopicPage} from './topic.page';
import {AuthGuard} from '../../@core/guards/auth.guard';

const routes: Routes = [
    {
        path: '',
        pathMatch: 'full',
        component: TopicPage
    },
    {
        path: 'topic-resume/:id',
        loadChildren: () => import('./topic-resume/topic-resume.module').then(m => m.TopicResumePageModule),
    },
    {
        path: 'topic-questionnarie/:id',
        loadChildren: () => import('./topic-questionnarie/topic-questionnarie.module').then(m => m.TopicQuestionnariePageModule)
    }

];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
})
export class TopicPageRoutingModule {
}
