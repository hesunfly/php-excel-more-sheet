<?php

include_once './vendor/autoload.php';

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
