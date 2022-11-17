import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { TopicResumePage } from './topic-resume.page';

describe('TopicResumePage', () => {
  let component: TopicResumePage;
  let fixture: ComponentFixture<TopicResumePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TopicResumePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(TopicResumePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
