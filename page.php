<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit; // Выход, если файл вызывается напрямую
}

// Подключаем файл header.php
get_header(); 
?>

<main class="site-main">
    <div class="container">
        <div class="page-title">
            <h1><?php echo get_the_title(); // Заголовок страницы ?></h1>
        </div>
        <aside class="sidebar">
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <?php dynamic_sidebar('sidebar-1'); ?> <!-- Выводим виджеты сайдбара -->
            <?php else : ?>
                <p><?php _e('В этом месте пока нет виджетов.', 'my-custom-theme'); ?></p> <!-- Сообщение, если нет виджетов -->
            <?php endif; ?>

            <!-- Форма поиска -->
            <div class="search-form">
                <?php get_search_form(); // Подключаем форму поиска ?>
            </div>
        </aside>

        <?php if (get_the_content()) : // Проверяем наличие контента ?>
            <div class="post-block-content">
                <div class="post-content">
                    <?php the_content(); // Выводим содержимое страницы ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
// Подключаем файл footer.php
get_footer(); 
?>