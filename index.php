<?php
/**
 * Force the apex (non-www) domain to www — 301 permanent redirect.
 *
 * Runs on Azure App Service (PHP runtime): PHP looks for index.php before
 * index.html, so this executes on every page hit. Only the bare domain is
 * redirected; www and the *.azurewebsites.net host are left untouched.
 */
$host = strtolower($_SERVER['HTTP_HOST'] ?? '');

if ($host === 'lcreationssalon.com') {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    header('Location: https://www.lcreationssalon.com' . $uri, true, 301);
    exit;
}

// Any other host (www or the Azure default) — serve the static site.
header('Content-Type: text/html; charset=UTF-8');
readfile(__DIR__ . '/index.html');
