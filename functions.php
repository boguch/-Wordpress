<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit; // Выход, если файл вызывается напрямую
}

// Подключаем стили и скрипты
function my_custom_theme_enqueue_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri()); // Подключаем основной стиль темы
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true); // Подключаем пользовательский скрипт с зависимостью от jQuery
}
add_action('wp_enqueue_scripts', 'my_custom_theme_enqueue_scripts'); // Регистрация функции для подключения скриптов и стилей

// Регистрация меню
function my_custom_theme_register_menus() {
    register_nav_menus(array(
        'primary' => __('Основное меню', 'my-custom-theme'), // Основное меню
        'footer' => __('Меню в подвале', 'my-custom-theme'), // Меню в подвале
    ));
}
add_action('init', 'my_custom_theme_register_menus'); // Регистрация меню при инициализации темы

// Добавление поддержки миниатюр
function my_custom_theme_setup() {
    add_theme_support('post-thumbnails'); // Включение поддержки миниатюр для постов
    add_theme_support('title-tag'); // Включение поддержки динамического заголовка
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption')); // Включение поддержки HTML5 для указанных элементов
}
add_action('after_setup_theme', 'my_custom_theme_setup'); // Вызов функции после настройки темы

// Регистрация сайдбара
function my_custom_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Боковая панель', 'my-custom-theme'), // Название сайдбара
        'id'            => 'sidebar-1', // Уникальный идентификатор
        'before_widget' => '<div class="widget">', // HTML перед виджетом
        'after_widget'  => '</div>', // HTML после виджета
        'before_title'  => '<h2 class="widget-title">', // HTML перед заголовком виджета
        'after_title'   => '</h2>', // HTML после заголовка виджета
    ));
}
add_action('widgets_init', 'my_custom_theme_widgets_init'); // Регистрация сайдбара при инициализации виджетов

// Функция для отслеживания количества просмотров поста
function my_custom_theme_set_post_views($postID) {
    $count_key = 'post_views_count'; // Ключ для хранения количества просмотров
    $count = get_post_meta($postID, $count_key, true); // Получаем текущее количество просмотров
    if ($count == '') {
        $count = 0; // Если просмотры еще не были установлены, инициализируем их в 0
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0'); // Добавляем метаданные с отсутствующим значением
    } else {
        $count++; // Увеличиваем счетчик
        update_post_meta($postID, $count_key, $count); // Обновляем метаданные с новым количеством просмотров
    }
}

// Подключаем функцию для отслеживания просмотров
function my_custom_theme_track_post_views($post_id) {
    if (!is_single()) return; // Выполняем только на одиночных постах
    if (empty($post_id)) {
        global $post; // Глобальная переменная поста
        if ($post) {
            $post_id = $post->ID; // Получаем ID поста
        }
    }
    my_custom_theme_set_post_views($post_id); // Устанавливаем количество просмотров
}
add_action('wp_head', 'my_custom_theme_track_post_views'); // Запускаем функцию отслеживания при загрузке заголовка страницы

// Регистрация кастомного типа записи "Отзывы"
function my_custom_post_type() {
    $labels = array(
        'name'                  => __('Отзывы', 'my-custom-theme'), // Название для общего числа
        'singular_name'         => __('Отзыв', 'my-custom-theme'), // Название для одного элемента
        'menu_name'             => __('Отзывы', 'my-custom-theme'), // Название в меню админ-панели
        'name_admin_bar'        => __('Отзыв', 'my-custom-theme'), // Название на панели администратора
        'add_new'               => __('Добавить новый', 'my-custom-theme'), // Добавить новый элемент
        'add_new_item'          => __('Добавить новый отзыв', 'my-custom-theme'), // Добавить новый элемент
        'new_item'              => __('Новый отзыв', 'my-custom-theme'), // Новый элемент
        'edit_item'             => __('Редактировать отзыв', 'my-custom-theme'), // Редактировать элемент
        'view_item'             => __('Посмотреть отзыв', 'my-custom-theme'), // Просмотреть элемент
        'all_items'             => __('Все отзывы', 'my-custom-theme'), // Все элементы
        'search_items'          => __('Искать отзывы', 'my-custom-theme'), // Поиск элементов
        'not_found'             => __('Не найдено', 'my-custom-theme'), // Элемент не найден
        'not_found_in_trash'    => __('Не найдено в корзине', 'my-custom-theme'), // Элемент не найден в корзине
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true, // Доступен для общего доступа
        'publicly_queryable' => true, // Можно запрашивать через WP_Query
        'show_in_menu'       => true, // Показывать в меню админ-панели
        'show_in_admin_bar'  => true, // Показывать в административной панели
        'menu_position'      => 5, // Позиция в меню
        'show_in_rest'       => true, // Поддержка Gutenberg
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'), // Поддерживаемые элементы
        'has_archive'        => true, // Включить архивный раздел
        'taxonomies'         => array('category', 'post_tag'), // Поддержка рубрик и меток
    );

    register_post_type('review', $args); // Регистрация кастомного типа записи 'review'
}
add_action('init', 'my_custom_post_type'); // Регистрация кастомного типа записи при инициализации темы

// Установка изображения по умолчанию для постов без миниатюры
function set_default_post_thumbnail($post_id) {
    // Убедитесь, что это не автосохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return; // Завершаем, если это автосохранение
    }

    // Устанавливаем ID изображения по умолчанию (замените на ваше значение)
    $default_image_id = 65; // Замените 65 на ID вашего изображения по умолчанию

    // Проверяем, есть ли у поста изображение
    if (!has_post_thumbnail($post_id)) {
        set_post_thumbnail($post_id, $default_image_id); // Устанавливаем изображение по умолчанию
    }
}

add_action('save_post', 'set_default_post_thumbnail'); // Запускаем функцию установки миниатюры при сохранении поста