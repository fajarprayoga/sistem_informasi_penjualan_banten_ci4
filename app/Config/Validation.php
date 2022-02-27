<?php namespace Config;

class Validation
{
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $upload_token= [
		'order_token'         => 'required|uploaded[order_token]|mime_in[order_token,image/jpg,image/jpeg,image/gif,image/png]|max_size[order_token,1000]',
	];

	public $order_status = [
        'order_status'     => "required"
	];
	
	public $category_create = [
        'category_name'     => "required|is_unique[categories.category_name,category_id,{id}]",
        'category_status'     => 'required'
	];

	public $category_update = [
        'category_name'     => "required",
        'category_status'     => 'required'
	];
	
	
	// public $category_create_errors = [
    //     'category_name' => [
    //         'required'    => 'Nama category wajib diisi.',
    //     ],
	// 	'category_name' => [
    //         'is_unique'    => 'Nama category sudah tersedia.',
    //     ],
    //     'category_status'    => [
    //         'required' => 'Status category wajib diisi.'
    //     ]
	// ];
	
	public $product = [
		'category_id'           => 'required',
		'product_name'          => 'required',
		'product_price'         => 'required',
		'product_sku'           => 'required',
		'product_status'        => 'required',
		// 'product_image'         => 'uploaded[product_image[]]|mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,1000]',
		'product_description' 	=> 'required'
	];

	public $product_update = [
		'category_id'           => 'required',
		'product_name'          => 'required',
		'product_price'         => 'required',
		'product_sku'           => 'required',
		'product_status'        => 'required',
		// 'product_image'         => 'mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,1000]',
		'product_description' 	=> 'required'
	];


	public $product_errors = [
		'category_id' 	=> [
			'required' 	=> 'Nama category wajib diisi.',
		],
		'product_name'	=> [
			'required' 	=> 'Nama product wajib diisi.'
		],
		'product_price' => [
			'required' 	=> 'Harga product wajib diisi.'
		],
		'product_sku'  	=> [
			'required' 	=> 'Kode product wajib diisi.'
		],
		'product_status'=> [
			'required' 	=> 'Status product wajib diisi.'
		],
		'product_image'=> [
			'mime_in' 	=> 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
			'max_size'	=> 'Gambar product maksimal 1mb',
			'uploaded'	=> 'Gambar product wajib diisi'
		],
		'product_description'   => [
			'required' 			=> 'Description product wajib diisi.'
		]
	];

	public $transaction = [
		'trx_file'         => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
	];

	public $transaction_errors = [
		'trx_file'=> [
			'ext_in' 	=> 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'	=> 'File Excel product maksimal 1mb',
			'uploaded'	=> 'File Excel product wajib diisi'
		]
	];

	public $authlogin = [
		'email'         => 'required|valid_email',
		'password' 		=> 'required'
	];

	public $authlogin_errors = [
		'email'=> [
			'required' 	=> 'Email wajib diisi.',
			'valid_email'	=> 'Email tidak valid'
		],
		'password'=> [
			'required' 	=> 'Password wajib diisi.'
		]
	];

	public $authregister = [
		'email'         	=> 'required|valid_email|is_unique[users.email]',
		'username' 			=> 'required|alpha_numeric|is_unique[users.username]|min_length[3]|max_length[35]',
		'name' 				=> 'required|alpha_numeric_space|min_length[3]|max_length[35]',
		'phone' 			=> 'required|numeric|min_length[11]',
		'password' 			=> 'required|string|min_length[8]|max_length[35]',
		'confirm_password' 	=> 'required|string|matches[password]|min_length[8]|max_length[35]',
	];

	public $userUpdate = [
		'email'         	=> 'required|valid_email',
		'username' 			=> 'required|alpha_numeric|min_length[3]|max_length[35]',
		'name' 				=> 'required|alpha_numeric_space|min_length[3]|max_length[35]',
		'phone' 			=> 'required|numeric|min_length[11]',
		'status'			=> 'required',
		'level'				=> 'required'
	];

	public $password = [
		'password' 			=> 'string|min_length[8]|max_length[35]',
	];

	public $profile_update = [
		'email'         	=> 'required|valid_email',
		'username' 			=> 'required|alpha_numeric|min_length[3]|max_length[35]',
		'name' 				=> 'required|alpha_numeric_space|min_length[3]|max_length[35]',
		'phone' 			=> 'required|numeric|min_length[11]',
	];
	public $password_update = [
		'password' 			=> 'string|min_length[8]|max_length[35]',
		'confirm_password' 	=> 'string|matches[password]|min_length[8]|max_length[35]',
	];

	public $authregister_errors = [
		'email'=> [
			'required' 		=> 'Email wajib diisi',
			'valid_email'	=> 'Email tidak valid',
			'is_unique'		=> 'Email sudah terdaftar'
		],
		'username'=> [
			'required' 		=> 'Username wajib diisi',
			'alpha_numeric'	=> 'Username hanya boleh berisi huruf dan angka',
			'is_unique'		=> 'Username sudah terdaftar',
			'min_length'	=> 'Username minimal 3 karakter',
			'max_length'	=> 'Username maksimal 35 karakter'
		],
		'name'=> [
			'required' 				=> 'Name wajib diisi',
			'alpha_numeric_spaces'	=> 'Name hanya boleh berisi huruf, angka dan spasi',
			'min_length'			=> 'Name minimal 3 karakter',
			'max_length'			=> 'Name maksimal 35 karakter'
		],
		'password'=> [
			'required' 		=> 'Password wajib diisi',
			'string'		=> 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'min_length'	=> 'Password minimal 8 karakter',
			'max_length'	=> 'Password maksimal 35 karakter'
		],
		'confirm_password'=> [
			'required' 		=> 'Konfirmasi password wajib diisi',
			'string'		=> 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'matches'		=> 'Konfirmasi password tidak sama dengan password',
			'min_length'	=> 'Konfirmasi password minimal 8 karakter',
			'max_length'	=> 'Konfirmasi password maksimal 35 karakter'
		]
	];

	public $checkout = [
		'order_description'         	=> 'required|min_length[3]',
		'order_destination' 			=> 'required|min_length[3]',
	];
}
