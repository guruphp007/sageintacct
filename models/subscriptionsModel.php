<?php

class SubscriptionsModel extends BaseModel {
    
    public function getSubscriptions()
    {
        return $this->db->fetchAll("select * from course_subscriptions order by fk_course_id");
    }

    public function save()
    {
        $arrStudentIds	=	$_POST['student_ids'];
		$arrCourseIds	=	$_POST['course_ids'];

        $this->db->_execute("TRUNCATE TABLE course_subscriptions;");

        foreach ($arrStudentIds as $key => $student_id) 
		{
            $course_id 		=	$arrCourseIds[$key];
            
            $this->db->_execute("INSERT INTO course_subscriptions (fk_student_id,fk_course_id,created_at) VALUES (?,?,NOW())", [
                'ii', $student_id, $course_id
            ]);
        }

        return true;
    }

    public function saveupdate()
    {
        $arrStudentIds	=	$_POST['student_ids'];
		$arrCourseIds	=	$_POST['course_ids'];

        foreach ($arrStudentIds as $key => $student_id) 
		{
            $course_id 		=	$arrCourseIds[$key];
            
            $arrResult    =   $this->db->fetch("select * from course_subscriptions where fk_student_id = ?", [
                'i', $student_id
            ]);

            if($arrResult)
            {
                $this->db->_execute("UPDATE course_subscriptions SET fk_course_id = ?, updated_at = NOW() WHERE subscription_id = ?", [
                    'ii', $course_id, $arrResult['subscription_id']
                ]);
            }
            else
            {
                $this->db->_execute("INSERT INTO course_subscriptions (fk_student_id,fk_course_id,created_at) VALUES (?,?,NOW())", [
                    'ii', $student_id, $course_id
                ]);
            }
        }

        return true;
    }

    public function getSubscriptionsReport($offset = 0, $limit = 10)
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
                student_name 
            limit ?, ?", [
                'ii', $offset, $limit
            ]);
    }

    public function getTotalSubscriptions()
    {
        $arrRows    =   $this->db->fetch(
            "select
                COUNT(1) as TOT
            from
                course_subscriptions cs
            join student_details sd on
                sd.student_id = cs.fk_student_id
            join course_details cd on
                cd.course_id = cs.fk_course_id;"
        );
        return $arrRows['TOT'];
    }
}