<?php
	/**
	 * ImMaker Cacheクラス 例外クラス群 (exceptions.cache.php)
	 * 
	 * Cacheクラスで利用する例外クラスをまとめたファイル。
	 * 
	 * @access private
	 * @author Tateshiki0529
	 * @copyright Tateshiki0529 All Rights Reserved.
	 * @package ImMaker
	 * @category Exceptions
	**/

	/**
	 * [Connect] DB接続エラーの例外 (DBConnectException)
	 * 
	 * 呼び出し時に接続に失敗した際にスローされる。
	**/
	class DBConnectException extends Exception {
		public function __construct(string $e) {
			parent::__construct("キャッシュDBへの接続に失敗しました。時間をおいて再度やり直してください。\n{$e}", 50001);
		}
	}

	/**
	 * [Connect] DB書き込みエラーの例外 (DBWriteException)
	 * 
	 * 書き込みに失敗した際にスローされる。
	**/
	class DBWriteException extends Exception {
		public function __construct(string $e) {
			parent::__construct("キャッシュDBへの書き込みに失敗しました。時間をおいて再度やり直してください。\n{$e}", 50002);
		}
	}

	/**
	 * [Connect] DB読み込みエラーの例外 (DBReadException)
	 * 
	 * 読み込みに失敗した際にスローされる。
	**/
	class DBReadException extends Exception {
		public function __construct(string $e) {
			parent::__construct("キャッシュDBの読み込みに失敗しました。時間をおいて再度やり直してください。\n{$e}", 50002);
		}
	}
?>