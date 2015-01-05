<?php 

	/**
	 * bs3 form macros
	 * @params $options [array]
	 * @type [type of the field text, password, checkbox, dropdown, textarea]
	 * @labeWrapper [class to wrap label, default: col-sm-2]
	 * @valueWrapper [class to wrap value, default: col-sm-10]
	 * @name [name of the value field]
	 * @label [label to be dispalyed]
	 * @placeholder [placeholder to be displayed in field]
	 * @validations [array] [parameters of form validator]
	 * @dropdownParams [array] [parameters of dropdown]
	 * @htmlOptions [array] [extra param to form fields]
	 */
	Form::macro('field', function($options){
		$markup = '';
		$type = 'text';
		$labelWrapper = 'col-sm-2';
		$valueWrapper = 'col-sm-10';
		$required = "";
		$validatons = "";
		$list = [null => 'Select'];
		$selected = null;


		if(!empty($options['labelWrapper'])){
			$labelWrapper = $options['labelWrapper'];
		}

		if(!empty($options['valueWrapper'])){
			$valueWrapper = $options['valueWrapper'];
		}


		if(!empty($options['type'])){
			$type = $options['type'];
		}

		if(empty($options['name'])){
			return;
		}

		$name = $options['name'];

		
		if(!empty($options['required'])){
			$required = $options['required'];
		}

		$label = "";
		if(!empty($options['label'])){
			if(!empty($required) && $required != "" ){
				$label =  $options['label']."<span class = 'asterisk'>*</span>";
			}
			else{
				$label = $options['label'];
			}
			
		}

		$value = Input::old($name);
		if( !empty( $options['value'] ) ){
			$value = Input::old($name, $options["value"]);
		}

		$placeholder = "";
		if (!empty($options["placeholder"])){
			$placeholder = $options["placeholder"];
		}

		$class = "";
		if (!empty($options["class"])){
			$class = " ".$options['class'];
		}

		$parameters = array(
			"class" => 'form-control' . $class,
			"placeholder" => $placeholder
			);

		$error = "";
		if( !empty($options['form']) ){
			$error = $options['form']->getError('name');
		}

		if ($type !== "hidden"){
			$markup .= "<div class='form-group";
			$markup .= ($error ? " has-error" : "");
			$markup .= "'>";
		}

		/**
		 * formvalidator.net
		 * form validaor validation
		 */
		if(!empty($options['validations']) && is_array($options['validations']) ){
			$validators = $options['validations'];
			foreach($validators as $k => $v){
				$parameters += array($k => $v);			
			}
		}

		/**
		 * dropdown
		 */
		if(isset($options['dropdownParams'])){
			if(!empty($options['dropdownParams']) && is_array($options['dropdownParams']) ){
			$dropdownParams = $options['dropdownParams'];
			if(isset($dropdownParams['list'])){
				$list = $dropdownParams['list'];
			}
			if(isset($dropdownParams['selected'])){
				$selected = $dropdownParams['selected'];
			}
			
		}
		}

		/**
		 * htmlOptions
		 */
		if(isset($options['htmlOptions'])){
			if(!empty($options['htmlOptions']) && is_array($options['htmlOptions']) ){
				$htmlOptions = $options['htmlOptions'];
				foreach($htmlOptions as $k => $v){
				$parameters += array($k => $v);			
			  }
			}
		}
		

		switch ($type) {
			case "text":
				{
					if(!empty($required) && $required != "" ){
						$markup .= HTML::decode(Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						)));
					}
					else{
						$markup .= Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						));
					}
					
					$markup .= '<div class="'.$valueWrapper.'">';
					$markup .= Form::text($name, $value, $parameters);
					$markup .= '</div>';
					break;
				}

			case "dropdown":
				{
					if(!empty($required) && $required != "" ){
						$markup .= HTML::decode(Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						)));
					}
					else{
						$markup .= Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						));
					}
					$markup .= '<div class="'.$valueWrapper.'">';
					$markup .= Form::select($name, $list, $selected, $parameters);
					$markup .= '</div>';
					break;

				}

			case "password":
				{
					if(!empty($required) && $required != "" ){
						$markup .= HTML::decode(Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						)));
					}
					else{
						$markup .= Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						));
					}
					$markup .= '<div class="'.$valueWrapper.'">';
					$markup .= Form::password($name, $parameters);
					$markup .= '</div>';
					break;
				}

			case "checkbox";
				{
					$markup .= "<div class = 'checkbox'>";
					$markup .= "<label>";
					$markup .= Form::checkbox($name, 1, !!$value);
					$markup .= " " . $label;
					$markup .= "</label>";
					$markup .= "</div>";
					break;
				}

			case "textarea";
				{
					if(!empty($required) && $required != "" ){
						$markup .= HTML::decode(Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						)));
					}
					else{
						$markup .= Form::label($name, $label, array(
							'class' => "$labelWrapper control-label"
						));
					}
					$markup .= '<div class="'.$valueWrapper.'">';
					$markup .= Form::textarea($name, $value, $parameters);
					$markup .= '</div>';
					break;
				}

			case "hidden":
				{
					$markup .= Form::hidden($name, $value);
					break;
				}

		}

		if($error){
			$markup .= "<span class='help-block'>";
			$markup .= $error;
			$markup .= "</span>";
		}
		if ($type !== "hidden"){
			$markup .= "</div>";
		}
		return $markup;
	});
 ?>