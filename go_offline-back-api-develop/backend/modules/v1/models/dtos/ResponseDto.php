<?php
namespace backend\modules\v1\models\dtos;

class ResponseDto {

    public static function format($status, $message, $data)
    {
        return [
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ];
    }
}