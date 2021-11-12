<?php

class SubscriptionsModel extends BaseModel {
    
    public function getSubscriptions()
    {
        return $this->db->fetchAll("select * from course_subscriptions order by fk_course_id");
    }

    public function save()
    {
        $course_id      =   $_POST['course_id'];
        $student_id     =   $_POST['student_id'];

        return $this->db->_execute("INSERT INTO course_subscriptions (fk_student_id,fk_course_id,created_at) VALUES (?,?,NOW())", [
            'ii', $course_id, $student_id
        ]);
    }

    public function getSubscriptionsReport()
    {
        return $this->db->fetchAll(
            "select
                CONCAT(sd.firstname, ' ' , sd.lastname) student_name,
                cd.course_name
            from
                course_subscriptions cs
            join student_details sd on
                sd.student_id = cs.fk_student_id
            join course_details cd on
                cd.course_id = cs.fk_course_id
            ORDER by
                student_name;"
        );
    }
}