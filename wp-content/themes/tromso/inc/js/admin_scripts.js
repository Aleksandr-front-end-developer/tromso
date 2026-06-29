if ("undefined" !== typeof jQuery) {
  jQuery(function ($) {
  
    $(document).on('click', '#translate_all_ajax_button', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $spinner = $button.find('.spinner');
        var $messageDiv = $('#translate_all_dynamic_content');
        
        // Блокируем кнопку и показываем прелоадер
        $button.prop('disabled', true).addClass('loading');
        $spinner.css('display', 'inline-block');
        $messageDiv.hide().removeClass('crb-result-success crb-result-error');
        
        // Выполняем AJAX-запрос
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'translate_all_site',
            },
            success: function(response) {
                if (response.success) {
                    
                    // Показываем сообщение об успехе
                    $messageDiv
                      .removeClass('crb-result-error')
                      .addClass('crb-result-success')
                      .html(response.data.message)
                      .fadeIn();

                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    
                } else {
                    // Обработка ошибки
                    $messageDiv
                        .removeClass('crb-result-success')
                        .addClass('crb-result-error')
                        .html('<strong>❌ Error!</strong> ' + response.data.message)
                        .fadeIn();
                }
            },
            error: function(xhr, status, error) { 
                $messageDiv
                    .removeClass('crb-result-success')
                    .addClass('crb-result-error')
                    .html('<strong>❌ Error!</strong> ' + error)
                    .fadeIn();
            },
            complete: function() {
                // Разблокируем кнопку и скрываем прелоадер
                $button.prop('disabled', false).removeClass('loading');
                $spinner.hide();
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(function() {
                    $messageDiv.fadeOut();
                }, 5000);
            }
        });
    });

    $(document).on('click', '#translate_find_all_ajax_button', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $spinner = $button.find('.spinner');
        var $messageDiv = $('#translate_find_all_dynamic_content');
        
        // Блокируем кнопку и показываем прелоадер
        $button.prop('disabled', true).addClass('loading');
        $spinner.css('display', 'inline-block');
        $messageDiv.hide().removeClass('crb-result-success crb-result-error');
        
        // Выполняем AJAX-запрос
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'translate_find_all',
            },
            success: function(response) {
                if (response.success) {
                    // Показываем сообщение об успехе
                    $messageDiv
                        .removeClass('crb-result-error')
                        .addClass('crb-result-success')
                        .html(response.data.message)
                        .fadeIn();

                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    
                } else {
                    // Обработка ошибки
                    $messageDiv
                        .removeClass('crb-result-success')
                        .addClass('crb-result-error')
                        .html('<strong>❌ Error!</strong> ' + response.data.message)
                        .fadeIn();
                }
            },
            error: function(xhr, status, error) { 
                $messageDiv
                    .removeClass('crb-result-success')
                    .addClass('crb-result-error')
                    .html('<strong>❌ Error!</strong> ' + error)
                    .fadeIn();
            },
            complete: function() {
                // Разблокируем кнопку и скрываем прелоадер
                $button.prop('disabled', false).removeClass('loading');
                $spinner.hide();
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(function() {
                    $messageDiv.fadeOut();
                }, 2000);
            }
        });
    });


    $(document).on('click', '#translate_settings_export_ajax_button', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $spinner = $button.find('.spinner');
        var $messageDiv = $('#translate_settings_import_export_dynamic_content');
        
        // Блокируем кнопку и показываем прелоадер
        $button.prop('disabled', true).addClass('loading');
        $spinner.css('display', 'inline-block');
        $messageDiv.hide().removeClass('crb-result-success crb-result-error');
        
        // Выполняем AJAX-запрос
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'translate_settings_export',
            },
            success: function(response) {
                if (response.success && typeof response.data.file !== 'undefined') {
                    // Показываем сообщение об успехе
                    $messageDiv
                        .removeClass('crb-result-error')
                        .addClass('crb-result-success')
                        .html(response.data.message)
                        .fadeIn();
                    
                    const jsonString = JSON.stringify(response.data.file, null, 2);
                    const blob = new Blob([jsonString], { type: 'application/json' });
                    const link = document.createElement('a');
                    
                    link.href = URL.createObjectURL(blob);
                    link.download = 'settings.json';
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    
                    link.click(); // Сразу запускаем скачивание
                    
                    // Чистим за собой
                    setTimeout(() => {
                      document.body.removeChild(link);
                      URL.revokeObjectURL(link.href);
                    }, 100);
                      
                } else {
                    // Обработка ошибки
                    $messageDiv
                        .removeClass('crb-result-success')
                        .addClass('crb-result-error')
                        .html('<strong>❌ Error!</strong> ' + response.data.message)
                        .fadeIn();
                }
            },
            error: function(xhr, status, error) { 
                $messageDiv
                    .removeClass('crb-result-success')
                    .addClass('crb-result-error')
                    .html('<strong>❌ Error!</strong> ' + error)
                    .fadeIn();
            },
            complete: function() {
                // Разблокируем кнопку и скрываем прелоадер
                $button.prop('disabled', false).removeClass('loading');
                $spinner.hide();
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(function() {
                    $messageDiv.fadeOut();
                }, 2000);
            }
        });
    });

    $(document).on('click', '#translate_settings_import_ajax_button', function(e) {
        e.preventDefault();
        $('#translate_settings_import_ajax_file').trigger('click');
    });

    $(document).on('change', '#translate_settings_import_ajax_file', function(e) {
        e.preventDefault();

        const file = $(this)[0].files[0];
        
        // проверка
        if (!file) {
          return;
        }
        
        var $button = $(this).next('button');
        var $spinner = $button.find('.spinner');
        var $messageDiv = $('#translate_settings_import_export_dynamic_content');
        
        // Блокируем кнопку и показываем прелоадер
        $button.prop('disabled', true).addClass('loading');
        $spinner.css('display', 'inline-block');
        $messageDiv.hide().removeClass('crb-result-success crb-result-error');

        const formData = new FormData();
        formData.append('file', file);
        formData.append('action', 'translate_settings_import');
        
        // Выполняем AJAX-запрос
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Показываем сообщение об успехе
                    $messageDiv
                        .removeClass('crb-result-error')
                        .addClass('crb-result-success')
                        .html(response.data.message)
                        .fadeIn();
                    
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                      
                } else {
                    // Обработка ошибки
                    $messageDiv
                        .removeClass('crb-result-success')
                        .addClass('crb-result-error')
                        .html('<strong>❌ Error!</strong> ' + response.data.message)
                        .fadeIn();
                }
            },
            error: function(xhr, status, error) { 
                $messageDiv
                    .removeClass('crb-result-success')
                    .addClass('crb-result-error')
                    .html('<strong>❌ Error!</strong> ' + error)
                    .fadeIn();
            },
            complete: function() {
                // Разблокируем кнопку и скрываем прелоадер
                $button.prop('disabled', false).removeClass('loading');
                $spinner.hide();
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(function() {
                    $messageDiv.fadeOut();
                }, 2000);
            }
        });
    });


    $(document).on('click', '#translate_cache_ajax_button, #translate_cache_clear_all_ajax_button', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $spinner = $button.find('.spinner');
        var $messageDiv = $('#translate_cache_dynamic_content');
        
        // Блокируем кнопку и показываем прелоадер
        $button.prop('disabled', true).addClass('loading');
        $spinner.css('display', 'inline-block');
        $messageDiv.hide().removeClass('crb-result-success crb-result-error');
        
        var action = 'translate_cache_clear_identical';
        if ($button.attr('id')=='translate_cache_clear_all_ajax_button') action = 'translate_cache_clear_all';
        
        // Выполняем AJAX-запрос
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: action,
            },
            success: function(response) {
                if (response.success) {
                    // Показываем сообщение об успехе
                    $messageDiv
                        .removeClass('crb-result-error')
                        .addClass('crb-result-success')
                        .html(response.data.message)
                        .fadeIn();
                    
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    
               } else {
                    // Обработка ошибки
                    $messageDiv
                        .removeClass('crb-result-success')
                        .addClass('crb-result-error')
                        .html('<strong>❌ Error!</strong> ' + response.data.message)
                        .fadeIn();
                }
            },
            error: function(xhr, status, error) { 
                $messageDiv
                    .removeClass('crb-result-success')
                    .addClass('crb-result-error')
                    .html('<strong>❌ Error!</strong> ' + error)
                    .fadeIn();
            },
            complete: function() {
                // Разблокируем кнопку и скрываем прелоадер
                $button.prop('disabled', false).removeClass('loading');
                $spinner.hide();
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(function() {
                    $messageDiv.fadeOut();
                }, 2000);
            }
        });
    });

  });
}
