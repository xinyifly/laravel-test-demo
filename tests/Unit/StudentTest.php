<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    public function testSelectCourse()
    {
        $student = factory(\App\Student::class)->create();
        $course = factory(\App\Course::class)->create();

        $student->selectCourse($course);
        $this->assertDatabaseHas('course_student', [
            'course_id' => $course->id, 'student_id' => $student->id
        ]);
    }
}
