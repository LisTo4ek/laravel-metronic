<?php namespace Listo4ek\Metronic;

//use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
//use Illuminate\Contracts\Config\Repository as Config;
//use Illuminate\Session\SessionManager as Session;
//use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Lang;

class Metronic
{



    public function __construct()
    {
    }

	/**
	 * @param string $label
	 * @param $type
	 * @param $class
	 * @param string $icon
	 * @return \Illuminate\View\View
	 */
	public function btn($label, $type, $class, $icon='')
	{
//		return
		return view('metronic::elements.btn', ['class' => $class, 'type' => $type, 'label' => $label, 'icon' => $icon]);
	}


	public function icon($class) {
		return view('metronic::elements.icon', ['class' => $class]);
	}


	public function sidebar() {
//		View::composer('recent', function ($view)
//		{
//			$articles = DB::table('store')->get();
//			$view->with('articles', $articles);
//		});

	}

	public function attributes($attributes) {
		$attr = '';

		foreach ($attributes as $attribute => $value) {
			if (is_int($attribute)) {
				$attribute = $value;
			}

			$attr .= ' ' . $attribute . '="' . $value . '"';
		}

		return $attr;
	}

	public function tag($name, array $attributes = array(), $content = null) {
		return '<' . $name . $this->attributes($attributes) . (($content === null) ? '>' : '>' . $content . '</' . $name . '>');
	}


	public function butttonLoaderForm($selector, $content, $win='#win') {
		return $this->tag('button', array('type' => 'button', 'class' => 'btn btn-primary loader-form', 'selector' => $selector, 'win' => $win), $content);
	}

	public function select($items, $attributes, $selected=array()) {
		$options = '';

		foreach ($items as $value => $caption) {
			$optionAttributes = array('value' => $value);
			if (in_array($value, $selected)) {
				$optionAttributes['selected'] = 'selected';
			}
			$options .= $this->tag('option', $optionAttributes, $caption);
		}

		return $this->tag('select', $attributes, $options);
	}


	public function modalButttonClose() {
		return $this->tag('button', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'), 'Закрыть');
	}

	public function modalFooter($content) {
		return $this->tag('div', array('class' => 'modal-footer'), $content);
	}


	public function modalHeader($title) {
		$closeHtml = $this->tag('button', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal', 'aria-hidden' => 'true'), '&times;');
		$titleHtml = $this->tag('h4', array('class' => 'modal-title'), $title);
		return $this->tag('div', array('class' => 'modal-header'), $closeHtml . $titleHtml);
	}


	public function modalBody($content) {
		return $this->tag('div', array('class' => 'modal-body'), $content);
	}





	/**
	 *
	 */
	public function editFormElementText($name, $placeholder, $value, $label) {
		$attributes = array(
			'name' => $name,
			'type' => 'text',
			'class' => 'form-control',
			'id' => $name,
			'value' => $value,
			'placeholder' => $placeholder,
		);
		$element = $this->tag('input', $attributes);
		return $this->editFormElement($name, $label, $element);
	}


	/**
	 *
	 */
	public function editFormElementTextarea($name, $placeholder, $value, $label) {
		$attributes = array(
			'name' => $name,
			'class' => 'form-control',
			'id' => $name,
			'value' => $value,
			'placeholder' => $placeholder,
			'style' => 'min-height: 300px',
		);
		$element = $this->tag('textarea', $attributes, $value);
		return $this->editFormElement($name, $label, $element);
	}


//	/**
//	 *
//	 */
//	public function editFormElementWysiwyg($name, $placeholder, $value, $label) {
//		$attributes = array(
//			'name' => $name,
//			'class' => 'form-control',
//			'id' => $name,
//			'value' => $value,
//			'placeholder' => $placeholder,
//		);
//		$element = $this->tag('textarea', $attributes, $value);
//		return $this->element($name, $label, $element);
//	}




	/**
	 *
	 */
	public function editFormElementСheckbox($name, $placeholder, $value, $label) {
		$attributes = array(
			'name' => $name,
			'type' => 'checkbox',
			'class' => 'form-control',
			'id' => $name,
			'value' => '1',
			'placeholder' => $placeholder,
		);
		if (!empty($value)) {
			$attributes['checked'] = 'checked';
		}
		$element = $this->tag('input', $attributes);
		$hiddenElement = $this->tag('input', array('name' => $name, 'type' => 'hidden', 'value' => '0',));
		$html = $this->editFormElement($name, $label,  $hiddenElement . $element);
		return $html;
	}


	/**
	 *
	 */
	public function editFormElementSelect($name, $values, $label, $selected=array(), $attributes=array()) {
		$attributes = array_merge($attributes, array(
			'name' => $name,
			'class' => 'form-control input-sm',
			'id' => 'search-' . $name,
		));

		$element = $this->select($values, $attributes, $selected);
		return $this->editFormElement($name, $label, $element);
	}


	public function editFormElement($name, $label, $element) {
		$labelHtml = $this->tag('label', array('class' => 'control-label', 'for' => $name), $label);
		$helpHtml = $this->tag('span', array('class' => 'help-block help-block-error alert-danger'));
		return $this->tag('div', array('class' => 'form-group ' . $name), $labelHtml . $element . $helpHtml);
	}

	public function editForm($id, $action, $content) {
		return $this->tag('form', array(
			'role' => 'form',
			'id' => $id,
			'method' => 'post',
			'enctype' => 'multipart/form-data',
			'action' => $action,
			'onsubmit' => 'releaseOnSubmit(this.id); return false;',

		), $content);
	}



	/**
	 *
	 */
	public function searchFormElementText($name, $placeholder, $value, $label) {
		$attributes = array(
			'name' => $name,
			'type' => 'text',
			'class' => 'form-control input-sm',
			'id' => 'search-' . $name,
			'value' => $value,
			'placeholder' => $placeholder,
		);
		$element = $this->tag('input', $attributes);
		return $this->searchFormElement($name, $label, $element);
	}


	public function searchFormElementSelect($name, $values, $label, $selected=array(), $attributes=array()) {
		$attributes = array_merge($attributes, array(
			'name' => $name,
			'class' => 'form-control input-sm',
			'id' => 'search-' . $name,
		));

		$element = $this->select($values, $attributes, $selected);
		return $this->searchFormElement($name, $label, $element);
	}


	public function searchFormElement($name, $label, $element) {
		$labelHtml = $this->tag('label', array('for' => $name), $label);
		return $this->tag('div', array('class' => 'form-group form-group-sm col-xs-4'), $labelHtml . $element);
	}


//	public function searchFormform($id, $action, $content) {
//		return $this->tag('form', array('class' => 'row', 'role' => 'form', 'id' => $id, 'method' => 'get', 'action' => $action), $content);
//	}
	public function searchForm($id, $action, $content) {
		return $this->tag('form', array(
			'role' => 'form',
			'id' => $id,
			'method' => 'post',
			'enctype' => 'multipart/form-data',
			'action' => $action,
			'onsubmit' => 'releaseOnSubmit(this.id); return false;',

		), $content);
	}

	
}
