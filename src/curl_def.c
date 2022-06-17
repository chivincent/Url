typedef struct Curl_URL {
  char *scheme;
  char *user;
  char *password;
  char *options; /* IMAP only? */
  char *host;
  char *zoneid; /* for numerical IPv6 addresses */
  char *port;
  char *path;
  char *query;
  char *fragment;

  char *scratch; /* temporary scratch area */
  char *temppath; /* temporary path pointer */
  long portnum; /* the numerical version */
} CURLU;

typedef enum {
  CURLUE_OK,
  CURLUE_BAD_HANDLE,          /* 1 */
  CURLUE_BAD_PARTPOINTER,     /* 2 */
  CURLUE_MALFORMED_INPUT,     /* 3 */
  CURLUE_BAD_PORT_NUMBER,     /* 4 */
  CURLUE_UNSUPPORTED_SCHEME,  /* 5 */
  CURLUE_URLDECODE,           /* 6 */
  CURLUE_OUT_OF_MEMORY,       /* 7 */
  CURLUE_USER_NOT_ALLOWED,    /* 8 */
  CURLUE_UNKNOWN_PART,        /* 9 */
  CURLUE_NO_SCHEME,           /* 10 */
  CURLUE_NO_USER,             /* 11 */
  CURLUE_NO_PASSWORD,         /* 12 */
  CURLUE_NO_OPTIONS,          /* 13 */
  CURLUE_NO_HOST,             /* 14 */
  CURLUE_NO_PORT,             /* 15 */
  CURLUE_NO_QUERY,            /* 16 */
  CURLUE_NO_FRAGMENT,         /* 17 */
  CURLUE_NO_ZONEID,           /* 18 */
  CURLUE_BAD_FILE_URL,        /* 19 */
  CURLUE_BAD_FRAGMENT,        /* 20 */
  CURLUE_BAD_HOSTNAME,        /* 21 */
  CURLUE_BAD_IPV6,            /* 22 */
  CURLUE_BAD_LOGIN,           /* 23 */
  CURLUE_BAD_PASSWORD,        /* 24 */
  CURLUE_BAD_PATH,            /* 25 */
  CURLUE_BAD_QUERY,           /* 26 */
  CURLUE_BAD_SCHEME,          /* 27 */
  CURLUE_BAD_SLASHES,         /* 28 */
  CURLUE_BAD_USER,            /* 29 */
  CURLUE_LAST
} CURLUcode;

typedef enum {
  CURLUPART_URL,
  CURLUPART_SCHEME,
  CURLUPART_USER,
  CURLUPART_PASSWORD,
  CURLUPART_OPTIONS,
  CURLUPART_HOST,
  CURLUPART_PORT,
  CURLUPART_PATH,
  CURLUPART_QUERY,
  CURLUPART_FRAGMENT,
  CURLUPART_ZONEID /* added in 7.65.0 */
} CURLUPart;

// curl_url_set flags
#define CURLU_NON_SUPPORT_SCHEME (1<<3) /* allow non-supported scheme */
#define CURLU_URLENCODE (1<<7)          /* URL encode on set */
#define CURLU_DEFAULT_SCHEME (1<<2)     /* return default scheme if missing */
#define CURLU_GUESS_SCHEME (1<<9)       /* legacy curl-style guessing */
#define CURLU_NO_AUTHORITY (1<<10)      /* Allow empty authority when the scheme is unknown. */
#define CURLU_PATH_AS_IS (1<<4)         /* leave dot sequences */
#define CURLU_ALLOW_SPACE (1<<11)       /* Allow spaces in the URL */


CURLU *curl_url();
CURLUcode curl_url_set(CURLU *url, CURLUPart part, const char *content, unsigned int flags);
CURLUcode curl_url_get(CURLU *url, CURLUPart what, char **part, unsigned int flags);
