<?php

namespace Tests\Unit;

use App\Services\AjapaikService;
use PHPUnit\Framework\TestCase;

class AjapaikServiceTest extends TestCase
{
    /**
     * @var AjapaikService instance
     */
    protected $ajapaikService;

    public function setUp(): void
    {
        parent::setUp();

        $this->ajapaikService = app(AjapaikService::class);
    }

    private function responseDefaultValues(): array
    {
        return [
            'title' => 'Sample title',
            'description' => 'Sample description',
        ];
    }

    private function responseOnlyTranslatedValues(): array
    {
        return [
            'title_et' => 'Sample title et',
            'description_et' => 'Sample description et',
        ];
    }

    private function responseEmpty(): array
    {
        return [];
    }

    private function responseWithDescriptionOriginalLanguage(): array
    {
        $responseOnlyTranslatedValues = $this->responseOnlyTranslatedValues();

        $responseOnlyTranslatedValues['description_original_language'] = 'Sample description original language';

        return $responseOnlyTranslatedValues;
    }

    public function testGetResponseTitle(): void
    {
        $responseDefaultValues = $this->responseDefaultValues();
        $responseOnlyTranslatedValues = $this->responseOnlyTranslatedValues();
        $responseEmpty = $this->responseEmpty();

        $this->assertEquals('Sample title', $this->ajapaikService->getResponseTitle($responseDefaultValues));
        $this->assertEquals('Sample title et', $this->ajapaikService->getResponseTitle($responseOnlyTranslatedValues));
        $this->assertEmpty($this->ajapaikService->getResponseTitle($responseEmpty));
    }

    public function testGetResponseDescription(): void
    {
        $responseDefaultValues = $this->responseDefaultValues();
        $responseOnlyTranslatedValues = $this->responseOnlyTranslatedValues();
        $responseEmpty = $this->responseEmpty();

        $this->assertEquals('Sample description', $this->ajapaikService->getResponseDescription($responseDefaultValues));
        $this->assertEquals('Sample description et', $this->ajapaikService->getResponseDescription($responseOnlyTranslatedValues));
        $this->assertEmpty($this->ajapaikService->getResponseDescription($responseEmpty));
    }

    public function testGetSearchableTextData(): void
    {
        $responseDefaultValues = $this->responseDefaultValues();
        $responseOnlyTranslated = $this->responseOnlyTranslatedValues();
        $responseEmpty = $this->responseEmpty();
        $responseWithDescriptionOriginalLanguage = $this->responseWithDescriptionOriginalLanguage();

        $this->assertEquals([
            'Sample title',
            'Sample description',
        ], $this->ajapaikService->getSearchableTextData($responseDefaultValues));
        $this->assertEquals([
            'Sample title et',
            'Sample description et',
        ], $this->ajapaikService->getSearchableTextData($responseOnlyTranslated));
        $this->assertEquals([], $this->ajapaikService->getSearchableTextData($responseEmpty));
        $this->assertEquals([
            'Sample title et',
            'Sample description et',
        ], $this->ajapaikService->getSearchableTextData($responseWithDescriptionOriginalLanguage));
    }

    public function testGetSearchableTextString(): void
    {
        $responseDefaultValues = $this->responseDefaultValues();
        $responseOnlyTranslated = $this->responseOnlyTranslatedValues();
        $responseEmpty = $this->responseEmpty();
        $responseWithDescriptionOriginalLanguage = $this->responseWithDescriptionOriginalLanguage();

        $this->assertEquals('Sample title\nSample description', $this->ajapaikService->getSearchableTextString($responseDefaultValues));
        $this->assertEquals('Sample title et\nSample description et', $this->ajapaikService->getSearchableTextString($responseOnlyTranslated));
        $this->assertEquals('', $this->ajapaikService->getSearchableTextString($responseEmpty));
        $this->assertEquals('Sample title et\nSample description et', $this->ajapaikService->getSearchableTextString($responseWithDescriptionOriginalLanguage));
    }
}
