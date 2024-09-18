<?php get_header(); // Подключаем заголовок страницы ?>

<main>
    <div class="container"> <!-- Основной контейнер для содержимого -->
        <?php if (have_posts()) : // Проверяем, есть ли посты ?>
            <?php while (have_posts()) : the_post(); // Начинаем цикл по постам ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <!-- Каждая статья имеет уникальный ID и классы -->
                    <div class="post-paint"> <!-- Обертка для поста -->
                        <?php if (has_post_thumbnail()) : // Проверяем, есть ли миниатюра поста ?>
                            <?php the_post_thumbnail('large'); // Выводим миниатюру поста крупного размера ?>
                        <?php endif; ?>
                        <div class="post-header"> <!-- Заголовок поста -->
                            <h1 class="post-title"><?php the_title(); // Выводим заголовок поста ?></h1>
                            <div class="post-meta"> <!-- Метаинформация о посте -->
                                <div class="post-category"> <!-- Категория поста -->
                                    <?php
                                    $categories = get_the_category(); // Получаем категории поста
                                    if (!empty($categories)) { // Проверяем, есть ли категории
                                        echo esc_html($categories[0]->name); // Выводим название первой категории
                                    }
                                    ?>
                                </div>
                                <div class="post-date"> <!-- Дата публикации поста -->
                                    <?php echo esc_html(get_the_date()); // Выводим дату публикации поста ?>
                                </div>
                            </div>
                        </div>
                        <div class="post-thumbnail"> <!-- Блок для миниатюры поста -->
                            <?php if (has_post_thumbnail()) : // Проверяем, есть ли миниатюра ?>
                                <?php the_post_thumbnail('large'); // Выводим миниатюру поста крупного размера ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="post-block-content"> <!-- Контейнер для основного содержания поста -->
                        <div class="post-content"> <!-- Основное содержимое поста -->
                            <?php the_content(); // Выводим содержание поста ?>
                        </div>
                    </div>
                </article>

                <!-- Навигация по записям может быть добавлена здесь -->
                
            <?php endwhile; // Завершаем цикл ?>
        <?php else : // Если не найдено ни одного поста ?>
            <p><?php _e('Запись не найдена.', 'my-custom-theme'); // Сообщение, если постов нет ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); // Подключаем файл footer.php ?>