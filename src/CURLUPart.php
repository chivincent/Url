<?php

namespace Chivincent\Url;

enum CURLUPart: int
{
    case CURLUPART_URL = 0;
    case CURLUPART_SCHEME = 1;
    case CURLUPART_USER = 2;
    case CURLUPART_PASSWORD = 3;
    case CURLUPART_OPTIONS = 4;
    case CURLUPART_HOST = 5;
    case CURLUPART_PORT = 6;
    case CURLUPART_PATH = 7;
    case CURLUPART_QUERY = 8;
    case CURLUPART_FRAGMENT = 9;
    case CURLUPART_ZONEID = 10;
}