<?php
/*
Template Name: Отзывы
*/
?>

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
            <h1><?php _e('Отзывы', 'my-custom-theme'); ?></h1> <!-- Заголовок страницы -->
        </div>
        <aside class="sidebar">
            <?php if (is_active_sidebar('sidebar-1')) : ?> <!-- Проверяем, активен ли сайдбар 'sidebar-1' -->
                <?php dynamic_sidebar('sidebar-1'); ?> <!-- Выводим виджеты сайдбара -->
            <?php else : ?>
                <p><?php _e('В этом месте пока нет виджетов.', 'my-custom-theme'); ?></p> <!-- Сообщение, если виджеты отсутствуют -->
            <?php endif; ?>

            <!-- Форма поиска -->
            <div class="search-form">
                <?php get_search_form(); ?> <!-- Подключаем форму поиска -->
            </div>
        </aside>

        <div class="post-columns">
            <?php
            // Создаем новый запрос для кастомного типа записи 'review'
            $args = array(
                'post_type' => 'review', // Указываем кастомный тип записи
                'posts_per_page' => -1, // Отображаем все записи
            );

            // Выполняем запрос
            $reviews_query = new WP_Query($args);

            if ($reviews_query->have_posts()) : // Проверяем, есть ли записи
                while ($reviews_query->have_posts()) : $reviews_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <!-- Обертка для поста с уникальным ID -->
                        <a href="<?php the_permalink(); ?>" class="entry-container" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>');"> <!-- Ссылка на пост с фоновым изображением -->
                            <header class="entry-header">
                                <h2 class="entry-title"><?php the_title(); ?></h2> <!-- Заголовок поста -->
                                <div class="entry-meta">
                                    <span class="entry-category">
                                        <?php
                                        $categories = get_the_category(); // Получаем категории для поста
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name); // Выводим имя первой категории
                                        }
                                        ?>
                                    </span>
                                    <span class="entry-date">
                                        <?php echo esc_html(get_the_date()); ?> <!-- Выводим дату поста -->
                                    </span>
                                </div>
                            </header>
                        </a>
                    </article>
                <?php endwhile; // Конец цикла по записям ?>
            <?php else : ?>
                <article class="no-posts">
                    <h2><?php _e('Отзывы не найдены', 'my-custom-theme'); ?></h2> <!-- Сообщение, если записи не найдены -->
                </article>
            <?php endif; ?>

            <?php wp_reset_postdata(); // Сбрасываем данные после пользовательского запроса ?>
        </div>
    </div>
</main>

<?php
// Подключаем файл footer.php
get_footer(); 
?>