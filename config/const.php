<?php
//商品個数のselect用
foreach (range(1, 10) as $number) {
    $quantity[$number] = $number;
}

return [

	/*
	|--------------------------------------------------------------------------
	| site_name
	|--------------------------------------------------------------------------
	|
	| ??????
	|
	*/

	'site_name' => 'テストECサイト',

	/*
	|--------------------------------------------------------------------------
	| 配列関連
	|--------------------------------------------------------------------------
	|
	|
	// usersで使う定数
    'Users' => [
        'GENDER_NONE' => 0,
        'GENDER_MAN' => 1,
        'GENDER_WOMAN' => 2,
        'GENDER_LIST' => [
            'gender_none' => 0,
            'gender_man' => 1,
            'gender_woman' => 2,
        ],
    ],
	|
	*/
	//商品個数のselect用
	'quantity' => $quantity,

	//-------------------------------------
	'payway' => [
		'collect_on_delivery' => '代引き',
		'credit_card' => 'クレジットカード',
	],
	'PAYWAY_DELIVERY' => 'collect_on_delivery',
	'PAYWAY_CARD' => 'credit_card',

	//-------------------------------------
	'status' => [
		1 => '公開',
		0 => '非公開',
	],
	'STATUS_ON' => 1,
	'STATUS_OFF' => 0,

	//-------------------------------------
	'role' => [
		1 => '管理者',
		2 => 'スタッフ',
	],
	'ROLE_ADMIN' => 1,
	'ROLE_STAFF' => 2,
	
	//-------------------------------------
	'action' => [
		1 => '登録',
		2 => '更新',
	],

	'admin_side_nav' => [
		'site' => [
			'ja' => 'サイト',
			'role' => '1',
			'link' => [
				'top' => '/admin/',
				//'追加'=>'/admin/staff/edit/'
			]
		],
		'staff' => [
			'ja' => 'スタッフ管理',
			'role' => '1',
			'link' => [
				'一覧' => '/admin/staff/',
				'追加' => '/admin/staff/edit/'
			]
		],
		'news' => [
			'ja' => '記事',
			'link' => [
				'一覧' => '/admin/news/',
				'編集' => '/admin/news/edit/'
			]
		],
		'category' => [
			'ja' => 'カテゴリ',
			'link' => [
				'一覧' => '/admin/category/',
				'編集' => '/admin/category/edit/',
				//'並び替え'=>'/admin/category/sort/',
			]
		],
	],
];