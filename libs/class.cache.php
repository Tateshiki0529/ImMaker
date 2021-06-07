<?php

	/**
	 * ImMaker キャッシュ管理クラス (class.cache.php)
	 * 
	 * キャッシュの管理をするクラス。
	 * 
	 * @access public
	 * @author Tateshiki0529
	 * @copyright Tateshiki0529 All Rights Reserved.
	 * @package ImMaker
	 * @category Class
	**/

	// 例外クラス読み込み
	include_once dirname(__FILE__)."/exceptions.cache.php";

	class Cache {
		private $pdo;

		/**
		 * [Wakeup] コンストラクタ (__construct)
		 * 
		 * PDOの接続を行う。
		 * 
		 * @access public
		 * @param void
		 * @return void
		 * @throws DBConnectException 接続失敗時の例外
		**/
		public function __construct() {
			try {
				$this->pdo = new PDO(DB_DSN, DB_USER, DB_PASS, DB_SETTING);
			} catch (PDOException $e) {
				throw new DBConnectException($e->getMessage());
			}
		}

		/**
		 * [Write] DBデータ追加 (add)
		 * 
		 * INSERT文を用いてデータを追加する。
		 * 
		 * @access public
		 * @param string $table 追加するテーブル
		 * @param array $data 追加するデータ (例: ["time" => time(), "id" => "hogehoge"] --> (`time`, `id`) VALUES ('1623045743', 'hogehoge'))
		 * @return bool $result 実行結果
		 * @throws DBWriteException 書き込み失敗時の例外
		**/
		public function add(string $table, array $data): bool {
			try {
				$columnList = $valueList = [];
				foreach ($data as $k => $v) {
					$columnList[] = "`{$k}`";
					$valueList[] = "'{$v}'";
				}
				$columns = implode(", ", $columnList);
				$values = implode(", ", $valueList);
				$sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$values});";
				$stmt = $this->pdo->prepare($sql);
				return $stmt->execute();
			} catch (PDOException $e) {
				throw new DBWriteException($e->getMessage());
			}
		}

		/**
		 * [Write] DBデータ編集 (modify)
		 * 
		 * UPDATE文を用いてデータを編集する。
		 * 
		 * @access public
		 * @param string $table 追加するテーブル
		 * @param array $data 編集するデータ (例: ["time" => time(), "id" => "hogehoge"] --> SET `time` = '1623045743', `id` = 'hogehoge')
		 * @param array $cond 条件 (["data" => "foobarbaz"] --> WHERE `data` = 'foobarbaz')
		 * @return bool $result 実行結果
		 * @throws DBWriteException 書き込み失敗時の例外
		**/
		public function modify(string $table, array $data, array $cond): bool {
			try {
				$dataList = $condList = [];
				foreach ($data as $k => $v) {
					$dataList[] = "`{$k}` = '{$v}'";
				}
				foreach ($cond as $k => $v) {
					$condList[] = "`{$k}` = '{$v}'";
				}
				$datas = implode(", ", $dataList);
				$conditions = implode(" AND ", $condList);
				$sql = "UPDATE `{$table}` SET {$datas} WHERE {$conditions};";
				$stmt = $this->pdo->prepare($sql);
				return $stmt->execute();
			} catch (PDOException $e) {
				throw new DBWriteException($e->getMessage());
			}
		}

		/**
		 * [Write] DBデータ削除 (remove)
		 * 
		 * DELETE文を用いてデータを編集する。
		 * 
		 * @access public
		 * @param string $table 追加するテーブル
		 * @param array $cond 条件 (["data" => "foobarbaz"] --> WHERE `data` = 'foobarbaz')
		 * @return bool $result 実行結果
		 * @throws DBWriteException 書き込み失敗時の例外
		**/
		public function remove(string $table, array $cond): bool {
			try {
				$condList = [];
				foreach ($cond as $k => $v) {
					$condList[] = "`{$k}` = '{$v}'";
				}
				$conditions = implode(" AND ", $condList);
				$sql = "DELETE FROM `{$table}` WHERE {$conditions};";
				$stmt = $this->pdo->prepare($sql);
				return $stmt->execute();
			} catch (PDOException $e) {
				throw new DBWriteException($e->getMessage());
			}
		}

		/**
		 * [Write] DBデータ取得 (get)
		 * 
		 * データを取得する。
		 * 
		 * @access public
		 * @param string $table 読み込むテーブル名
		 * @param array ($cond 条件 (例: [":foo" => "bar", ":hoge" => "huga"])) (Default: null)
		 * @return array|false $result 実行結果
		 * @throws DBReadException 読み込み失敗時の例外
		**/
		public function get(string $table, array $cond = null): mixed {
			try {
				$condList = [];
				$condStr = "";
				if (!is_null($cond)) foreach ($cond as $k => $v) $condList[] = "`$k` = '$v'";
				if (count($condList) != 0) $conditions = " WHERE ".implode(" AND ", $condList);
				$sql = "SELECT * FROM `{$table}`{$conditions};";
				$stmt = $this->pdo->prepare($sql);
				if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_ASSOC);
				return false;
			} catch (PDOException $e) {
				throw new DBReadException($e->getMessage());
			}
		}
	}
?>