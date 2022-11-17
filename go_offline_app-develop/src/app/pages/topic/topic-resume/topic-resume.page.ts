import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {AcademicService} from '../../../@core/services/academic.service';
import {finalize, tap} from 'rxjs/operators';
import {Observable} from 'rxjs';
import {UtilService} from '../../../@core/services/util.service';

@Component({
    selector: 'app-topic-resume',
    templateUrl: './topic-resume.page.html',
    styleUrls: ['./topic-resume.page.scss'],
})
export class TopicResumePage implements OnInit {

    isLoading = true;
    topics$: Observable<any>;

    constructor(
        private route: ActivatedRoute,
        private academicService: AcademicService,
        private router: Router,
        private utilService: UtilService,
    ) {
    }

    ngOnInit() {
        const id = this.route.snapshot.paramMap.get('id');
        this.topics$ = this.academicService.getTopics(id, this.utilService.getParsedJwt().id)
            .pipe(finalize(() => this.isLoading = !this.isLoading));
    }

    goTo(t: any) {
        this.router.navigate([`topic-questionnarie/${t.topic_id}`]);
    }
}
