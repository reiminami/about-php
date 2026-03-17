# about-php

*PHP8.4

## 目次

1. [Hello World](#hello-world)
1. [変数と定数](#変数と定数)
1. [データ型](#データ型)
1. [条件分岐](#条件分岐)
1. [ループ](#ループ)
1. [配列](#配列)
1. [列挙型](#列挙型)
1. [ユーザー定義関数](#ユーザー定義関数)
1. [クラスとオブジェクト](#クラスとオブジェクト)
1. [プロパティフック](#プロパティフック)
1. [クラスのオートロード](#クラスのオートロード)
1. [クラスの継承](#クラスの継承)
1. [インターフェース](#インターフェース)
1. [トレイト](#トレイト)
1. [名前空間](#名前空間)
1. [例外](#例外)
1. [フォーム](#フォーム)
1. [関数・メソッド](#関数メソッド)
1. [mysqli](#mysqli)
1. [mysqliクラス](#mysqliクラス)

## Hello World

- 出力

```php
<?php
echo 'Hello, World!';
?>
```

- コメント

```php
// Comment

/*
Comment
*/
```

[⬆︎目次へ戻る](#目次)

## 変数と定数

- 変数

```php
$name = 'John';
echo "Hello, $name";    // Hello, John
echo 'Hello, ' . $name; // Hello, John
```

- 定数

```php
define("TAX", 1.1);
const PI = 3.14;
```

[⬆︎目次へ戻る](#目次)

## データ型

- 型一覧
    - null
    - bool
    - int
    - float
    - string
    - array
    - object
    - enum

<br>

- 引数の型宣言

```php
function sum(int $a, int $b) {
	return $a + $b;
}
```

- 戻り値の型宣言
```php
function hello(): string {
	return "Hello";
}
```

- 強い型付け設定

```php
declare(strict_types=1);

function plusOne(int $a): int {
	return $a + 1;
}

echo plusOne(2) . PHP_EOL;
echo plusOne(true) . PHP_EOL;	// エラーになる
```

[⬆︎目次へ戻る](#目次)

## 条件分岐

- if文

```php
if ($num === 0) {
    echo "A";
} elseif ($num > 0) {
    echo "B";
} else {
    echo "C";
}
```

- switch文

```php
switch ($score) {
    case 1:
    case 2:
        echo "A";
        break;
    case 3:
        echo "B";
        break;
    case 4:
    case 5:
        echo "C";
        break;
    default:
        echo "Z";
        break;
}
```

- match文

```php
$msg = match($score) {
    1, 2    => "A",
    3       => "B",
    4, 5    => "C",
    default => "Z",
};
```

- 三項演算子

```php
$isGood = true;
echo $isGood ? "Good" : "Bad";
```

[⬆︎目次へ戻る](#目次)

## ループ

- for

```php
for ($i=0; $i<3; $i++) {
    echo $i;
}
```

- while

```php
while ($i < 3) {
    echo $i++;
}
```

- do-while

```php
do {
    echo $i++;
} while ($i < 3);
```

- foreach

```php
$nums = [0, 1, 2];
foreach($nums as $num) {
    echo $num . PHP_EOL;
}

$arr = ['one' => 1, 'two' => 2, 'three' => 3];
foreach ($arr as $key => $value) {
	echo "$key $value" . PHP_EOL;
}
```

[⬆︎目次へ戻る](#目次)

## 配列

- 配列宣言

```php
$nums = array('one' => 1, 'two' => 2);  // 基本
$nums = ['one' => 1, 'two' => 2];       // 短縮
$nums = ['one', 'two'];                 // キー省略
```

- 要素の追加

```php
$nums = [10, 20];
$nums[] = 30;
$nums[3] = 40;
$nums['x'] = 50;
```

- 要素の削除

```php
unset($arr[0]);
unset($arr['x']);
unset($arr);
```

- 要素の分解

```php
$arr = [10, 20, 30];
[$a, $b, $c] = $arr;    // a:10, b:20, c:30
[$d,   , $f] = $arr;    // d:10,       f:30
[$a, $b] = [$b, $a];    // a:20, b:10
```

[⬆︎目次へ戻る](#目次)

## 列挙型

- 列挙型

```php
enum Suit {
    case Hearts;
    case Diamonds;
    case Clubs;
    case Spades;
}

echo Suit::Clubs->name; // Clubs
```

- 値依存の列挙型

```php
enum Gender: string {
    case Male = '男';
    case Female = '女';
}

echo Gender::Male->name . PHP_EOL;  // Male
echo Gender::Male->value . PHP_EOL; // 男
```

[⬆︎目次へ戻る](#目次)

## ユーザー定義関数

- ユーザー定義関数

```php
function sum($a, $b) {
    return $a + $b;
}

echo sum(10, 20) . PHP_EOL; // 30
```

> 「関数」は`sum()`、「メソッド」は`$obj->sum()`みたいな感じ。

- **リファレンス渡し**: 関数にそのまま配列等を渡す

```php
function withYear(&$title, $year) {
    $title .= " ({$year})";
}

$title = 'Final Fantasy VII';
withYear($title, 1997);
echo $title . PHP_EOL;  // Final Fantasy VII (1997)
```

- **無名関数 (クロージャ)**: 関数名を指定せずに関数を作る

```php
$mr = function($name) {
    return "Mr. {$name}";
};
$name = 'John';
echo $mr($name);    // Mr. John
```

- **アロー関数**: 無名関数を簡潔に書いた版

```php
$mr = fn($name) => "Mr. {$name}";
```

[⬆︎目次へ戻る](#目次)

## クラスとオブジェクト

- 基本的なクラス

```php
class Person {
	public string $name = 'UNKNOWN';
	public function displayName() {
		echo $this->name;
	}
}
```

- インスタンス生成

```php
$p = new Person();
$p->name = 'John';
$p->displayName();
```

- オブジェクトの代入

```php
$p2 =& $p;
$p2->displayName();	// John
$p->name = 'Paul';
$p2->displayName();	// Paul
```

- コンストラクタ

```php
class Rectangle {
    public int $height;
    public int $width;
    public function area() {
        return $this->height * $this->width;
    }
    public function __construct($h, $w) {
        $this->height = $h;
        $this->width  = $w;
    }
}

$r = new Rectangle(10, 20);
echo $r->area();    // 200
```

- **finalキーワード**: 子クラスから上書き不能にする。

```php
final class TestCharacter {
    final public const MAX_HP = 9999;
    final public function testCall() {
        echo "Hello" . PHP_EOL;
    }
}
```

## プロパティフック

- アクセス権
    - `public`: どこからでもアクセス可能
    - `protected`: そのクラス自身、継承クラス、親クラスからアクセス可能
    - `private`: そのクラス自身のみからアクセス可能

<br>

- プロパティにsetter/getterを直接記述できる。

```php
class Character {
	public string $name {
		set {
            $this->name = $value;
		}
		get {
			return "My name is {$this->name}";
		}
	}
}
```

- アロー構文で簡略化可能。

```php
class Character {
	public string $name {
		set => $this->name = $value;
		get => "My name is {$this->name}";
	}
}
```

- **仮想プロパティ**: 値を保持しないプロパティ

```php
class Rectangle {
	public int $area {
		get => $this->h * $this->w;
	}
	public function __construct(public int $h, public int $w) {}
}

$r = new Rectangle(2, 4);
echo $r->area;
```

[⬆︎目次へ戻る](#目次)

## クラスのオートロード

**クラスのオートローディング**: クラス定義毎にファイルを用意して各スクリプトの先頭で読み込むのは面倒。以下のコードで任意の数のオートローダを読み込み、クラス等を自動的に読み込むことが可能。

- クラス`TestClass` を`TestClass.php` からロードする

```php
spl_autoload_register(function ($class_name) {
	include $class_name . '.php';
});

$obj = new TestClass();
echo $obj->id;
```

- クラスのオートローディング

```php
spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . '/models/' . $class_name . '.php';
    if (is_file($filename)) {
        require_once $filename;
    }
});
```

[⬆︎目次へ戻る](#目次)

## クラスの継承

- 継承

```php
class Square extends Rectangle {
    public function __construct($side) {
        parent::__construct($side, $side);
    }
}

$s = new Square(30);
echo $s->area();    // 900
```

- **抽象クラス**: 子クラスが実装すべきメソッド・プロパティを定義する

```php
abstract class Shape {
    protected string $name;
    public function __construct(string $name) {
        $this->name = $name;
    }
    abstract public function area(): float;     // 子クラスで必ず実装する
    public function describe() {
        return "This is a {$this->name}";
    }
}

class Rectangle extends Shape {
    private $h;
    private $w;
    public function __construct($h, $w) {
        parent::__construct("Rectangle");
        $this->h = $h;
        $this->w = $w;
    }
    public function area(): float {
        return $this->h * $this->w;
    }
}

$r = new Rectangle(10, 20);
echo $r->describe();
```

[⬆︎目次へ戻る](#目次)

## インターフェース

- インターフェースを用意。

```php
interface Payable {
    public function pay(int $amount);
}
```

- クラスにインターフェースを実装。

```php
class CreditCardPayment implements Payable {
    public function pay(int $amount) {
        echo "Paid {$amount} by credit card" . PHP_EOL;
    }
}

class CashPayment implements Payable {
    public function pay(int $amount) {
        echo "Paid {$amount} by cash" . PHP_EOL;
    }
}
```

- ルール不明でも受け取れる関数を作成。

```php
function checkout(Payable $payment) {
    $payment->pay(500);
}
```

- 呼び出し

```php
checkout(new CreditCardPayment());
checkout(new CashPayment());
```

[⬆︎目次へ戻る](#目次)

## トレイト

- クラスに追加できる共通機能（トレイト）を用意。

```php
trait Logger {
    public function log(string $msg) {
        echo "[LOG] " . $msg . PHP_EOL;
    }
}
```

- クラスでトレイトを使用。

```php
class UserService {
    use Logger;

    public function createUser() {
        $this->log("User created");
    }
}

class OrderService {
    use Logger;

    public function createOrder() {
        $this->log("Order created");
    }
}
```

- 呼び出し

```php
$user = new UserService();
$user->createUser();

$order = new OrderService();
$order->createOrder();
```

[⬆︎目次へ戻る](#目次)

## 名前空間

- **名前空間**: （要約）項目をカプセル化する仕組み。

```php
namespace App\Models;

class User {}
```

- **エイリアス/インポート**: 別の名前空間のものを使う。

```php
use App\Models\User;
use App\Models\User as U;
use function App\Models\hello;
use const App\Models\PI;
```

[⬆︎目次へ戻る](#目次)

## 例外

```php
function throwError() {
	throw new Exception('ERROR!');
}

try {
	throwError();
} catch (DateException | RangeException $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage() . PHP_EOL;
} finally {
	echo "End." . PHP_EOL;
}
```

[⬆︎目次へ戻る](#目次)

## フォーム

- [index.php](/form/index.php)

```php
<form action="action.php" method="post">
    <label for="name">名前:</label>
    <input type="text" name="name" id="name">

    <label for="age">年齢:</label>
    <input type="number" name="age" id="age">

    <button type="submit">送信</button>
</form>
```

- [action.php](/form/action.php)

```php
名前: <?php echo htmlspecialchars($_POST['name']); ?>歳
年齢: <?php echo $_POST['age']; ?>歳
```

- **POST**: データをHTTPボディに格納して送信
- **GET**:  データをクエリストリング(URLの後ろ)に格納して送信

[⬆︎目次へ戻る](#目次)

## 関数・メソッド

[公式ドキュメント](https://www.php.net/manual/ja/funcref.php)

*バイナリセーフ: バイナリセーフでない関数を使用した場合、Nullバイト攻撃に合う
*Nullバイト攻撃: 終端文字を含めることでチェックを潜り抜けてしまうこと

- Math

    - abs - 絶対値
    - ceil - 端数の切り上げ
    - floor - 端数の切り捨て
    - round - 浮動小数点数を丸める
    - intdiv - 整数値の除算
    - fmod - 除算した際の剰余
    - max - 最大値
    - min - 最小値

- String

    - <details><summary> 文字列比較 </summary>

        - strcmp - 文字列比較 (バイナリセーフ)
        - strcasecmp - 文字列比較 (バイナリセーフ / 大文字小文字区別なし)
        - strnatcmp - 文字列比較 (自然順アルゴリズム)
        - strnatcasecmp - 文字列比較 (自然順アルゴリズム / 大文字小文字区別なし)
        - strncmp - 文字列比較 (n文字目までバイナリセーフ)
        - strncasecmp - 文字列比較 (n文字目までバイナリセーフ / 大文字小文字区別なし)

    - <details><summary> HTML </summary>

        - htmlspecialchars - 特殊文字をHTMLエンティティに変換
        - htmlspecialchars_decode - HTMLエンティティを特殊文字に変換
        - strip_tags - 文字列からHTMLタグ、PHPタグを除去

    - <details><summary> 文字列分割 </summary>

        - explode - 文字列を指定文字列で分割
        - str_split - 文字列を指定文字数ごとで分割
        - wordwrap - 文字列を指定文字数ごとで分割 (文字数ごとに改行)
        - parse_str - URLのクエリストリングを文字列配列としてパース

    - <details><summary> 文字列置換 </summary>

        - str_replace - 文字列を全て置換
        - str_ireplace - 文字列を全て置換 (大文字小文字区別なし)
        - substr_replace - インデックスと文字数を指定して文字列を置換
        - ucfirst - 最初の文字を大文字に置換
        - lcfirst - 最初の文字を小文字に置換
        - strtolower - 文字列を大文字に置換
        - strtoupper - 文字列を小文字に置換
        - ucwords - 文字列の各単語の最初の文字を大文字に置換
        - strtr - 文字の変換あるいは部分文字列の置換

    - <details><summary> 文字列探索 </summary>

        - strpos - 文字列から指定文字列の最初の位置を返す
        - stripos - 文字列から指定文字列の最初の位置を返す (大文字小文字区別なし)
        - strstr - 文字列から指定文字列の最初の位置を見つけ文字列を返す
        - strchr - strstrと同じ
        - strrpos - 文字列から部分文字列の最後の位置を返す
        - strripos - 文字列から部分文字列の最後の位置を返す (大文字小文字区別なし)
        - str_contains - 文字列に部分文字列が含まれるか
        - str_starts_with - 文字列が部分文字列で始まるか
        - str_ends_with - 文字列が部分文字列で終わるか
        - substr - 文字列の一部分を返す
        - strspn - 指定マスク内に含まれる文字からなる文字列の最初のセグメントの長さを返す
        - strrchr - 文字列から指定文字列の最後の位置を見つけ文字列を返す

    - <details><summary> 文字列除去 </summary>

        - trim - 文字列の先頭及び末尾のホワイトスペースを除去
        - ltrim - 先頭のみのtrim
        - rtrim - 末尾のみのtrim

    - <details><summary> その他 </summary>

        - similar_text - ２つの文字列の類似性を計算
        - str_decrement - 文字列のデクリメント
        - str_increment - 文字列のインクリメント
        - implode - 配列要素を文字列で連結
        - str_pad - 文字列を固定長の文字列で埋める
        - str_repeat - 文字列を指定回数分反復
        - str_shuffle - 文字をシャッフル
        - str_word_count - 文字列に使用されている単語の情報を配列で返す
        - strlen - 文字列の長さ
        - strrev - 文字列を逆順にする
        - substr_count - 文字列の出現回数を数える

- 配列

    - <details><summary> 基本 </summary>

        - array - 配列を生成する
        - list - 複数の変数への代入を行う
        - array_keys - 配列の全てのキーまたはその一部を返す
        - array_values - 配列の全ての値を返す
        - array_key_first - 配列の最初のキーを得る
        - array_key_last - 配列の最後のキーを得る
        - array_key_exists - 指定したキーまたは添字が配列にあるかどうか調べる
        - key_exists - array_key_existsのエイリアス
        - in_array - 配列に値があるか調べる
        - array_is_list - 指定された配列がリストかどうか調べる
        - compact - 変数名とその値から配列を作成する
        - range - ある範囲の要素を含む配列を作成する

    - <details><summary> 検索 </summary>

        - array_search - 指定した値で配列を検索し、見つかった場合対応する最初のキーを返す
        - array_find - コールバック関数を満たす最初の要素を返す
        - array_find_key - コールバック関数を満たす最初の要素のキーを返す
        - array_column - 入力配列から単一のカラムの値を返す
        - array_unique - 配列から重複した値を削除する
        - array_filter - 配列の要素をコールバック関数でフィルタリングする
        - array_all - 配列の全ての要素がコールバック関数を満たすかどうか調べる
        - array_any - 配列のいずれかの要素がコールバック関数を満たすかどうか調べる

    - <details><summary> 編集 </summary>

        - array_pop - 配列の末尾から要素を取り除く
        - array_push - 配列の末尾に一つ以上の要素を追加する
        - array_shift - 配列の先頭から要素を取り出す
        - array_unshift - 配列の先頭に一つ以上の要素を追加する
        - array_merge - 一つまたは複数の配列をマージする
        - array_merge_recursive - 一つ以上の配列を再起的にマージする
        - array_replace - 配列の要素を置換する
        - array_replace_recursive - 配列の要素を再起的に置換する
        - array_splice - 配列の一部を削除し、他の要素で置換する

    - <details><summary> 変換 </summary>

        - array_reverse - 要素を逆順にした配列を返す
        - array_slice - 配列の一部を展開する
        - array_chunk - 配列を分割する
        - array_combine - 一方の配列をキーとして、もう一方の配列を値として、ひとつの配列を生成する
        - array_pad - 指定長に指定した値で配列を埋める
        - array_fill - 指定した値で配列を埋める
        - array_fill_keys - キーを指定して配列を埋める
        - array_change_key_case - 配列の全てのキーの大文字小文字を変更する
        - array_flip - 配列のキーと値を反転する
        - array_map - 配列の要素にコールバック関数を適用する
        - array_walk - 配列の全要素にユーザー定義関数を適用する
        - array_reduce - コールバック関数を繰り返し配列に適用し、配列を一つの値にまとめる

    - <details><summary> 計算 </summary>

        - count - 全ての要素の数
        - sizeof - countのエイリアス
        - array_sum - 配列の値の合計
        - array_product - 配列の値の積
        - array_count_values - 配列の異なる値の出現回数

    - <details><summary> ポインタ </summary>

        - key - 配列からキーを取り出す
        - prev - 配列の内部ポインタをひとつ前に戻す
        - current - 現在、配列の内部ポインタが指している要素を返す
        - pos - currentのエイリアス
        - next - 配列の内部ポインタを進める
        - reset - 配列の内部ポインタを先頭の要素にセットする
        - end - 配列の内部ポインタを末尾の要素にセットする

    - <details><summary> ソート </summary>

        - ksort - ソート (キー・昇順)
        - krsort - ソート (キー・降順)
        - asort - ソート (連想キーと要素の関係維持 / 昇順)
        - arsort - ソート (連想キーと要素の関係維持 / 降順)
        - sort - ソート (昇順)
        - rsort - ソート (降順)
        - natsort - ソート (自然順アルゴリズム)
        - natcasesort - ソート (自然順アルゴリズム / 大文字小文字区別なし)
        - array_multisort - 複数または多次元の配列をソート

[⬆︎目次へ戻る](#目次)

## mysqli

*MAMP使用

- 連携 (手続き型)

```php
// ホスト:ポート, ユーザー名, パスワード, データベース名
$mysqli = mysqli_connect("127.0.0.1:8889", "root", "root", "test_db");
$result = mysqli_query($mysqli, "SELECT 'Test' AS msg FROM DUAL;");
$row = mysqli_fetch_assoc($result);
echo $row['msg'];
```

- 連携 (オブジェクト指向)

```php
$mysqli = new mysqli("127.0.0.1:8889", "root", "root", "test_db");
$result = $mysqli->query("SELECT 'Test' AS msg FROM DUAL;");
$row = $result->fetch_assoc();
echo $row['msg'];
```

- (例：CREATE文)

```php
$mysqli->query("DROP TABLE IF EXISTS employees");
$mysqli->query("CREATE TABLE employees(
                    id INT NOT NULL AUTO_INCREMENT,
                    name VARCHAR(64),
                    PRIMARY KEY (id))");
```

- **プリペアドステートメント**: SQL文のテンプレートを事前にコンパイルし、パラメータのみ後からバインドして実行する仕組み。一度に複数INSERTすることで、クライアント・サーバー間の通信を減らすことも可能。

```php
$stmt = $mysqli->prepare("INSERT INTO employees(id, name) VALUES (?, ?)");
$id = null;
$name = 'John';
$stmt->bind_param("is", $id, $name);	// "is" は"int, string" の意味
$stmt->execute();						// 実行
```

- **ストアドプロシージャ**: 呼び出して実行できるサブルーチン。

**IN**

```php
$mysqli->query("DROP PROCEDURE IF EXISTS p");
$mysqli->query("CREATE PROCEDURE p(IN name_val VARCHAR(64))
				BEGIN
					INSERT INTO employees(id, name) VALUES(NULL, name_val);
				END;");
$mysqli->query("CALL p('Paul')");
```

**OUT**

```php
$mysqli->query("DROP PROCEDURE IF EXISTS p");
$mysqli->query('CREATE PROCEDURE p(OUT msg VARCHAR(10))
				BEGIN
					SELECT "Hello" INTO msg;
				END;');
$mysqli->query("SET @msg = ''");
$mysqli->query("CALL p(@msg)");
$result = $mysqli->query("SELECT @msg AS msg_out");
$row = $result->fetch_assoc();
echo $row['msg_out'];	// Hello
```

- トランザクション

```php
$mysqli->autocommit(false);
$mysqli->query('SET AUTOCOMMIT = 0');
```

- コミットとロールバック

```php
$mysqli->autocommit(false);

$mysqli->query("INSERT INTO employees(id, name) VALUES (1, 'John')");
$mysqli->rollback();	// ロールバックされid:1は挿入されない

$mysqli->query("INSERT INTO employees(id, name) VALUES (2, 'Paul')");
$mysqli->commit();		// id:2のみコミットされる
```

[⬆︎目次へ戻る](#目次)

## mysqliクラス

*`$mysqli->affected_rows` のように扱う。

- プロパティ
    - $affected_rows - 直前の操作で変更された行数
    - $client_info - クライアント情報
    - $client_version - クライアントのバージョン
    - $connect_errno - 直近の接続コールのエラーコード
    - $connect_error - 直近の接続エラーの説明
    - $errno - 直近の関数コールのエラーコード
    - $error - 直近のエラーの内容
    - $error_list - 直近で実行したコマンドからのエラーの一覧
    - $field_count - 直近のクエリのカラムの数
    - $host_info - 使用している接続の型
    - $info - 直近に実行されたクエリの情報
    - $insert_id - 直近のクエリのAUTO_INCREMENTカラムで生成した値
    - $server_info - MySQLサーバーのバージョン
    - $server_version - MySQLサーバーのバージョン (整数値)
    - $sqlstate - 直前の操作のSQLSTATEエラー
    - $protocol_version - MySQLプロトコルのバージョン
    - $thread_id - 現在の接続のスレッドID
    - $warning_count - 直近の実行されたクエリから発生した警告の数
- 接続
    - [コンストラクタ](/mysqli/connection.php) - 新規にMySQLサーバーへ接続
    - [close](/mysqli/connection.php) - 接続を閉じる
    - [change_user](/mysqli/connection.php) - DB接続のユーザーを変更
    - [real_escape_string](/mysqli/connection.php) - SQL文で使用する文字列の特殊文字をエスケープする
    - [character_set_name](/mysqli/connection.php) - 現在の文字コードセット
    - poll - 接続の問い合わせ
    - real_connect - 接続をオープンする
    - ssl_set - SSLを使用したセキュア接続
    - kill - スレッド停止の問い合わせ
- トランザクション
    - [autocommit](/mysqli/transaction.php) - 自動コミットのオン/オフ
    - [begin_transaction](/mysqli/transaction.php) - トランザクションを開始する
    - [commit](/mysqli/transaction.php) - 現在のトランザクションをコミット
    - [rollback](/mysqli/transaction.php) - 現在のトランザクションをロールバック
    - [savepoint](/mysqli/transaction.php) - トランザクションのセーブポイントを設定
    - [release_savepoint](/mysqli/transaction.php) - 指定したセーブポイントを削除
- クエリ
    - [query](/mysqli/query/query.php) - クエリ実行
    - [execute_query](/mysqli/query/execute_query.php) - SQL文を準備し、変数をバインドし実行
    - [multi_query](/mysqli/query/multi_query.php) - DBで一つ以上のクエリを実行
    - [more_results](/mysqli/query/multi_query.php) - マルチクエリの結果はまだ残っているか確認
    - [next_result](/mysqli/query/multi_query.php) - multi_queryの次の結果を準備
    - [store_result](/mysqli/query/multi_query.php) - 直近のクエリから結果セットを転送
    - [prepare](/mysqli/query/prepare.php) - 実行するためのSQL文を準備
    - real_query - SQLクエリ実行
    - [select_db](/mysqli/query/select_db.php) - クエリを実行するためのデフォルトのDBを選択
    - reap_async_query - 非同期クエリから結果を取得
- デバッグ
    - debug - デバッグ操作
    - dump_debug_info - デバッグ情報をログに出力
- 情報
    - [get_connection_stats](/mysqli/consconnectiontruct.php) - クライアント接続の統計情報
    - set_charset - 文字セットの設定
    - get_charset - 文字セットオブジェクトを返す
    - get_warnings - SHOW WARNINGS の結果を取得する
    - init - MySQLi を初期化し、mysqli_real_connect() で使うオブジェクトを返す
    - options - オプションを設定する
    - refresh - リフレッシュする
    - stat - 現在のシステム状態
    - stmt_init - ステートメントを初期化し、mysqli_stmt_prepare で使用するオブジェクトを返す
    - thread_safe - スレッドセーフであるかどうかを返す
    - use_result - 結果セットの取得を開始する

[⬆︎目次へ戻る](#目次)
