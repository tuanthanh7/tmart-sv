<?php
namespace App\Http\Controllers\V1\Auth\Controllers;

use App\Http\Controllers\V1\Auth\Models\Notification;
use App\Http\Controllers\V1\Auth\Resources\Notification\NotificationCollection;
use App\SERVICE;
use Illuminate\Http\Request;

class NotificationController extends BaseController{

    protected $model;

    public function __construct()
    {
        $this->model = new Notification();
    }

    public function getNotification(Request $request){
        $input = $request->all();
        $user = SERVICE::getCurrentUserId();
        if (is_null($user)) {
            return $this->responseError("Không tìm thấy user");
        }
        $input['user_id'] = 
        $notification = $this->model->search($input);
        return new NotificationCollection($notification);
    }
}