<?php

class Student extends BaseController {

    public function index()
    {
        try {
            $limit      =   2;
            $offset     =   0;
            
            if(isset($_GET['offset']))
                $offset     =   (($_GET['offset'] - 1) * $limit);

            $model      =   new StudentModel;
            $arrResult  =   $model->getStudents($offset, $limit);
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function get()
    {
        try {
            $model      =   new StudentModel;
            $arrResult  =   $model->getStudentById();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
    
    public function create()
    {
        try {
            $model      =   new StudentModel;
            $arrResult  =   $model->save();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function edit()
    {
        try {
            $model      =   new StudentModel;
            $arrResult  =   $model->update();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function delete()
    {
        try {
            $model      =   new StudentModel;
            $arrResult  =   $model->delete();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
}