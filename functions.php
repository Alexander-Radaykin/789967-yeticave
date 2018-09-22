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
