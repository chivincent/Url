<?php

namespace Chivincent\Url;

use FFI;
use RuntimeException;

class Curl
{
    private FFI $ffi;
    private FFI\CData $curl;

    public function __construct(string $libcurl = null)
    {
        $this->ffi = FFI::cdef(
            file_get_contents(__DIR__ . '/curl_def.c'),
            $libcurl ?: $this->libcurl(),
        );
        $this->curl = $this->ffi->curl_url();
    }

    public function urlSet(string $url)
    {
        $result = $this->ffi->curl_url_set(
            $this->curl,
            $this->ffi->CURLUPART_URL,
            $url,
            (1 << 3) | (1 << 11), //  CURLU_NON_SUPPORT_SCHEME | CURLU_ALLOW_SPACE
        );

        if ($result !== $this->ffi->CURLUE_OK) {
            throw new RuntimeException('curl_url_set failed: ' . $result);
        }
    }

    public function urlGet(CURLUPart $part): ?string
    {
        $buf = FFI::new('char *');

        $result = $this->ffi->curl_url_get($this->curl, $part->value, FFI::addr($buf), 0);
        if ($result >= $this->ffi->CURLUE_NO_SCHEME && $result <= $this->ffi->CURLUE_NO_ZONEID) {
            return null;
        }
        if ($result !== $this->ffi->CURLUE_OK) {
            throw new RuntimeException('curl_url_get failed: ' . $result);
        }

        return FFI::string($buf);
    }

    protected function libcurl(): string
    {
        return match(PHP_OS_FAMILY) {
            'Windows' => PHP_INT_SIZE === 4 ? 'libcurl-x86.dll' : 'libcurl-x64.dll',
            'Darwin' => 'libcurl.dylib',
            'Linux' => 'libcurl.so',
            default => throw new RuntimeException(),
        };
    }
}