<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Options\Interfaces\Options as OptionsInterface;
use App\Options\OptionsBase;
use App\Options\ZooOptions;
use App\Options\ActivityTypeOptions;
use App\Options\LanguageOptions;
use App\Options\QuestionTypeOptions;
use App\Options\ZooGeolocationOptions;

class OptionsTest extends TestCase
{
    /**
     * Test OptionsBase class.
     *
     * @return void
     */
    public function testOptionsBase()
    {
        $instance = new OptionsBase();

        $this->assertClassHasAttribute('options', OptionsBase::class);
        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertTrue(method_exists($instance, 'options'));
        $this->assertTrue(method_exists($instance, 'value'));
        $this->assertCount(0, $instance->options());
        $this->assertSame(1, $instance->value(1));
    }
    /**
     * Test ZooOptions class.
     *
     * @return void
     */
    public function testZooOptions()
    {
        $instance = $this->app->make(ZooOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(3, $instance->options());
    }

    /**
     * Test ActivityTypeOptions class.
     *
     * @return void
     */
    public function testActivityTypeOptions()
    {
        $instance = $this->app->make(ActivityTypeOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(2, $instance->options());
    }

    /**
     * Test LanguageOptions class.
     *
     * @return void
     */
    public function testLanguageOptions()
    {
        $instance = $this->app->make(LanguageOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(5, $instance->options());
    }

    /**
     * Test QuestionTypeOptions class.
     *
     * @return void
     */
    public function testQuestionTypeOptions()
    {
        $instance = $this->app->make(QuestionTypeOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(7, $instance->options());
    }

    /**
     * Test ZooGeolocationOptions class.
     *
     * @expectedException              Exception
     * @expectedExceptionMessageRegExp /No Geolocation for key:? \w+/
     *
     * @return void
     */
    public function testZooGeolocationOptions()
    {
        $instance = $this->app->make(ZooGeolocationOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(3, $instance->options());
        $instance->value('does-not-exist');
    }
}
