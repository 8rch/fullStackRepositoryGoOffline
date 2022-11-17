<?php


namespace backend\modules\v1\models\dtos;


use webvimark\modules\UserManagement\models\UserVisitLog;

class LoginLogDto
{
    private $id;
    private $ip;
    private $user_id;
    private $visit_time;
    private $os;
    private $browser;

    /**
     * LoginLogDto constructor.
     * @param $loginLog UserVisitLog
     */
    public function __construct(UserVisitLog $loginLog)
    {
        $this->id=$loginLog->id;
        $this->user_id = $loginLog->user_id;
        $this->ip = $loginLog->ip;
        $this->browser = $loginLog->browser;
        $this->visit_time = $loginLog->visit_time;
        $this->os = $loginLog->os;
    }

    public function getVisitLog(): array
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'ip'=>$this->ip,
            'browser'=>$this->browser,
            'visit_time'=>$this->visit_time,
            'os'=>$this->os,
        ];
    }
}