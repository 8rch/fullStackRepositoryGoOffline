import {NgModule} from '@angular/core';
import {PreloadAllModules, RouterModule, Routes} from '@angular/router';
import {AuthGuard} from './@core/guards/auth.guard';
// https://github.com/dotnet-labs/JwtAuthDemo/blob/master/angular/src/app/app-routing.module.ts
const routes: Routes = [
    {
        // path: 'topic',
        path: '',
        // pathMatch: 'full',
        loadChildren: () => import('./pages/topic/topic.module').then(m => m.TopicPageModule),
        canActivate: [AuthGuard],

    },
    {
        path: 'login',
        loadChildren: () => import('./pages/login/login.module').then(m => m.LoginPageModule)
    },
    {path: '**', redirectTo: ''},
];

@NgModule({
    imports: [
        RouterModule.forRoot(routes, {preloadingStrategy: PreloadAllModules})
    ],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
