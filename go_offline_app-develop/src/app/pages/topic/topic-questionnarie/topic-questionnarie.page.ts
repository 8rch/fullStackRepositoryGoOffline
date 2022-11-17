import {Component, OnInit, ViewChild} from '@angular/core';
import {finalize, map, tap} from 'rxjs/operators';
import {ActivatedRoute, Router} from '@angular/router';
import {AcademicService} from '../../../@core/services/academic.service';
import {Observable, pipe} from 'rxjs';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {ActionSheetController, IonContent, NavController} from '@ionic/angular';
import {UtilService} from '../../../@core/services/util.service';
import {environment} from '../../../../environments/environment';

@Component({
    selector: 'app-topic-questionnarie',
    templateUrl: './topic-questionnarie.page.html',
    styleUrls: ['./topic-questionnarie.page.scss'],
})
export class TopicQuestionnariePage implements OnInit {
    isLoading = true;
    topicsQuestionnaire$: Observable<any>;
    topicQuestionaireForm;
    showReinforcementEvaluation = false;
    answersQuestionsData = {};
    @ViewChild(IonContent) content: IonContent;
    currentAttempt = 0;
    questionaryId = 0;
    userData;

    scrollTo() {
        const y = document.getElementsByTagName('ion-card')[0].offsetHeight;
        this.content.scrollToPoint(0, y);
    }

    constructor(
        private route: ActivatedRoute,
        private academicService: AcademicService,
        private router: Router,
        private formBuilder: FormBuilder,
        private actionSheetController: ActionSheetController,
        private utilService: UtilService,
        public navCtrl: NavController
    ) {
    }

    ngOnInit() {
        this.topicQuestionaireForm = this.formBuilder.group({
            evaluation: ['', Validators.required],
            reinforcement_evaluation: [''],
        });
        this.userData = this.utilService.getParsedJwt();

        const id = this.route.snapshot.paramMap.get('id');
        this.topicsQuestionnaire$ = this.academicService.getQuestionnaire(id, this.userData.id)
            .pipe(map(data => {

                    this.answersQuestionsData = data;
                    // @ts-ignore
                    return data.map(res => {
                        this.questionaryId = res.questionnaire_id;
                        this.currentAttempt = res.attempt ? res.attempt : this.currentAttempt;
                        //debugger
                        console.log(this.currentAttempt);
                        res.answers = JSON.parse(JSON.parse(res.answers));
                        res.questions = JSON.parse(JSON.parse(res.questions));
                        return res;
                    });
                }),
                tap(data => console.log(data)),
                finalize(() => this.isLoading = !this.isLoading));
    }

    async onSubmit() {
        const buttons = new Array();
        const maxAttempts = environment.env.max_attempt;
        if (this.currentAttempt < maxAttempts) {
            buttons.push({
                text: 'Guardar y Continuar con otro tema',
                icon: 'open-outline',
                handler: () => {
                    if (!this.topicQuestionaireForm.valid) {
                        this.utilService.presentAlert({
                            title: 'Datos incompletos',
                            subtitle: '',
                            msg: 'Complete la(s) respuesta(s) para continuar'
                        });
                    } else {
                        const submitData: any[] = [];
                        console.log(this.topicQuestionaireForm.value);
                        this.sendAnswer(this.topicQuestionaireForm.value);
                    }

                }
            });
            if (!this.showReinforcementEvaluation) {
                this.topicQuestionaireForm.controls.reinforcement_evaluation.setValidators([Validators.required]);
                buttons.push({
                    text: 'Intentar Evaluacion de Refuerzo',
                    icon: 'shuffle-outline',
                    handler: () => {
                        console.log('Share clicked');
                        this.showReinforcementEvaluation = true;
                        setTimeout(() => this.scrollTo(), 500);

                    }
                });
            }
        } else {
            buttons.push({
                text: 'Solamente es permitido registrar 3 intentos.',
                icon: 'close-circle-outline',
                handler: () => this.goBackToTopics()
            });
        }

        const actionSheet = await this.actionSheetController.create({
            header: 'Cuestionario',
            backdropDismiss: false,
            buttons
        });
        await actionSheet.present();
    }

    async sendAnswer(answersUser) {
        await this.utilService.presentLoading();
        // @ts-ignore
        const answers = {
            evaluation: this.answersQuestionsData[0].answers,
            reinforcement_evaluation: this.answersQuestionsData[0].answers
        };
        // tslint:disable-next-line:variable-name
        const questionnaire_id = this.questionaryId;
        // tslint:disable-next-line:variable-name
        const answers_user = answersUser;
        // tslint:disable-next-line:variable-name
        const user_id = this.utilService.getParsedJwt().id;
        // tslint:disable-next-line:variable-name
        const answers_correct = answers;
        const attempt = this.currentAttempt + 1;
        const dataToSend = {questionnaire_id, answers_user, user_id, answers_correct, attempt};
        // debugger
        this.academicService
            .postAnswersUser(dataToSend)
            .pipe(tap(async data => {
                let message = `<ul>`;
                // @ts-ignore
                message = data.evaluation === true ? ` <li> Has acertado a la pregunta de evaluación. </li>`
                    : `<li> Tu respuesta a la evaluación es incorrecta. </li>`;

                if (this.showReinforcementEvaluation) {
                    // @ts-ignore
                    message += data.reinforcement_evaluation === true ? `<li>Has acertado a la pregunta de refuerzo.</li>` :
                        `<li>Tu respuesta al refuerzo es incorrecta. </li>`;
                }
                message += `</ul>`;
                await this.utilService.dismissLoading();
                await this.utilService.presentAlert({title: 'Hecho', subtitle: '', msg: message});
                await this.goBackToTopics();
            }))
            .subscribe();

    }

    goBackToTopics() {
        return this.navCtrl.navigateForward('/');
    }
}
