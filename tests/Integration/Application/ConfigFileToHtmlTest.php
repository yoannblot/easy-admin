<?php

declare(strict_types=1);

namespace Tests\Integration\Application;

use EasyAdmin\Application\ConfigFileToHtml;
use Tests\Integration\TestCase;

final class ConfigFileToHtmlTest extends TestCase
{
    /**
     * @test
     *
     * @throws
     */
    public function it_outputs_full_name_as_html(): void
    {
        /** @var ConfigFileToHtml $configFileToHtml */
        $configFileToHtml = $this->getService(ConfigFileToHtml::class);

        $filePath = __DIR__ . '/FullName.xml';
        $html = $configFileToHtml->execute($filePath);

        self::assertSameFileContents(__DIR__ . '/expected-output.html', $html);
    }
}
