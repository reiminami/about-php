# About PHP

*PHP8.4

## 目次

1. [命名規則](#命名規則)
1. [Hello World](#hello-world)
1. [変数と定数](#変数と定数)
1. [データ型](#データ型)
1. [条件分岐](#条件分岐)
1. [ループ](#ループ)
1. [配列](#配列)
1. [列挙型](#列挙型)
1. [関数](#関数)
1. [クラス](#クラス)
1. [継承](#継承)
1. [標準関数](#標準関数)
1. [キャスト](#キャスト)
1. [例外](#例外)
1. [名前空間](#名前空間)
1. [ファイル読み込み](#ファイル読み込み)
1. [クラスのオートロード](#クラスのオートロード)
1. [フォーム](#フォーム)
1. [mysqli (基本)](#mysqli-基本)
1. [mysqli (応用)](#mysqli-応用)
1. [PDO](#pdo)

## 命名規則

```php
// 変数
$my_name = 'John';  // 第1候補
$myName = 'John';   // 第2候補

// 定数
const MY_CONST = 3.14;

// 関数
function myFunction() {
    echo 'Hello';
}

// クラス
class MyClass {
    // メソッド
    private function myMethod() {}
}

// ファイル名
// MyClass.php
```

[⬆︎目次へ戻る](#目次)

## Hello World

**最低限のコード**

```php
<?php
echo 'Hello, World!' . PHP_EOL;
?>
```

**実行**

```sh
php sample.php
```

[⬆︎目次へ戻る](#目次)

## 変数と定数

**変数**

```php
$name = 'John';
echo $name . PHP_EOL;
```

**定数**

```php
define("PI", 3.14);
const PI2 = 3.14;
echo PI . PHP_EOL;
echo PI2 . PHP_EOL;
```

**テンプレートリテラル**

```php
$name = 'John';
echo "Hello, {$name}!" . PHP_EOL;
```

**null合体演算子**

```php
$username = $_GET['username'] ?? 'GUEST';
echo $username . PHP_EOL;
```

[⬆︎目次へ戻る](#目次)

## データ型

**型一覧**

- null
- bool
- int
- float
- string
- array
- object
- callable
- iterable
- mixed
- never
- void

**Union型**

```php
function output(int|string $x): void {
    echo $x . PHP_EOL;
}
output(100);
output("hundred");
```

**Nullable型**

```php
function find(): ?User {
    return null;
}
```

**強い型付け設定**

```php
declare(strict_types=1);    // ファイルの先頭に書くこと
```

[⬆︎目次へ戻る](#目次)

## 条件分岐

**if**

```php
if ($score === 0) {
    echo 'A';
} elseif ($score === 1) {
    echo 'B';
} else {
    echo 'C';
}
```

**switch**

```php
switch ($score) {
    case 0:
        echo 'A';
        break;
    case 1:
        echo 'B';
        break;
    default:
        echo 'C';
        break;
}
```

**match**

```php
$msg = match($score) {
    0       => 'A',
    1       => 'B',
    2, 3    => 'C',
    default => 'Z',
};
```

**三項演算子**

```php
$isGood = true;
echo $isGood ? 'Good' : 'Bad';
```

[⬆︎目次へ戻る](#目次)

## ループ

**for**

```php
for ($i=0; $i<3; $i++) {
    echo $i . PHP_EOL;
}
```

**while**

```php
$i = 0;
while ($i < 3) {
    echo $i++ . PHP_EOL;
}
```

**do-while**

```php
$i = 0;
do {
    echo $i++ . PHP_EOL;
} while ($i < 3);
```

**foreach**

```php
$nums = [10, 20, 30];
foreach ($nums as $num) {
    echo $num . PHP_EOL;
}

$arr = ['one' => 1, 'two' => 2, 'three' => 3];
foreach ($arr as $key => $value) {
    echo "{$key} {$value}" . PHP_EOL;
}
```

[⬆︎目次へ戻る](#目次)

## 配列

**初期化・アクセス**

```php
// 基本 (配列)
$nums1 = [10, 20, 30];

// 基本 (連想配列)
$nums2 = array('one' => 1, 'two' => 2);

// 短縮
$nums3 = ['one' => 1, 'two' => 2];

// アクセス
echo $nums1[0];
```

**要素追加**

```php
$nums = [10, 20];

$nums[] = 30;
$nums[3] = 40;
$nums['four'] = 50;
```

**要素削除**

```php
unset($nums['four']);
unset($nums[3]);
```

**要素分解**

```php
$nums = [10, 20, 30];
[$a, $b, $c] = $nums;   // a:10, b:20, c:30
[$d,   , $f] = $nums;   // d:10,       f:30
```

[⬆︎目次へ戻る](#目次)

## 列挙型

**enum**

```php
enum Direction {
    case Top;
    case Bottom;
    case Left;
    case Right;
};

echo Direction::Bottom->name;   // Bottom
```

**値依存enum**

```php
enum Direction: int {
    case Top = 0;
    case Bottom = 1;
    case Left = 2;
    case Right = 3;
};

echo Direction::Bottom->name;   // Bottom
echo Direction::Bottom->value;  // 1
```

[⬆︎目次へ戻る](#目次)

## 関数

**定義・使用**

```php
function sum(int $a, int $b): int {
    return $a + $b;
}

echo sum(10, 20);
```

**リファレンス渡し**

```php
function swap(int &$a, int &$b): void {
    [$a, $b] = [$b, $a];
}

$a = 10;
$b = 20;

echo $a . ' ' . $b . PHP_EOL;   // 10 20
swap($a, $b);
echo $a . ' ' . $b . PHP_EOL;   // 20 10
```

**無名関数/クロージャ** - 関数名を指定せずに関数を作る

```php
$mister = function($name) {
    return "Mr. {$name}";
};

$name = 'John';
echo $mister($name);    // Mr. John
```

**アロー関数** - 無名関数を簡潔に書く

```php
$mister = fn($name) => "Mr. {$name}";

$name = 'John';
echo $mister($name);
```

[⬆︎目次へ戻る](#目次)

## クラス

**定義**

```php
class Person {
    public string $name = '???';
    public function displayName(): void {
        echo $this->name;
    }
}
```

**インスタンス生成**

```php
$person = new Person();
$person->name = 'John';
$person->displayName();
```

**コンストラクタ**

```php
class Rectangle {
    public int $width;
    public int $height;
    public function area(): int {
        return $this->width * $this->height;
    }
    public function __construct(int $w, int $h) {
        $this->width = $w;
        $this->height = $h;
    }
}

$rect = new Rectangle(10, 20);
echo $rect->area();
```

**finalキーワード** - 子クラスから上書き不可にする

```php
final class Goblin {}
```

**プロパティフック** - getter, setter

```php
class Person {
    private string $_name;

    public string $name {
        set {
            $this->_name = $value;
        }
        get {
            $this->_name;
        }
    }
}
```

**アロー構文** - 簡略化したgetter, setter

```php
class Person {
    private string $_name;

    public string $name {
        set => $this->_name = $value;
        get => $this->_name;
    }
}
```

**staticメンバ**

```php
class Timer {
    public static int $cnt = 0;

    public static function plus(): void {
        self::$cnt++;
    }
}

$t = new Timer();
echo $t::$cnt . PHP_EOL;    // 0
$t->plus();
echo $t::$cnt . PHP_EOL;    // 1
```

**コンストラクタのプロモーション**

```php
class Person {
    public function __construct(
        public string $name,
        public int $age,
    ) {}
}
```

**仮想プロパティ**

```php
class Rectangle {
    public int $area {
        get => $this->w * $this->h;
    }
    public function __construct(public int $w, public int $h) {}
}
```

**読み込み専用**

```php
readonly class User {
    public readonly int $id;
}
```

[⬆︎目次へ戻る](#目次)

## 継承

**継承**

```php
class Square extends Rectangle {
    public function __construct(int $side) {
        parent::__construct($side, $side);
    }
}
```

**抽象クラス**

```php
abstract class Animal {
    protected string $name;
    abstract protected function cry(): void;  // 子クラスで必ず実装する
    protected function toString(): void {
        echo "Name: {$this->name}";
    }
}

class Dog extends Animal {
    #[Override]
    protected function cry(): void {
        echo "Woof";
    }
}
```

**インターフェース**

```php
interface Payable {
    public function pay(int $amount);
}

class CreditCardPayment implements Payable {
    #[Override]
    public function pay(int $amount) {
        echo "Paid {$amount} by credit card" . PHP_EOL;
    }
}

class CashPayment implements Payable {
    #[Override]
    public function pay(int $amount) {
        echo "Paid {$amount} by cash" . PHP_EOL;
    }
}
```

**インターフェースを使用した関数** - ルール不明でも受け取れる関数を作成可能

```php
function checkout(Payable $payment) {
    $payment->pay(500);
}

checkout(new CreditCardPayment);
checkout(new CashPayment);
```

**トレイト** - クラスに追加できる共通機能

```php
trait Logger {
    public function log(string $msg) {
        echo "[LOG] {$msg}" . PHP_EOL;
    }
}

class User {
    use Logger;

    public function create() {
        $this->log("User created.");
    }
}
```

[⬆︎目次へ戻る](#目次)

## 標準関数

**数学**

```php
$x = abs(-5);       // 絶対値
$x = ceil(1.2);     // 切り上げ
$x = floor(1.6);    // 切り下げ
$x = round(1.5);    // 浮動小数点数を丸める
$x = intdiv(11, 4); // 整数の除算
$x = fmod(11, 4);   // 除算した際の剰余
$x = max(4, 5);     // 最大値
$x = min(6, 7);     // 最小値
```

**文字列 (比較)** - すべての関数は、一致した場合0を返す

> Nullバイト攻撃: 終端文字を含めることでチェックを潜り抜ける

> バイナリセーフ: バイナリセーフでない関数を使用した場合はNullバイト攻撃に合う

```php
$x = strcmp('A', 'A');              // バイナリセーフ
$x = strcasecmp('A', 'a');          // バイナリセーフ・大文字小文字区別なし
$x = strnatcmp('A', 'A');           // 自然順アルゴリズム
$x = strnatcasecmp('A', 'a');       // 自然順アルゴリズム・大文字小文字区別なし
$x = strncmp('A', 'A', 1);          // 文字列の長さ[2]までバイナリセーフ
$x = strncasecmp('A', 'a', 1);      // 文字列の長さ[2]までバイナリセーフ・大文字小文字区別なし
```

**文字列 (分割)**

```php
$x = explode(',', 'ONE,TWO');       // 区切り文字[0]で文字列[1]を分割
$x = str_split('ABCD', 2);          // 文字列[0]を文字数[1]ごとに分割
$x = wordwrap('hi wor ld!!', 3);    // 文字列[0]を文字数[1]ごとに改行 (デフォルト: 75)
```

**文字列 (変換)**

```php
$x = str_replace('Z', 'C', 'ABZ');  // 文字列[2]の、文字[0]を文字[1]に置換
$x = str_ireplace('z', 'C', 'ABZ'); // 文字列[2]の、文字[0]を文字[1]に置換 (大文字小文字区別なし)
$x = lcfirst('Hello');              // 文字列[0]の先頭を小文字に変換
$x = ucfirst('hello');              // 文字列[0]の先頭を大文字に変換
$x = strtolower('Hello World');     // 文字列[0]を小文字に変換
$x = strtoupper('Hello World');     // 文字列[0]を大文字に変換
$x = ucwords('john smith');         // 文字列[0]の各単語を大文字に変換
$x = strtr('12345', '12', '89');    // 文字列[0]の各文字[1]を各文字[2]に変換
$x = trim(' hello ');               // 文字列[0]の前後のスペースを除去
$x = ltrim(' hello ');              // 文字列[0]の先頭のスペースを除去
$x = rtrim(' hello ');              // 文字列[0]の末尾のスペースを除去
```

**文字列 (探索)**

```php
$x = strpos('HELLO WORLD', 'O');    // 文字列[0]における文字列[1]の最初の出現位置
$x = stripos('HELLO WORLD', 'o');   // 文字列[0]における文字列[1]の最初の出現位置 (大文字小文字区別なし)
$x = strstr('HELLO WORLD', 'O');    // 文字列[0]の最初の文字列[1]の出現位置から末尾までの文字列
$x = stristr('HELLO WORLD', 'o');   // 文字列[0]の最初の文字列[1]の出現位置から末尾までの文字列 (大文字小文字区別なし)
$x = strrpos('HELLO WORLD', 'O');   // 文字列[0]における文字列[1]の最後の出現位置
$x = strripos('HELLO WORLD', 'o');  // 文字列[0]における文字列[1]の最後の出現位置 (大文字小文字区別なし)
$x = strrchr('HELLO WORLD', 'O');   // 文字列[0]の最後の文字列[1]の出現位置から末尾までの文字列
$x = substr('HELLO WORLD', 2, 6);   // 文字列[0]のオフセット[1]から文字数[2]の文字列
$x = str_contains('ABCDE', 'DE');   // 文字列[0]に文字列[1]が含まれるか？
$x = str_starts_with('ABC', 'AB');  // 文字列[0]が文字列[1]で始まるか？
$x = str_ends_with('ABC', 'BC');    // 文字列[0]が文字列[1]で終わるか？
```

**文字列 (HTML)**

```php
$x = htmlspecialchars('<p>ハロー</p>', ENT_QUOTES, 'UTF-8');            // エスケープ
$x = htmlspecialchars_decode('&lt;p&gt;ハロー&lt;/p&gt;', ENT_QUOTES);  // デコード
$x = strip_tags('Hello <?= "WORLD" ?>!');                              // HTMLタグ、PHPタグの除去
```

**文字列 (その他)**

```php
$x = strlen('ABCD');                // 文字列[0]の長さ (半角1バイト, 全角2バイト)
$x = mb_strlen('あいうえお');        // 文字列[0]の長さ (半角1バイト, 全角1バイト)
$x = strrev('ABCD');                // 文字列[0]の逆順にする
$x = str_decrement('ABC');          // 文字列[0]をデクリメント
$x = str_increment('ABC');          // 文字列[0]をインクリメント
$x = str_pad('ABC', 10, '-');       // 文字列[0]を文字数[1]になるよう文字列[2]で埋める
$x = similar_text('ABCC', 'ABZC');  // 文字列[0],[1]での同じ文字の数
$x = str_repeat('AB', 4);           // 文字列[0]の計[1]回繰り返した文字列
$x = str_shuffle('ABCD');           // 文字列[0]の各文字をシャッフル
$x = str_word_count('hi my world'); // 文字列[0]の単語数
$x = substr_count('ABCCE', 'C');    // 文字列[0]の文字列[1]の出現回数
```

**変数 (変換)**

```php
$x = boolval('1');          // boolとしての値を返す
$x = floatval(32);          // floatとしての値を返す
$x = intval('32');          // intとしての値を返す
$x = strval('34');          // stringとしての値を返す
```

**変数 (確認)**

```php
$x = is_array(['ab']);      // 変数が配列か？
$x = is_bool(true);         // 変数がboolか？
$x = is_countable([4, 8]);  // 変数が数えられるか？
$x = is_float(1.2);         // 変数がfloatか？
$x = is_int(34);            // 変数がintか？
$x = is_iterable([3, 6]);   // 変数がイテラブルか？
$x = is_null(null);         // 変数がnullか？
$x = is_numeric('456');     // 変数が数字または数値形式の文字列か？
$x = is_object(new Error());// 変数がオブジェクトか？
$x = is_scalar(123);        // 変数がスカラー型(int, float, string, bool)か？
$x = is_string('ss');       // 変数が文字列か？
$x = isset($x);             // 変数が宣言されており、nullではないか？
$x = empty($y);             // 変数が空か？
$x = gettype('sss');        // 変数の型
```

**配列 (基本)**

```php
$nums = [10, 20, 30, 40];
$arr = array();
$x = null;

$arr = array_keys($nums);               // 配列[0]のキーを配列として返す
$arr = array_values($nums);             // 配列[0]の値を配列として返す
$x = array_key_first($nums);            // 配列[0]の最初のキー
$x = array_key_last($nums);             // 配列[0]の最後のキー
$x = array_key_exists(2, $nums);        // 配列[1]にキー[0]が存在するか？
$x = array_is_list($nums);              // 配列[0]がリストか？
$x = implode('-', $nums);               // 連結
```

**配列 (追加・削除)**

```php
$x = array_pop($nums);                  // 配列[0]の末尾から要素を取り除く
array_push($nums, 40);                  // 配列[0]の末尾に要素[1]を追加
$x = array_shift($nums);                // 配列[0]の先頭から要素を取り除く
array_unshift($nums, 10);               // 配列[0]の先頭に要素[1]を追加
$arr = array_merge($nums, [50, 60]);    // 複数の配列[0~]を結合
array_splice($nums, 4);                 // 配列[0]をオフセット[1]以降の要素を削除
array_splice($nums, 4, 2);              // 配列[0]の位置[1]から[2]個の要素を削除
```

**配列 (検索)**

```php
$x = array_search(30, $nums);                       // 配列[1]における最初の値[0]の出現位置
$x = array_find($nums, fn($v) => $v > 10);          // 配列[0]でCallback[1]を満たす最初の要素の値
$x = array_find_key($nums, fn($v) => $v > 10);      // 配列[0]でCallback[1]を満たす最初の要素のキー
$x = in_array(30, $nums);                           // 配列[1]に値[0]が存在するか？
$x = array_all($nums, fn($v) => $v > 5);            // 配列[0]でCallback[1]を全て満たすか？
$x = array_any($nums, fn($v) => $v > 20);           // 配列[0]でCallback[1]のいずれかを満たすか？
```

**配列 (フィルタリング)**

```php
$arr = array_filter($nums, fn($v) => $v > 10);      // 配列[0]をCallback[1]でフィルタリング
$arr = array_unique([5, 5, 10, 15]);                // 配列[0]から重複した値を削除
$arr = array_column([['id'=>1],['id'=>2]], 'id');   // 連想配列[0]からキー[1]を指定したカラムの値
```
**配列 (編集)**

```php
$arr = array_replace($nums, [11, 22]);              // 配列[0]の先頭から順に配列[1]の値に置換
$arr = array_change_key_case(['ID'=>0]);            // 配列[0]のキーを小文字化
$arr = array_change_key_case(['id'=>0], CASE_UPPER);// 配列[0]のキーを大文字化
$arr = array_flip($nums);                           // 配列[0]のキーと値を反転
```

**配列 (変換)**

```php
$arr = array_slice($nums, 1);                       // 配列[0]をオフセット[1]からに変換した配列を返す
$arr = array_chunk($nums, 2);                       // 配列[0]を要素数[1]で分割した配列を返す
$arr = array_reverse($nums);                        // 配列[0]を逆順にした配列を返す
$arr = array_pad($nums, 6, 99);                     // 配列[0]を長さ[1]として、値[2]で埋める
$arr = array_fill(0, 3, $nums);                     // 配列[2]に開始インデックス[0]を指定し[1]個の配列を返す
$arr = array_fill_keys($nums, [1]);                 // 配列[0]をキーにして値[1]を設定した配列を返す
$arr = array_combine($nums, [1,2,3,4]);             // 配列[0]をキーにして、配列[1]をとした配列を返す
$arr = array_map(fn($item) => $item + 1, $nums);    // 配列[1]にCallback[0]を適用
```

**配列 (計算)**

```php
$x = count($nums);                  // 配列[0]の要素数
$x = array_sum($nums);              // 配列[0]の値の合計
$x = array_product($nums);          // 配列[0]の値の積
$x = array_count_values($nums);     // 配列[0]の異なる値の出現数
```

**配列 (ポインタ)**

```php
$x = key($nums);                // 配列[0]のキーを取り出す
$x = current($nums);            // 配列[0]の内部ポインタが指す要素
$x = next($nums);               // 配列[0]の内部ポインタを進める
$x = prev($nums);               // 配列[0]の内部ポインタを戻す
reset($nums);                   // 配列[0]の内部ポインタを先頭要素にセット
end($nums);                     // 配列[0]の内部ポインタを末尾要素にセット
```

**配列 (ソート)**

```php
ksort($nums);                   // キーの昇順
krsort($nums);                  // キーの降順
asort($nums);                   // 昇順・連想キーと要素の関係維持
arsort($nums);                  // 降順・連想キーと要素の関係維持
sort($nums);                    // 値の昇順
rsort($nums);                   // 値の降順
natsort($nums);                 // 昇順・自然順アルゴリズム
natcasesort($nums);             // 昇順・自然順アルゴリズム (大文字小文字区別なし)
array_multisort($nums);         // 複数または多次元の配列をソート
```

[⬆︎目次へ戻る](#目次)

## キャスト

**型キャスト**

```php
$s = '1234';
$i = intval($s);    // 遅め
$x = (int)$s;       // intvalより速い

echo gettype($i) . PHP_EOL;
echo gettype($x) . PHP_EOL;
```

[⬆︎目次へ戻る](#目次)

## 例外

**捕捉**

```php
try {
    $x = 2 / 0;
} catch (DivisionByZeroError $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
} finally {
    echo 'End' . PHP_EOL;
}
```

**スロー**

```php
throw new Exception('Error!!!');
```

[⬆︎目次へ戻る](#目次)

## 名前空間

**名前空間** - (要約)項目をカプセル化する

```php
namespace App\Models;

class User {
    // ...
}

const PI = 3.14;

function sum(int $a, int $b): int {
    return $a + $b;
}
```

**エイリアス/インポート** - 別の名前空間のものを使う

```php
use App\Models\User;
use App\Models\User as U;
use const App\Models\PI;
use const App\Models\PI as PI2;
use function App\Models\sum;
use function App\Models\sum as s;
```

[⬆︎目次へ戻る](#目次)

## ファイル読み込み

```php
require 'Test.php';
require_once 'Test.php';
include 'Test.php';
include_once 'Test.php';

$t = new Test();
```

[⬆︎目次へ戻る](#目次)

## クラスのオートロード

**オートローディング** - クラス定義毎にスクリプトの先頭で読み込むのは面倒なため、
下記コードで任意の数のオートローダを読み込み、クラスの自動読み込みを行う。

```php
// Test.php のTestクラスを読み込む
spl_autoload_register(function ($class_name) {
    include "{$class_name}.php";
});

$test = new Test();
echo $test::ID;
```

[⬆︎目次へ戻る](#目次)

## フォーム

**最低限のコード**

- [index.php](/src/form/index.php)
- [action.php](/src/form/action.php)

**POSTとGET**

- POST - データをHTTPボディに格納して送信する
- GET - データをクエリストリング (URLの後ろ)に格納して送信する

**スーパーグローバル**

```php
// $GLOBALS - 使用可能な全ての変数への参照
$GLOBALS['secred_id'] = 123;
var_dump($secred_id ?? null);   // 123

// $_SERVER - サーバー情報及び実行時の環境情報
var_dump($_SERVER['argc']);     // コマンドライン引数の数
var_dump($_SERVER['argv']);     // コマンドライン引数の配列
```

[⬆︎目次へ戻る](#目次)

## mysqli (基本)

*MAMPを使用してテスト

**連携 (手続き型)**

```php
// 接続
$host = '127.0.0.1:8889';   // ホスト:ポート
$user = 'root';             // ユーザー名
$psw = 'root';              // パスワード
$db = 'test_db';            // データベース名
$mysqli = mysqli_connect($host, $user, $psw, $db);

// 実行
$result = mysqli_query($mysqli, 'SELECT "Test" AS msg FROM DUAL;');
$row = mysqli_fetch_assoc($result);
echo $row['msg'];   // Test
```

**連携 (オブジェクト指向)**

```php
// 接続
$mysqli = new mysqli($host, $user, $psw, $db);

// 実行
$result = $mysqli->query('SELECT "Test 2" AS msg FROM DUAL;');
$row = $result->fetch_assoc();
echo $row['msg'];
```

**CREATE**

```php
$mysqli->query('DROP TABLE IF EXISTS employees');
$mysqli->query('CREATE TABLE employees(
                    id INT NOT NULL AUTO_INCREMENT,
                    name VARCHAR(64),
                    PRIMARY KEY(id)
                );
');
```

**プリペアドステートメント** - SQLテンプレートを事前にコンパイルし、パラメータを後からバインドして実行する仕組み。一度に複数INSERTするなど、クライアントとサーバーの通信を減らすことも可能。

```php
$stmt = $mysqli->prepare(' INSERT INTO employees(id, name) VALUES(?, ?); ');
$id = null;
$name = 'John Smith';
$stmt->bind_param('is', $id, $name);    // i=int, s=string
$stmt->execute();
```

**ストアドプロシージャ** - 呼び出して実行できるサブルーチン

```php
// IN
$mysqli->query('DROP PROCEDURE IF EXISTS p');
$mysqli->query('CREATE PROCEDURE p(IN name VARCHAR(64))
                BEGIN
                    INSERT INTO employees(id, name)
                    VALUES (NULL, name);
                END;
');
$mysqli->query('CALL p("Paul")');
$mysqli->query('CALL p("Ringo")');
$mysqli->query('CALL p("George")');

// OUT
$mysqli->query('DROP PROCEDURE IF EXISTS p2');
$mysqli->query('CREATE PROCEDURE p2(OUT msg VARCHAR(10))
                BEGIN
                    SELECT "HELLO" INTO msg;
                END;
');
$mysqli->query('SET @msg = ""');
$mysqli->query('CALL p2(@msg)');
$result = $mysqli->query('SELECT @msg AS msg_out');
$row = $result->fetch_assoc();
echo $row['msg_out'];   // HELLO
```

**トランザクション設定**

```php
$mysqli->autocommit(false);
$mysqli->query('SET AUTOCOMMIT = 0');
```

**ロールバック**

```php
$mysqli->autocommit(false);

$mysqli->query('INSERT INTO employees(id, name) VALUES(null, "Dicky")');
$mysqli->rollback();    // ロールバックされるため挿入されない
```

**コミット**

```php
$mysqli->autocommit(false);

$mysqli->query('INSERT INTO employees(id, name) VALUES(null, "Billy")');
$mysqli->commit();      // コミットされる
```

[⬆︎目次へ戻る](#目次)

## mysqli (応用)

**プロパティ**

```php
$x = $mysqli->affected_rows;        // 直前の操作で変更された行数
$x = $mysqli->client_info;          // クライアント情報
$x = $mysqli->client_version;       // クライアントのバージョン
$x = $mysqli->connect_errno;        // 直近の接続コールのエラーコード
$x = $mysqli->connect_error;        // 直近の接続コールのエラー説明
$x = $mysqli->errno;                // 直近の関数コールのエラーコード
$x = $mysqli->error;                // 直近の関数コールのエラー説明
$x = $mysqli->error_list;           // 直近で実行したコマンドのエラー一覧
$x = $mysqli->field_count;          // 直近のクエリのカラム数
$x = $mysqli->host_info;            // 使用している接続のホスト情報
$x = $mysqli->info;                 // 直近に実行されたクエリ情報
$x = $mysqli->insert_id;            // 直近のクエリのAUTO_INCREMENTで生成した値
$x = $mysqli->sqlstate;             // 直前の操作のSQLSTATEエラー
$x = $mysqli->protocol_version;     // MySQLプロトコルのバージョン
$x = $mysqli->thread_id;            // 現在の接続のスレッドID
$x = $mysqli->warning_count;        // 直近のクエリで発生した警告数
```

**接続を閉じる**

```php
$mysqli->close();
```

**セーブポイント設定**

```php
$mysqli->autocommit(false);

$mysqli->begin_transaction();
$mysqli->savepoint('save1');            // セーブポイント設定
$mysqli->release_savepoint('save1');    // セーブポイント削除
$mysqli->commit();
```

**SQL+バインド**

```php
$query = 'SELECT id, name FROM employees WHERE id = ?';
$result = $mysqli->execute_query($query, [5]);

foreach ($result as $row) {
    echo $row['name'] . PHP_EOL;
}
```

**マルチクエリ**

```php
$query  = 'SELECT CURRENT_USER();';
$query .= 'SELECT "Test 1" AS msg FROM DUAL;';
$query .= 'SELECT "Test 2" AS msg FROM DUAL;';
$mysqli->multi_query($query);

do {
    // 直近のクエリから結果を転送
    if ($result = $mysqli->store_result()) {
        // 行を取得
        while ($row = $result->fetch_row()) {
            printf("%s\n", $row[0]);
        }
    }

    // マルチクエリの結果が残っている場合実行
    if ($mysqli->more_results()) {
        print("--------------\n");
    }
} while ($mysqli->next_result());
```

**データベース選択**

```php
$result = $mysqli->query('SELECT DATABASE()');
$row = $result->fetch_row();
echo $row[0] . PHP_EOL;     // test_db

// デフォルトDBを選択
$mysqli->select_db('sample_db');

$result = $mysqli->query('SELECT DATABASE()');
$row = $result->fetch_row();
echo $row[0] . PHP_EOL;     // sample_db
```

[⬆︎目次へ戻る](#目次)

## PDO

**接続**

```php
$dsn = 'mysql:host=127.0.0.1:8889;dbname=test_db';
$user = 'root';
$psw = 'root';

try {
    $dbh = new PDO($dsn, $user, $psw);
    $sth = $dbh->query('SELECT "Test" FROM DUAL;');
    echo '接続しました。' . PHP_EOL;
} catch (PDOException $e) {
    die('接続できません。', $e->getMessage());
} finally {
    $sth = null;
    $dbh = null;
}
```

**ロールバック**

```php
$dbh->beginTransaction();
$dbh->exec('INSERT INTO employees (id, name) VALUES (null, "Arbert")');
$dbh->rollBack();
```

**コミット**

```php
$dbh->beginTransaction();
$dbh->exec('INSERT INTO employees (id, name) VALUES (null, "Bertholdt")');
$dbh->commit();
```

**プリペアドステートメント (名前付きプレースホルダ)**

```php
$stmt = $dbh->prepare('INSERT INTO employees (id, name) VALUES (null, :name)');
$stmt->bindParam(':name', $name);

// 繰り返し挿入処理を行う
$name = 'Jared';
$stmt->execute();
$name = 'Sato';
$stmt->execute();
```

**プリペアドステートメント (プレースホルダ: ?)**

```php
$stmt = $dbh->prepare('INSERT INTO employees (id, name) VALUES (null, ?)');
$stmt->bindParam(1, $name);

// 繰り返し挿入処理を行う
$name = 'Kato';
$stmt->execute();
$name = 'Tanaka';
$stmt->execute();
```

**SQLの実行パターン**

```php
// exec - 結果を返さないSQL
$dbh->exec('INSERT INTO employees (id, name) VALUES (null, "Lee")');

// query - 戻り値としてPDOStatementが必要な場合使う
$stmt = $dbh->query('SELECT * FROM employees');
$stmt->execute();
foreach ($stmt as $row) {
    print_r($row);
}
```

**SELECTパターン**

```php
$stmt = $dbh->query('SELECT * FROM employees');

// PDOStatement::fetch
while ($emp = $stmt->fetch()) {
    echo $emp['id'] . ' ' . $emp['name'] . PHP_EOL;
}

// PDOStatement::fetchAll
$emps = $stmt->fetchAll();
for ($i=0; $i<count($emps); $i++) {
    echo $emps[$i]['id'] . ' ' . $emps[$i]['name'] . PHP_EOL;
}
```

[⬆︎目次へ戻る](#目次)
