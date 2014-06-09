<?php

class PhotoControllerTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->comment = Mockery::mock('Eloquent', 'Comment');
    }

    public function setUp()
    {
        parent::setUp();

        $this->app->instance('Comment', $this->comment);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCommentFailsWhenNotLoggedIn()
    {
        $response = $this->action('POST', 'PhotoController@Comment');

        $json = $response->getContent();
        $responseArray = json_decode($json, true);

        $this->assertNotEmpty($responseArray);

        $this->assertEquals(array(
            'error' => Lang::get('error.need_login')
        ), $responseArray);
    }

    public function testSuccessfulComment()
    {
        $userObj = new stdClass;
        $userObj->id = 1;
        $userObj->first_name = 'A';
        $userObj->last_name = 'B';

        $this->mockAuthorization($userObj);

        $this->comment->shouldReceive('save')
            ->andReturn(true);

        $this->comment->shouldReceive('setAttribute');

        $this->comment->shouldReceive('getAttribute')
            ->with('user')
            ->andReturn($userObj);

        $this->comment->shouldReceive('getAttribute')
            ->andReturn('something');

        $response = $this->action('POST', 'PhotoController@Comment');
        $json = $response->getContent();
        
        $responseArray = json_decode($json, true);
        $this->assertNotEmpty($responseArray);
        $this->assertEquals(array(
            'full_name' => 'A B',
            'comment_description' => 'something',
            'created_at' => 'something',
        ), $responseArray);

    }

    private function mockAuthorization($userObj)
    {
        Auth::shouldReceive('check')
            ->once()
            ->andReturn(true);

        Auth::shouldReceive('user')
            ->once()
            ->andReturn($userObj);
    }
}
