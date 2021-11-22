<?php

class Course extends BaseController {

    public function index()
    {
        try {
            $limit      =   5;
            $offset     =   0;
            
            if(isset($_GET['offset']))
                $offset     =   (($_GET['offset'] - 1) * $limit);

            $model      =   new CourseModel;
            $arrResult['results']  =   $model->getCourses($offset, $limit);
            $totalStudents  =   $model->getTotalCourses();
            $arrResult['total_records']     =   $totalStudents;
            $arrResult['total_pages']       =   ceil($totalStudents/$limit);
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function get()
    {
        try {
            $model      =   new CourseModel;
            $arrResult  =   $model->getCourseById();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
    
    public function create()
    {
        try {
            $model      =   new CourseModel;
            if(isset($_POST['course_id']) && $_POST['course_id'] > 0)
                $arrResult  =   $model->update();
            else
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

    public function getAll()
    {
        try {
            $model      =   new CourseModel;
            $arrResult['results']  =   $model->getAllCourses();
            $this->successResponse($arrResult);
        } catch (\Throwable $ex) {
            $this->errorResponse($ex->getMessage(), 500);
        }
    }
}