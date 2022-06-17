<?php

namespace Chivincent\Url;

class Url
{
    public ?string $scheme;
    public ?string $user;
    public ?string $password;
    public ?string $host;
    public ?int $port;
    public string $path;
    public ?string $query;
    public ?string $fragment;

    public function __construct(string $url)
    {
        $curl = new Curl();
        $curl->urlSet($url);

        $this->parse($curl);
    }

    private function parse(Curl $curl)
    {
        $this->scheme = $curl->urlGet(CURLUPart::CURLUPART_SCHEME);
        $this->user = $curl->urlGet(CURLUPart::CURLUPART_USER);
        $this->password = $curl->urlGet(CURLUPart::CURLUPART_PASSWORD);
        $this->host = $curl->urlGet(CURLUPart::CURLUPART_HOST);
        $this->port = $curl->urlGet(CURLUPart::CURLUPART_PORT);
        $this->path = $curl->urlGet(CURLUPart::CURLUPART_PATH);
        $this->query = $curl->urlGet(CURLUPart::CURLUPART_QUERY);
        $this->fragment = $curl->urlGet(CURLUPart::CURLUPART_FRAGMENT);
    }
}