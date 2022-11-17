import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { TopicQuestionnariePage } from './topic-questionnarie.page';

describe('TopicQuestionnariePage', () => {
  let component: TopicQuestionnariePage;
  let fixture: ComponentFixture<TopicQuestionnariePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TopicQuestionnariePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(TopicQuestionnariePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
