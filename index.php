<?php
/*
Template Name: Записи
*/
?>

<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit; // Выход, если файл вызывается напрямую
}

get_header(); // Подключаем файл header.php
?>

<main class="site-main">
    <div class="container">
        <div class="page-title">
            <h1><?php _e('Записи', 'my-custom-theme'); ?></h1> <!-- Заголовок страницы -->
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
            <?php if (have_posts()) : ?> <!-- Проверяем, есть ли посты -->
                <?php while (have_posts()) : the_post(); ?> <!-- Цикл для вывода постов -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <!-- Обертка для поста с уникальным ID -->
                        <a href="<?php the_permalink(); ?>" class="entry-container" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>');"> <!-- Ссылка на пост с фоновым изображением -->
                            <header class="entry-header">
                                <h2 class="entry-title"><?php the_title(); ?></h2> <!-- Заголовок поста -->
                                <div class="entry-meta">
                                    <span class="entry-category">
                                        <?php
                                        $categories = get_the_category(); // Получаем категории поста
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
                <?php endwhile; ?>
            <?php else : ?>
                <article class="no-posts">
                    <h2><?php _e('Записи не найдены', 'my-custom-theme'); ?></h2> <!-- Сообщение, если записи не найдены -->
                </article>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <?php
            // Добавление навигации страниц
            the_posts_navigation(); 
            ?>
        </div>
    </div>
</main>

<?php
get_footer(); // Подключаем файл footer.php
?>