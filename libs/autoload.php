<?php 

	/**
	 * ImMaker 初期ロードファイル (autoload.php)
	 * 
	 * @access private
	 * @author Tateshiki0529
	 * @copyright Tateshiki0529 All Rights Reserved.
	 * @package ImMaker
	 * @category Configuration
	**/

	// 関数読み込み
	include_once dirname(__FILE__)."/functions.php";

	// コンフィグ読み込み
	include_once dirname(__FILE__)."/config.php";

	// クラス読み込み
	include_once dirname(__FILE__)."/class.cache.php";
?>