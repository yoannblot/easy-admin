<?php

declare(strict_types=1);

namespace Tests\Integration\Application;

use EasyAdmin\Application\Router;
use Symfony\Component\HttpFoundation\Request;
use Tests\Integration\TestCase;

final class RouterTest extends TestCase
{
    /**
     * @test
     *
     * @throws
     */
    public function it_outputs_full_name_as_html(): void
    {
        /** @var Request $request */
        $request = $this->getService(Request::class);
        $request->query->set('type', 'FullName');
        $request->query->set('page', 'create');

        /** @var Router $configFileToHtml */
        $configFileToHtml = $this->getService(Router::class);

        $html = $configFileToHtml->execute();

        self::assertSameFileContents(__DIR__ . '/expected-output.html', $html->getContent());
    }
}
