<?php

class Course extends BaseController {

    public function index()
    {
        $model      =   new CourseModel;
        $arrResult  =   $model->getCourses();
        $this->successResponse($arrResult);
    }
    
    public function create()
    {
        $model      =   new CourseModel;
        $arrResult  =   $model->save();
        $this->successResponse($arrResult);
    }

    public function edit()
    {
        $model      =   new CourseModel;
        $arrResult  =   $model->update();
        $this->successResponse($arrResult);
    }

    public function delete()
    {
        $model      =   new CourseModel;
        $arrResult  =   $model->delete();
        $this->successResponse($arrResult);
    }
}