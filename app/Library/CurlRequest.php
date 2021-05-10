<?php
namespace App\Library; use Illuminate\Support\Facades\Log; class CurlRequest { public static function curl($sp783cd0, $sp4a694e = 0, $spdd1c3e = '', $spb33460 = array(), $sp51eb68 = 5, &$sp2e79ca = false, &$sp31c6fc = false, &$spe14ddb = false) { if (!isset($spb33460['Accept']) && !isset($spb33460['accept'])) { $spb33460['Accept'] = '*/*'; } if (!isset($spb33460['Referer']) && !isset($spb33460['referer'])) { $spb33460['Referer'] = $sp783cd0; } if (!isset($spb33460['Content-Type']) && !isset($spb33460['content-type'])) { $spb33460['Content-Type'] = 'application/x-www-form-urlencoded'; } if (!isset($spb33460['User-Agent']) && !isset($spb33460['user-agent'])) { $spb33460['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'; } if ($sp2e79ca !== false) { $spb33460['Cookie'] = $sp2e79ca; } $spce58e3 = array(); foreach ($spb33460 as $sp19d473 => $sp4d4e6e) { $spce58e3[] = $sp19d473 . ': ' . $sp4d4e6e; } $spce58e3[] = 'Expect:'; $sp7732b4 = curl_init(); curl_setopt($sp7732b4, CURLOPT_URL, $sp783cd0); curl_setopt($sp7732b4, CURLOPT_SSL_VERIFYPEER, true); curl_setopt($sp7732b4, CURLOPT_SSL_VERIFYHOST, 2); curl_setopt($sp7732b4, CURLOPT_FOLLOWLOCATION, true); curl_setopt($sp7732b4, CURLOPT_MAXREDIRS, 3); if ($sp4a694e == 1) { curl_setopt($sp7732b4, CURLOPT_CUSTOMREQUEST, 'POST'); curl_setopt($sp7732b4, CURLOPT_POST, 1); if ($spdd1c3e !== '') { curl_setopt($sp7732b4, CURLOPT_POSTFIELDS, $spdd1c3e); curl_setopt($sp7732b4, CURLOPT_POSTREDIR, 3); } } if (defined('MY_PROXY')) { $sp3e0238 = MY_PROXY; $sp2273f8 = CURLPROXY_HTTP; if (strpos($sp3e0238, 'http://') || strpos($sp3e0238, 'https://')) { $sp3e0238 = str_replace('http://', $sp3e0238, $sp3e0238); $sp3e0238 = str_replace('https://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_HTTP; } elseif (strpos($sp3e0238, 'socks4://')) { $sp3e0238 = str_replace('socks4://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS4; } elseif (strpos($sp3e0238, 'socks4a://')) { $sp3e0238 = str_replace('socks4a://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS4A; } elseif (strpos($sp3e0238, 'socks5://')) { $sp3e0238 = str_replace('socks5://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS5_HOSTNAME; } curl_setopt($sp7732b4, CURLOPT_PROXY, $sp3e0238); curl_setopt($sp7732b4, CURLOPT_PROXYTYPE, $sp2273f8); if (defined('MY_PROXY_PASS')) { curl_setopt($sp7732b4, CURLOPT_PROXYUSERPWD, MY_PROXY_PASS); } } curl_setopt($sp7732b4, CURLOPT_TIMEOUT, $sp51eb68); curl_setopt($sp7732b4, CURLOPT_CONNECTTIMEOUT, $sp51eb68); curl_setopt($sp7732b4, CURLOPT_RETURNTRANSFER, 1); curl_setopt($sp7732b4, CURLOPT_HEADER, 1); curl_setopt($sp7732b4, CURLOPT_HTTPHEADER, $spce58e3); $sp501b73 = curl_exec($sp7732b4); if (curl_errno($sp7732b4)) { $spe14ddb = curl_error($sp7732b4); curl_close($sp7732b4); return null; } $sp783f5e = curl_getinfo($sp7732b4, CURLINFO_HEADER_SIZE); if ($sp31c6fc) { $sp31c6fc = curl_getinfo($sp7732b4, CURLINFO_HTTP_CODE); } $spf02afa = substr($sp501b73, 0, $sp783f5e); $spd21014 = substr($sp501b73, $sp783f5e); curl_close($sp7732b4); if ($sp2e79ca !== false) { $spb33460 = explode('
', $spf02afa); $sp5ac3df = ''; foreach ($spb33460 as $spf02afa) { if (strtolower(substr($spf02afa, 0, 11)) === 'set-cookie:') { $spf02afa = 'Set-Cookie:' . substr($spf02afa, 11); if (strpos($spf02afa, 'Set-Cookie') !== false) { if (strpos($spf02afa, ';') !== false) { $sp5ac3df = $sp5ac3df . trim(Helper::str_between($spf02afa, 'Set-Cookie:', ';')) . ';'; } else { $sp5ac3df = $sp5ac3df . trim(str_replace('Set-Cookie:', '', $spf02afa)) . ';'; } } } } $sp2e79ca = self::combineCookie($sp2e79ca, $sp5ac3df); } return $spd21014; } public static function get($sp783cd0, $spb33460 = array(), $sp51eb68 = 5, &$sp2e79ca = false) { return self::curl($sp783cd0, 0, '', $spb33460, $sp51eb68, $sp2e79ca); } public static function post($sp783cd0, $spdd1c3e = '', $spb33460 = array(), $sp51eb68 = 5, &$sp2e79ca = false) { return self::curl($sp783cd0, 1, $spdd1c3e, $spb33460, $sp51eb68, $sp2e79ca); } public static function download($sp783cd0, $sp2be97f, $sp7e565e = false) { $sp6ac014 = fopen($sp2be97f, 'w+'); if (!$sp6ac014) { throw new \Exception('cant open file: ' . $sp2be97f); } $sp7732b4 = curl_init(); curl_setopt($sp7732b4, CURLOPT_URL, $sp783cd0); curl_setopt($sp7732b4, CURLOPT_FOLLOWLOCATION, true); curl_setopt($sp7732b4, CURLOPT_RETURNTRANSFER, true); curl_setopt($sp7732b4, CURLOPT_FILE, $sp6ac014); if ($sp7e565e) { curl_setopt($sp7732b4, CURLOPT_PROGRESSFUNCTION, function ($spabe4fd, $spc6e807, $spa9db98, $spbf64f9, $spc09abb) { if ($spc6e807 > 0) { echo '    download: ' . sprintf('%.2f', $spa9db98 / $spc6e807 * 100) . '%'; } }); curl_setopt($sp7732b4, CURLOPT_NOPROGRESS, false); } curl_setopt($sp7732b4, CURLOPT_HEADER, 0); curl_setopt($sp7732b4, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'); if (defined('MY_PROXY')) { $sp3e0238 = MY_PROXY; $sp2273f8 = CURLPROXY_HTTP; if (strpos($sp3e0238, 'http://') || strpos($sp3e0238, 'https://')) { $sp3e0238 = str_replace('http://', $sp3e0238, $sp3e0238); $sp3e0238 = str_replace('https://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_HTTP; } elseif (strpos($sp3e0238, 'socks4://')) { $sp3e0238 = str_replace('socks4://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS4; } elseif (strpos($sp3e0238, 'socks4a://')) { $sp3e0238 = str_replace('socks4a://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS4A; } elseif (strpos($sp3e0238, 'socks5://')) { $sp3e0238 = str_replace('socks5://', $sp3e0238, $sp3e0238); $sp2273f8 = CURLPROXY_SOCKS5_HOSTNAME; } curl_setopt($sp7732b4, CURLOPT_PROXY, $sp3e0238); curl_setopt($sp7732b4, CURLOPT_PROXYTYPE, $sp2273f8); if (defined('MY_PROXY_PASS')) { curl_setopt($sp7732b4, CURLOPT_PROXYUSERPWD, MY_PROXY_PASS); } } curl_exec($sp7732b4); if (curl_errno($sp7732b4)) { curl_close($sp7732b4); throw new \Exception('curl_error: ' . curl_error($sp7732b4)); } curl_close($sp7732b4); return true; } public static function combineCookie($sp6369b1, $sp7f26db) { $sp1be134 = explode(';', $sp6369b1); $sp6f53b1 = explode(';', $sp7f26db); foreach ($sp1be134 as $sp41c6bc) { if (self::cookieIsExists($sp6f53b1, self::cookieGetName($sp41c6bc)) == false) { array_push($sp6f53b1, $sp41c6bc); } } $sp6a4c99 = ''; foreach ($sp6f53b1 as $sp41c6bc) { if (substr($sp41c6bc, -8, 8) != '=deleted' && strlen($sp41c6bc) > 1) { $sp6a4c99 .= $sp41c6bc . '; '; } } return substr($sp6a4c99, 0, strlen($sp6a4c99) - 1); } public static function cookieGetName($spdd30c8) { $sp1ac04e = strpos($spdd30c8, '='); return substr($spdd30c8, 0, $sp1ac04e); } public static function cookieGetValue($spdd30c8) { $sp1ac04e = strpos($spdd30c8, '='); $sp03086c = substr($spdd30c8, $sp1ac04e + 1, strlen($spdd30c8) - $sp1ac04e); return $sp03086c; } public static function cookieGet($sp2e79ca, $sp66f74c, $sp6677f2 = false) { $sp2e79ca = str_replace(' ', '', $sp2e79ca); if (substr($sp2e79ca, -1, 1) != ';') { $sp2e79ca = ';' . $sp2e79ca . ';'; } else { $sp2e79ca = ';' . $sp2e79ca; } $sp9ad36c = Helper::str_between($sp2e79ca, ';' . $sp66f74c . '=', ';'); if (!$sp6677f2 || $sp9ad36c == '') { return $sp9ad36c; } else { return $sp66f74c . '=' . $sp9ad36c; } } private static function cookieIsExists($sp648be7, $sp0c762a) { foreach ($sp648be7 as $sp41c6bc) { if (self::cookieGetName($sp41c6bc) == $sp0c762a) { return true; } } return false; } function test() { $sp03086c = self::combineCookie('a=1;b=2;c=3', 'c=5'); var_dump($sp03086c); } }