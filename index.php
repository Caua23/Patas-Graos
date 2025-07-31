<?php
require __DIR__ . '/config/env.php';
require __DIR__ . '/config/db.php';

loadEnv();
$db = new Database();
require_once __DIR__ . '/routes/web.php';