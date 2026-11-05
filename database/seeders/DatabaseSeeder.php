<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Department;
use App\Models\Semester;
use App\Models\AttendanceStatus;
use App\Models\ExamType;
use App\Models\Permission;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Section;
use App\Models\StudentSection;
use App\Models\Lecture;
use App\Models\Exam;
use App\Models\Attendance;
use App\Models\Grade;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. ROLES (Table #2)
        // ==========================================
        $adminRole    = Role::create(['role_name' => 'admin', 'description' => 'System Administrator - Full Access']);
        $managerRole  = Role::create(['role_name' => 'manager', 'description' => 'Department Manager - Add, Edit, Delete, Status, Manage']);
        $employeeRole = Role::create(['role_name' => 'employee', 'description' => 'Department Employee - Add, Edit, Search, View Details']);
        $studentRole  = Role::create(['role_name' => 'student', 'description' => 'Student - View Only Access']);

        // ==========================================
        // 2. DEPARTMENTS (Table #5)
        // ==========================================
        // System Modules (IDs 1-5) for routing users to the 5 Module Dashboards
        $deptUsers      = Department::create(['department_name' => 'User Management']);       // Module 1
        $deptCourses    = Department::create(['department_name' => 'Course Management']);     // Module 2
        $deptStudents   = Department::create(['department_name' => 'Student Affairs']);       // Module 3
        $deptAttendance = Department::create(['department_name' => 'Attendance & Lectures']); // Module 4
        $deptExams      = Department::create(['department_name' => 'Exams & Grades']);        // Module 5

        // Academic Departments (IDs 6-8) for Courses and Students
        $deptIT         = Department::create(['department_name' => 'Informatics Engineering']);
        $deptCivil      = Department::create(['department_name' => 'Civil Engineering']);
        $deptBusiness   = Department::create(['department_name' => 'Business Administration']);

        // ==========================================
        // 3. SEMESTERS (Table #6)
        // ==========================================
        $sem1 = Semester::create([
            'semester_name' => 'First Semester',
            'start_date'    => '2026-09-15',
            'end_date'      => '2027-01-20',
        ]);
        $sem2 = Semester::create([
            'semester_name' => 'Second Semester',
            'start_date'    => '2027-02-15',
            'end_date'      => '2027-06-20',
        ]);
        $semSummer = Semester::create([
            'semester_name' => 'Summer Semester',
            'start_date'    => '2027-07-01',
            'end_date'      => '2027-08-25',
        ]);

        // ==========================================
        // 4. ATTENDANCE STATUS (Table #12)
        // ==========================================
        AttendanceStatus::create(['status_name' => 'present']);
        AttendanceStatus::create(['status_name' => 'absent']);
        AttendanceStatus::create(['status_name' => 'late']);
        AttendanceStatus::create(['status_name' => 'excused']);

        // ==========================================
        // 5. EXAM TYPES (Table #15)
        // ==========================================
        $midtermType   = ExamType::create(['type_name' => 'Midterm']);
        $finalType     = ExamType::create(['type_name' => 'Final']);
        $practicalType = ExamType::create(['type_name' => 'Practical']);
        $oralType      = ExamType::create(['type_name' => 'Oral']);

        // ==========================================
        // 6. PERMISSIONS (Table #3)
        // ==========================================
        Permission::create(['permission_name' => 'manage_all_modules', 'role_id' => $adminRole->id]);
        Permission::create(['permission_name' => 'delete_and_change_status', 'role_id' => $managerRole->id]);
        Permission::create(['permission_name' => 'create_update_search_view', 'role_id' => $employeeRole->id]);
        Permission::create(['permission_name' => 'view_own_records', 'role_id' => $studentRole->id]);

        // ==========================================
        // 7. USERS (Table #1)
        // ==========================================
        // Default password for all test accounts: Password123
        $defaultPassword = Hash::make('Password123');

        // Module 1: User Management (Manager + Employee)
        User::create([
            'full_name'     => 'System Admin Manager',
            'username'      => 'admin_mgr',
            'email'         => 'admin.mgr@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0911111111',
            'role_id'       => $managerRole->id,
            'department_id' => $deptUsers->id,
            'birth_date'    => '1985-05-10',
            'status'        => 'active',
        ]);
        User::create([
            'full_name'     => 'User Affairs Employee',
            'username'      => 'users_emp',
            'email'         => 'users.emp@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0911111112',
            'role_id'       => $employeeRole->id,
            'department_id' => $deptUsers->id,
            'birth_date'    => '1992-08-15',
            'status'        => 'active',
        ]);

        // Module 2: Course Management (Manager + Employee)
        User::create([
            'full_name'     => 'Courses Manager',
            'username'      => 'courses_mgr',
            'email'         => 'courses.mgr@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0922222221',
            'role_id'       => $managerRole->id,
            'department_id' => $deptCourses->id,
            'birth_date'    => '1983-03-22',
            'status'        => 'active',
        ]);
        User::create([
            'full_name'     => 'Courses Employee',
            'username'      => 'courses_emp',
            'email'         => 'courses.emp@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0922222222',
            'role_id'       => $employeeRole->id,
            'department_id' => $deptCourses->id,
            'birth_date'    => '1994-11-05',
            'status'        => 'active',
        ]);

        // Module 3: Student Affairs (Manager + Employee)
        User::create([
            'full_name'     => 'Student Affairs Manager',
            'username'      => 'students_mgr',
            'email'         => 'students.mgr@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0933333331',
            'role_id'       => $managerRole->id,
            'department_id' => $deptStudents->id,
            'birth_date'    => '1986-07-19',
            'status'        => 'active',
        ]);
        User::create([
            'full_name'     => 'Student Affairs Employee',
            'username'      => 'students_emp',
            'email'         => 'students.emp@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0933333332',
            'role_id'       => $employeeRole->id,
            'department_id' => $deptStudents->id,
            'birth_date'    => '1995-01-30',
            'status'        => 'active',
        ]);

        // Module 4: Attendance & Lectures (Instructors - Manager + Employee)
        $instructor1 = User::create([
            'full_name'     => 'Dr. Abdo Al-Khoury',
            'username'      => 'instructor_mgr',
            'email'         => 'abdo.khoury@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0944444441',
            'role_id'       => $managerRole->id,
            'department_id' => $deptAttendance->id,
            'birth_date'    => '1980-04-12',
            'status'        => 'active',
        ]);
        $instructor2 = User::create([
            'full_name'     => 'Eng. Rami Hassan',
            'username'      => 'instructor_emp',
            'email'         => 'rami.hassan@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0944444442',
            'role_id'       => $employeeRole->id,
            'department_id' => $deptAttendance->id,
            'birth_date'    => '1990-09-25',
            'status'        => 'active',
        ]);

        // Module 5: Exams & Grades (Manager + Employee)
        User::create([
            'full_name'     => 'Exams Manager',
            'username'      => 'exams_mgr',
            'email'         => 'exams.mgr@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0955555551',
            'role_id'       => $managerRole->id,
            'department_id' => $deptExams->id,
            'birth_date'    => '1984-12-01',
            'status'        => 'active',
        ]);
        User::create([
            'full_name'     => 'Exams Employee',
            'username'      => 'exams_emp',
            'email'         => 'exams.emp@aiu.edu.sy',
            'password'      => $defaultPassword,
            'phone'         => '0955555552',
            'role_id'       => $employeeRole->id,
            'department_id' => $deptExams->id,
            'birth_date'    => '1993-06-14',
            'status'        => 'active',
        ]);

        // ==========================================
        // 8. STUDENTS (Table #7)
        // ==========================================
        $student1 = Student::create([
            'full_name'     => 'Yazan Al-Shami',
            'university_id' => '202310101',
            'national_id'   => '01010011223',
            'birth_date'    => '2004-03-15',
            'phone'         => '0966666661',
            'email'         => 'yazan@aiu.edu.sy',
            'department_id' => $deptIT->id,
            'academic_year' => '3',
            'status'        => 'active',
        ]);
        $student2 = Student::create([
            'full_name'     => 'Qusai Mahmoud',
            'university_id' => '202310102',
            'national_id'   => '01010011224',
            'birth_date'    => '2004-07-22',
            'phone'         => '0966666662',
            'email'         => 'qusai@aiu.edu.sy',
            'department_id' => $deptIT->id,
            'academic_year' => '3',
            'status'        => 'active',
        ]);
        $student3 = Student::create([
            'full_name'     => 'Laith Ibrahim',
            'university_id' => '202410205',
            'national_id'   => '01010011225',
            'birth_date'    => '2005-01-10',
            'phone'         => '0966666663',
            'email'         => 'laith@aiu.edu.sy',
            'department_id' => $deptIT->id,
            'academic_year' => '2',
            'status'        => 'active',
        ]);

        // ==========================================
        // 9. COURSES (Table #4)
        // ==========================================
        $courseWP1 = Course::create([
            'course_name'     => 'Web Programming 1',
            'course_code'     => 'CS301',
            'credit_hours'    => 3,
            'department_id'   => $deptIT->id,
            'instructor_id'   => $instructor1->id,
            'semester_id'     => $sem1->id,
            'academic_year'   => '2025-2026',
            'description'     => 'Introduction to HTML, CSS, JavaScript, and frontend fundamentals.',
            'prerequisite_id' => null,
            'status'          => 'active',
        ]);

        $courseWP2 = Course::create([
            'course_name'     => 'Web Programming 2',
            'course_code'     => 'CS402',
            'credit_hours'    => 3,
            'department_id'   => $deptIT->id,
            'instructor_id'   => $instructor1->id,
            'semester_id'     => $sem1->id,
            'academic_year'   => '2026-2027',
            'description'     => 'Backend web development using PHP, Laravel, MVC, and MySQL.',
            'prerequisite_id' => $courseWP1->id,
            'status'          => 'active',
        ]);

        $courseNet = Course::create([
            'course_name'     => 'Computer Networks',
            'course_code'     => 'CS305',
            'credit_hours'    => 4,
            'department_id'   => $deptIT->id,
            'instructor_id'   => $instructor2->id,
            'semester_id'     => $sem1->id,
            'academic_year'   => '2026-2027',
            'description'     => 'TCP/IP architecture, routing, switching, and socket programming.',
            'prerequisite_id' => null,
            'status'          => 'active',
        ]);

        // ==========================================
        // 10. SECTIONS (Table #8)
        // ==========================================
        $sectionWP2_S1 = Section::create([
            'section_name'  => 'Section C1',
            'course_id'     => $courseWP2->id,
            'instructor_id' => $instructor1->id,
            'semester_id'   => $sem1->id,
            'capacity'      => 35,
        ]);

        $sectionNet_S1 = Section::create([
            'section_name'  => 'Section C2',
            'course_id'     => $courseNet->id,
            'instructor_id' => $instructor2->id,
            'semester_id'   => $sem1->id,
            'capacity'      => 30,
        ]);

        // ==========================================
        // 11. STUDENT_SECTION ENROLLMENTS (Table #9)
        // ==========================================
        StudentSection::create([
            'student_id'        => $student1->id,
            'section_id'        => $sectionWP2_S1->id,
            'registration_date' => '2026-09-18',
        ]);
        StudentSection::create([
            'student_id'        => $student2->id,
            'section_id'        => $sectionWP2_S1->id,
            'registration_date' => '2026-09-18',
        ]);
        StudentSection::create([
            'student_id'        => $student1->id,
            'section_id'        => $sectionNet_S1->id,
            'registration_date' => '2026-09-19',
        ]);

        // ==========================================
        // 12. LECTURES (Table #10)
        // ==========================================
        $lecture1 = Lecture::create([
            'title'         => 'Laravel Architecture & Migrations',
            'lecture_date'  => '2026-10-18',
            'lecture_time'  => '10:00:00',
            'duration'      => 90,
            'section_id'    => $sectionWP2_S1->id,
            'course_id'     => $courseWP2->id,
            'instructor_id' => $instructor1->id,
        ]);

        $lecture2 = Lecture::create([
            'title'         => 'Eloquent ORM & Relationships',
            'lecture_date'  => '2026-10-25',
            'lecture_time'  => '10:00:00',
            'duration'      => 90,
            'section_id'    => $sectionWP2_S1->id,
            'course_id'     => $courseWP2->id,
            'instructor_id' => $instructor1->id,
        ]);

        // ==========================================
        // 13. ATTENDANCE (Table #11)
        // ==========================================
        Attendance::create([
            'lecture_id' => $lecture1->id,
            'student_id' => $student1->id,
            'status'     => 'present',
            'notes'      => 'On time and participated.',
        ]);
        Attendance::create([
            'lecture_id' => $lecture1->id,
            'student_id' => $student2->id,
            'status'     => 'late',
            'notes'      => 'Arrived 10 minutes late.',
        ]);
        Attendance::create([
            'lecture_id' => $lecture2->id,
            'student_id' => $student1->id,
            'status'     => 'present',
            'notes'      => null,
        ]);
        Attendance::create([
            'lecture_id' => $lecture2->id,
            'student_id' => $student2->id,
            'status'     => 'absent',
            'notes'      => 'Unexcused absence.',
        ]);

        // ==========================================
        // 14. EXAMS (Table #13)
        // ==========================================
        $examMidterm = Exam::create([
            'exam_type_id' => $midtermType->id,
            'exam_date'    => '2026-11-15',
            'exam_time'    => '11:00:00',
            'duration'     => 60,
            'max_grade'    => 30.00,
            'min_grade'    => 15.00,
            'section_id'   => $sectionWP2_S1->id,
            'course_id'    => $courseWP2->id,
            'room'         => 'Lab 302',
        ]);

        // ==========================================
        // 15. GRADES (Table #14)
        // ==========================================
        Grade::create([
            'exam_id'       => $examMidterm->id,
            'student_id'    => $student1->id,
            'grade'         => 28.50,
            'recorded_date' => '2026-11-18',
        ]);
        Grade::create([
            'exam_id'       => $examMidterm->id,
            'student_id'    => $student2->id,
            'grade'         => 24.00,
            'recorded_date' => '2026-11-18',
        ]);
    }
}