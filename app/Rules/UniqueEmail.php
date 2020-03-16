<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Staff;

class UniqueEmail implements Rule
{
	protected $datas = [];
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct($datas)
	{
		//
		$this->datas = $datas;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$sql = Staff::where('email', $this->datas['email']);
		if (!empty($this->datas['id'])) {
			$sql->where('id','!=',$this->datas['id']);
		}
		$tmp = $sql->first();

		if (empty($tmp['email'])) {
			return true;
		}

	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'おなじemailがあります。';
	}
}
