<?php

namespace Eden\R606Eval\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Minimal smoke tests for index.php:
 *  1. The page responds with HTTP 200.
 *  2. The HTML output contains a <table> element.
 *
 * Set the APP_URL environment variable to target a different host/port.
 * Defaults to http://localhost:8080.
 */
class PageTest extends TestCase
{
    private string $url;

    protected function setUp(): void
    {
        $this->url = rtrim(getenv('APP_URL') ?: 'http://localhost:8080', '/');
    }

    /**
     * Fetch the page and return [http_code, body].
     *
     * @return array{int, string}
     */
    private function fetchPage(): array
    {
        $context = stream_context_create([
            'http' => [
                'method'          => 'GET',
                'ignore_errors'   => true,   // don't throw on 4xx/5xx
                'timeout'         => 5,
            ],
        ]);

        $body = file_get_contents($this->url, false, $context);

        // $http_response_header is set by file_get_contents
        $code = 0;
        if (!empty($http_response_header)) {
            preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $http_response_header[0], $m);
            $code = (int) ($m[1] ?? 0);
        }

        return [$code, (string) $body];
    }

    public function testPageLoads(): void
    {
        [$code] = $this->fetchPage();

        $this->assertSame(
            200,
            $code,
            "Expected HTTP 200 from {$this->url}, got {$code}."
        );
    }

    public function testPageContainsTable(): void
    {
        [, $body] = $this->fetchPage();

        $this->assertStringContainsStringIgnoringCase(
            '<table',
            $body,
            'The page HTML should contain a <table> element.'
        );
    }
}
