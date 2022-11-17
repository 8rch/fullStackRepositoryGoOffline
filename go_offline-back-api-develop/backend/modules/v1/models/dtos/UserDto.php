<?php
namespace backend\modules\v1\models\dtos;

 class UserDto {
    private $username;
    private $id;
    private $email;

     function __construct($userData)
    {
        $this->id=$userData->id;
        $this->username=$userData->username;
        $this->email=$userData->email;
    }

     function getUser(): array
    {
        return [
            'id'=>$this->id,
            'username'=>$this->username,
            'email'=>$this->email
        ];
    }
}