<?php get_header(); // Подключаем заголовок страницы ?>

<main class="search-results"> <!-- Основной контейнер для результатов поиска -->
    <div class="container"> <!-- Контейнер для обертки содержимого -->
        <div class="page-title"> <!-- Заголовок секции -->
            <h1><?php _e('Результаты поиска', 'my-custom-theme'); ?></h1> <!-- Заголовок страницы с фиксированным текстом -->
        </div>

        <div class="post-columns"> <!-- Контейнер для результатов постов -->
            <?php if (have_posts()) : // Проверяем, есть ли результаты поиска ?>
                <?php while (have_posts()) : the_post(); // Начинаем цикл по найденным постам ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <!-- Обертка для поста с уникальным ID -->
                        <a href="<?php the_permalink(); ?>" class="entry-container" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>');"> <!-- Ссылка на пост с фоновым изображением -->
                            <header class="entry-header"> <!-- Заголовок поста -->
                                <h2 class="entry-title"><?php the_title(); ?></h2> <!-- Заголовок поста -->
                                <div class="entry-meta"> <!-- Метаинформация поста -->
                                    <div class="entry-category"> <!-- Категория поста -->
                                        <?php
                                        $categories = get_the_category(); // Получаем категории поста
                                        if (!empty($categories)) { // Проверяем, есть ли категории
                                            echo esc_html($categories[0]->name); // Выводим имя первой категории
                                        }
                                        ?>
                                    </div>
                                    <div class="entry-date"> <!-- Дата поста -->
                                        <?php echo esc_html(get_the_date()); // Выводим дату публикации поста ?>
                                    </div>
                                </div>
                            </header>
                        </a>
                    </article>
                <?php endwhile; // Конец цикла ?>
            <?php else : // Если посты не найдены ?>
                <article class="no-posts"> <!-- Сообщение, если никаких постов не найдено -->
                    <h2><?php _e('Записи не найдены', 'my-custom-theme'); ?></h2> <!-- Сообщение о том, что записи не найдены -->
                </article>
            <?php endif; ?>
        </div>

        <?php
        // Пагинация
        the_posts_pagination(array(
            'prev_text' => __('« Предыдущая', 'my-custom-theme'), // Текст для кнопки "предыдущая"
            'next_text' => __('Следующая »', 'my-custom-theme'), // Текст для кнопки "следующая"
        )); ?>

    </div>
</main>

<?php get_footer(); // Подключаем файл footer.php ?>