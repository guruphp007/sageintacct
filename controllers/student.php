<?php

class Student extends BaseController {

    public function index()
    {
        $model      =   new StudentModel;
        $arrResult  =   $model->getStudents();
        $this->successResponse($arrResult);
    }

    public function get()
    {
        $model      =   new StudentModel;
        $arrResult  =   $model->getStudentById();
        $this->successResponse($arrResult);
    }
    
    public function create()
    {
        $model      =   new StudentModel;
        $arrResult  =   $model->save();
        $this->successResponse($arrResult);
    }

    public function edit()
    {
        $model      =   new StudentModel;
        $arrResult  =   $model->update();
        $this->successResponse($arrResult);
    }

    public function delete()
    {
        $model      =   new StudentModel;
        $arrResult  =   $model->delete();
        $this->successResponse($arrResult);
    }
}