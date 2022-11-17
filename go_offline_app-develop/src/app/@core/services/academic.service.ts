import {Injectable} from '@angular/core';
import {ObservableService} from './observable.service';
import {environment} from '../../../environments/environment';

@Injectable({
    providedIn: 'root'
})
export class AcademicService {

    private baseUrl = `${environment.base_url}/academic`;
    private getUserPeriodUrl = `${this.baseUrl}/get-user-period`;
    private getPensumAssignedUrl = `${this.baseUrl}/get-pensum-assigned`;
    private getPensumAssignedUrlByDay = `${this.baseUrl}/get-pensum-assigned-by-day`;
    private getGetTopicsUrl = `${this.baseUrl}/get-topics`;
    private getGetQuestionnaireUrl = `${this.baseUrl}/get-questionaire`;
    private postAnswersUserUrl = `${this.baseUrl}/post-answer`;

    constructor(private observableService: ObservableService) {

    }

    getUserPeriod(userId) {
        return this.observableService.doPost(this.getUserPeriodUrl, {user_id: userId});
    }

    getPensumAssigned(periodId) {
        return this.observableService.doPost(this.getPensumAssignedUrl, {period_id: periodId});
    }

    getTopics(topicId, userId) {
        return this.observableService.doPost(this.getGetTopicsUrl, {topic_id: topicId, user_id: userId});
    }

    getQuestionnaire(topicId, userId) {
        return this.observableService.doPost(this.getGetQuestionnaireUrl, {topic_id: topicId, user_id: userId});
    }

    postAnswersUser(data) {
        const {questionnaire_id, answers_user, user_id, answers_correct, attempt} = data;
        return this.observableService.doPost(this.postAnswersUserUrl,
            {questionnaire_id, answers_user, user_id, answers_correct, attempt});
    }

    getPensumAssignedByDay(refDate, periodId) {
        return this.observableService.doPost(this.getPensumAssignedUrlByDay, {ref_date: refDate, period_id: periodId});
    }
}

