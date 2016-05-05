<?php

namespace HXPHP\System\Helpers\Menu;

class CheckActive
{
	private $realLink = null;
	private $current_URL = null;

	public function __construct(RealLink $realLink, $current_URL)
	{
		$this->realLink = $realLink;
		$this->current_URL = $current_URL;
	}

	/**
	 * Verifica se o link está ativo
	 * @param  string $URL Link do menuy
	 * @return bool        Status do link
	 */
	public function link($URL)
	{
		$position = strpos($this->current_URL, $URL);
		return $this->current_URL === $URL || ($position !== false && $position > 0) ? true : false;
	}

	/**
	 * Verifica se algum link do dropdown está ativo
	 * @param  array $values Links do dropdown
	 * @return bool        	 Status do dropdown
	 */
	public function dropdown(array $values)
	{
		$values = array_values($values);
		$status = false;

		foreach ($values as $dropdown_link) {
			$real_link = $this->realLink->get($dropdown_link);

			if ($this->checkActive($real_link) === true) {
				$status = true;
				break;
			}
		}
		return $status;
	}
}