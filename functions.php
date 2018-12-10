<?php
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require_once $name;

    $result = ob_get_clean();

return $result;
}

function cost_format(int $cost) {
	$num = ceil($cost);
  
	if ($cost >= 1000) {
		$cost = number_format ($num, 0, ' ', ' ');
  	}
  	else {
    	$cost = $num;
  	}
  
  	$cost .= ' ₽';
    
  	return $cost;
}

function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}

function edit_class_value_alert($errors, $form, $field = '') {
	$res = [];
	$res['class_name'] = isset($errors[$field]) ? " form__item--invalid" : "";
	$res['value'] = isset($form[$field]) ? $form[$field] : "";
	$res['alert'] = isset($errors[$field]) ? $errors[$field] : "";
  
	return $res;
}