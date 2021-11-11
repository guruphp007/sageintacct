<?php

class Subscriptions extends BaseController {

    public function index()
    {
        try {
            $model      =   new SubscriptionsModel;
            $arrResult  =   $model->getSubscriptions();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
    
    public function add()
    {
        try {
            $model      =   new SubscriptionsModel;
            $arrResult  =   $model->save();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
}