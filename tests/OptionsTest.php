<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Options\Interfaces\Options as OptionsInterface;
use App\Options\OptionsBase;
use App\Options\LanguageOptions;
use App\Options\QuestionTypeOptions;

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
     * Test LanguageOptions class.
     *
     * @return void
     */
    public function testLanguageOptions()
    {
        $instance = $this->app->make(LanguageOptions::class);

        $this->assertInstanceOf(OptionsInterface::class, $instance);
        $this->assertInstanceOf(OptionsBase::class, $instance);
        $this->assertCount(3, $instance->options());
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
        $this->assertCount(8, $instance->options());
    }
}
