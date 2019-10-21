<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    public function testIndex()
    {
        $student = factory(\App\Student::class)->create();
        $response = $this->get('/api/students');

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $student->name]);
    }

    public function testStore()
    {
        $student = factory(\App\Student::class)->make();
        $response = $this->post('/api/students', ['name' => $student->name]);

        $response->assertStatus(201);
        $response->assertJson(['name' => $student->name]);
    }

    public function testShow()
    {
        $student = factory(\App\Student::class)->create();
        $response = $this->get("/api/students/{$student->id}");

        $response->assertStatus(200);
        $response->assertJson(['name' => $student->name]);
    }

    public function testSelectCourse()
    {
        $student = factory(\App\Student::class)->create();
        $course = factory(\App\Course::class)->create();

        $response = $this->post("/api/students/{$student->id}/select_course", [
            'course_id' => $course->id,
        ]);

        $response->assertStatus(204);
    }
}
