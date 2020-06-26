<?php

namespace tests\App\Controller;

// use App\Controller\RecipeController;
use Symfony\Bridge\PhpUnit\SetUpTearDownTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeTest extends WebTestCase
{
    use SetUpTearDownTrait;

    protected function doSetUp(): void
    {

    }

    protected function tearDown(): void
    {

    }

    /**
     * test recepes
     *
     * @return void
     */
    public function testLunch()
    {
        $client = static::createClient();

        $client->request('GET', '/api/lunch/2019-03-07/2019-03-10');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}