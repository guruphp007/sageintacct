<?php

class Course extends BaseController {

    public function index()
    {
        try {
            $model      =   new CourseModel;
            $arrResult  =   $model->getCourses();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
    
    public function create()
    {
        try {
            $model      =   new CourseModel;
            $arrResult  =   $model->save();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function edit()
    {
        try {
            $model      =   new CourseModel;
            $arrResult  =   $model->update();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function delete()
    {
        try {
            $model      =   new CourseModel;
            $arrResult  =   $model->delete();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
}