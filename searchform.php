<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <!-- Форма для выполнения поиска -->
    
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label'); ?></span>
        <!-- Текст для экранных считывателей, не отображается на странице -->
        
        <input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label'); ?>" />
        <!-- Поле ввода для поиска. Значение по умолчанию — текущее поисковое значение, если такое есть -->
        
    </label>
    
    <button type="submit" class="search-submit"><?php echo esc_html_x('Search', 'submit button'); ?></button>
    <!-- Кнопка для отправки формы поиска -->
</form>