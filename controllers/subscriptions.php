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

    public function report()
    {
        try {
            $limit      =   10;
            $offset     =   0;
            
            if(isset($_GET['offset']))
                $offset     =   (($_GET['offset'] - 1) * $limit);

            $model      =   new SubscriptionsModel;
            $arrResult['results']  =   $model->getSubscriptionsReport($offset, $limit);
            $totalStudents  =   $model->getTotalSubscriptions();
            $arrResult['total_records']     =   $totalStudents;
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
}