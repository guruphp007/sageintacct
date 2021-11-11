<?php

class Subscriptions extends BaseController {

    public function index()
    {
        $model      =   new SubscriptionsModel;
        $arrResult  =   $model->getSubscriptions();
        $this->successResponse($arrResult);
    }
    
    public function add()
    {
        $model      =   new SubscriptionsModel;
        $arrResult  =   $model->save();
        $this->successResponse($arrResult);
    }
}