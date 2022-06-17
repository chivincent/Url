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