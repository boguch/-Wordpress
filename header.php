<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit; // Выход, если файл вызывается напрямую
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>> <!-- Устанавливаем атрибуты языка для HTML -->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Устанавливаем кодировку символов -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Адаптивная вёрстка для мобильных устройств -->
    <link rel="profile" href="http://gmpg.org/xfn/11"> <!-- Подключаем профиль XFN -->
    <?php wp_head(); // Вставка заголовка для подключения стилей и скриптов ?>
</head>
<body <?php body_class(); ?>> <!-- Устанавливаем классы для тега <body> -->

<header class="site-header"> <!-- Заголовок сайта -->
    <div class="container"> <!-- Контейнер для содержимого заголовка -->

        <nav class="site-navigation"> <!-- Навигационное меню сайта -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary', // Используем основное меню
                'container' => false, // Не оборачиваем меню в дополнительный контейнер
                'menu_class' => 'nav-menu', // Класс для <ul> списка меню
            ));
            ?>
        </nav> <!-- Закрытие блока навигации -->
    </div> <!-- Закрытие контейнера заголовка -->
</header> <!-- Закрытие заголовка сайта -->