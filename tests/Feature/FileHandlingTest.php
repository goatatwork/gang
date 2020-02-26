<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\BackchannelMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileHandlingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group files
     * @test
     * @return void
     */
    public function test_A_text_blob_can_be_stored_as_a_file_via_FilesController()
    {
        Event::fake();
        Storage::fake('public');

        Storage::disk('public')->assertMissing('goat.txt');

        $formData = ['load' => 'goat.txt','content' => 'Content XYZ'];

        $response = $this->post(route('files.store'), $formData);

        $response->assertStatus(302);

        Event::assertDispatched(BackchannelMessage::class);
        Storage::disk('public')->assertExists('goat.txt');
    }

    /**
     * @group files
     * @test
     * @return void
     */
    public function test_The_BackchannelMessage_event_fires_when_FilesController_stores_a_file()
    {
        Event::fake();
        Storage::fake('public');

        Storage::disk('public')->assertMissing('goat.txt');

        $formData = [
            'load' => 'goat.txt',
            'content' => 'This is the contents of the text file named goat.txt'
        ];

        $response = $this->post(route('files.store'), $formData);

        $response->assertStatus(302);

        Event::assertDispatched(BackchannelMessage::class);
        Storage::disk('public')->assertExists('goat.txt');
    }

    /**
     * @group files
     * @test
     * @return void
     */
    public function test_A_file_stored_by_FilesController_is_accessible_via_its_url()
    {
        Event::fake();
        Storage::fake('public');

        $response = $this->get(route('files.index'));

        $formData = ['load' => 'goat.txt','content' => 'Content XYZ'];
        $response = $this->post(route('files.store'), $formData);

        $response->assertStatus(302);

        $visit2 = $this->get(route('files.index'));

        $visit2->assertStatus(200);
    }
}
