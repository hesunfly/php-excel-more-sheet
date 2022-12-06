# php-excel-more-sheet

php excel 导入导出, 由于需要在 swoole 中使用，所以重新构建了该扩展包，主要去除了影响 swoole 运行的 exit() 和 die()，原地址：https://github.com/jianyan74/php-excel,
该版本支持多sheet导出，可以看下 demo 代码。

## 安装

```
composer require hesunfly/php-excel-more-sheet
```

引入

```
use Hesunfly\ExcelMoreSheet;
```

## Demo

```php
$arr = [
    [
        'title' => '第一个sheet',
        'header' => [
            ['姓名', 'a'],
            ['年龄', 'b'],
        ],
        'list' => [
            [
                'a' => '张三',
                'b' => '18',
            ],
            [
                'a' => '李四',
                'b' => '22',
            ],
        ],
    ],
    [
        'title' => '第二个sheet',
        'header' => [
            ['姓名1', 'a'],
            ['年龄2', 'b'],
        ],
        'list' => [
            [
                'a' => '王五',
                'b' => '18',
            ],
            [
                'a' => '赵六',
                'b' => '22',
            ],
        ],
    ]
];

$file_name = '导出数据-' . time() . '.xlsx';
$base_path = __DIR__ . '/public/';
$file_dir = 'file/export/' . date('Y');
if (!file_exists($base_path . $file_dir)) {
    mkdir($base_path . $file_dir, 0777, true);
}
$access_path = $file_dir . '/' . $file_name;

\Hesunfly\ExcelMoreSheet\ExcelMoreSheet::exportData($arr, $file_name, 'xlsx', $base_path . $access_path);
```

```
// [名称, 字段名, 类型, 类型规则]
$header = [
    ['ID', 'id', 'text'],
    ['手机号码', 'mobile'], // 规则不填默认text
    ['openid', 'fans.openid', 'text'],
    ['昵称', 'fans.nickname', 'text'],
    ['关注/扫描', 'type', 'selectd', [1 => '关注', 2 => '扫描']],
    ['性别', 'sex', 'function', function($model){
        return $model['sex'] == 1 ? '男' : '女';
    }],
    ['创建时间', 'created_at', 'date', 'Y-m-d'],
    ['图片', 'image', 'text'],// 本地图片 ./images/765456898612.jpg
];
```

```

### 导入

```
/**
 * 导入
 *
 * @param $filePath     excel的服务器存放地址 可以取临时地址
 * @param int $startRow 开始和行数 默认1
 * @param bool $hasImg  导出的时候是否有图片
 * @param string $suffix    格式
 * @param string $imageFilePath     作为临时使用的 图片存放的地址
 * @return array|bool|mixed
 */
$data = Excel::import($filePath, $startRow = 1,$hasImg = false,$suffix = 'Xlsx',$imageFilePath = null);
```

