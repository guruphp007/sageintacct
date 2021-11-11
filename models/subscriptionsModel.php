<?php

class SubscriptionsModel extends BaseModel {
    
    public function getSubscriptions()
    {
        return $this->db->Select("select * from course_subscriptions order by fk_course_id");
    }

    public function save()
    {
        $course_id      =   $_POST['course_id'];
        $student_id     =   $_POST['student_id'];

        $id    =   $db->Insert("INSERT INTO course_subscriptions (fk_student_id,fk_course_id,created_at) VALUES (?,?,NOW())", [
            'ii', $course_id, $student_id
        ]);
        return $id;
    }
}