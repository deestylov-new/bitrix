//** Работа с куками (Добавляем просмотренный товар) */
 function AddViewedProducts($id, $count = 6) {
    $products = $_COOKIE['product_viewe']; // Загружаем кук

    if(empty($products)) { // Если пустой кук
        setcookie('product_viewe', $id, time()+24*60*60, '/'); 
    } else { // Если нет
        if($products == $id) { // Если айди равен куку
            // Ничего не делаем
        } else { // Если не равен
            $viewed_array = explode( ',', $products); // Разбиваем строку на массив
            if( in_array($id, $viewed_array)){  // 1. Если айди есть в массиве, то нужно перезаписать строку с новым айди
                setcookie('product_viewe', '', -1); //Сначала удаляем полностью кук
                $viewe_string = (string) $id; // Заводим строку для записи в куки
                $key_el = array_search($id, $viewed_array); // Найдем ключ нужного элемента
                unset($viewed_array[$key_el]); // Удалим элемент с таким-же айди
                foreach ($viewed_array as $v) { // Формируем строку
                    $viewe_string .= ','. $v;
                }
                setcookie('product_viewe', $viewe_string, time()+24*60*60, '/'); // Запиписываем кук нужной строкой
            } else { // 2. Если нет в массиве, то дополняем кук
                setcookie('product_viewe', '', -1); //Сначала удаляем полностью кук
                $viewe_string = (string) $id; // Заводим строку для записи в куки
                for ($i=0; $i < count($viewed_array); $i++) { // Собираем строку через цикл
                    if(($i+1) == $count) {
                        break;
                    } else {
                        $viewe_string .= ','. $viewed_array[$i];
                    }
                   
                }
                setcookie('product_viewe', $viewe_string, time()+24*60*60, '/'); // Запиписываем кук нужной строкой
            }
        }
    }
}

//** Вывод просмотренных товаров */
function PrintViewedProducts() {
    $products = $_COOKIE['product_viewe']; // Загружаем кук
    $viewed_array = explode( ',', $products); // Разбиваем строку на массив
    return $viewed_array;
}
