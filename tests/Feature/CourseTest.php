<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function testIndex()
    {
        $course = factory(\App\Course::class)->create();
        $response = $this->get('/api/courses');

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $course->name]);
    }

    public function testStore()
    {
        $course = factory(\App\Course::class)->make();
        $response = $this->post('/api/courses', ['name' => $course->name]);

        $response->assertStatus(201);
        $response->assertJson(['name' => $course->name]);
    }

    public function testShow()
    {
        $course = factory(\App\Course::class)->create();
        $response = $this->get("/api/courses/{$course->id}");

        $response->assertStatus(200);
        $response->assertJson(['name' => $course->name]);
    }
}
