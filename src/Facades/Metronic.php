<?php namespace Listo4ek\Metronic\Facades;

use Illuminate\Support\Facades\Facade;

class Metronic extends Facade
{


	/**
	 *
	 *
	 * @var string
	 */
	const BTN_TYPE_SUBMIT = 'submit';

	/**
	 *
	 *
	 * @var string
	 */
	const BTN_TYPE_BUTTON = 'button';

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'metronic';
    }
}
