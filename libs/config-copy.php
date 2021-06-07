<?php

	/**
	 * ImMaker (仮) コンフィグファイル (config.php)
	 * 
	 * @access private
	 * @author Tateshiki0529
	 * @copyright Tateshiki0529 All Rights Reserved.
	 * @package ImMaker
	 * @category Configuration
	**/

	// YouTube Data API v3 用キー
	define("YTAPI_KEYS", [
		"***************************************",
		"***************************************",
		"***************************************"
	]);

	// キャッシュデータベース用設定
	define("DB_USER", "**********");
	define("DB_PASS", "****************");

	define("DB_DSN", "mysql:host=************************;dbname=********************;charset=utf8");
	define("DB_SETTING", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]);
	// 接続テスト
	// $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, DB_SETTING);

?>