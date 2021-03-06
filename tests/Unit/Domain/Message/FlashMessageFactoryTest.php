<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Message;

use EasyAdmin\Domain\Message\ErrorMessage;
use EasyAdmin\Domain\Message\FlashMessageFactory;
use EasyAdmin\Domain\Message\SuccessMessage;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\Stub\StubTranslator;

final class FlashMessageFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_success_message(): void
    {
        $message = $this->getFactory()->create('success', 'success message');
        self::assertInstanceOf(SuccessMessage::class, $message);
        self::assertSame('success message', $message->getMessage());
    }

    /**
     * @test
     */
    public function it_creates_an_error_message(): void
    {
        $message = $this->getFactory()->create('error', 'error message');
        self::assertInstanceOf(ErrorMessage::class, $message);
        self::assertSame('error message', $message->getMessage());
    }

    /**
     * @test
     */
    public function it_fails_creating_invalid_types(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getFactory()->create('fake', 'error message');
    }

    private function getFactory(): FlashMessageFactory
    {
        return new FlashMessageFactory(new StubTranslator());
    }
}
