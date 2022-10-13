$(document).ready(function () {
    $('.auth_link').click(function (e) {
        e.preventDefault();
        $('#auth_form').css('display', 'flex');
        // $('.sub_text').click(function () {
        //         $.ajax({
        //             type: "POST",
        //             url: "/in_db.php",
        //             data: {name: '$_COOKIE[\'name\']', text: '$_POST[\'text\']', dat: 'date(\'d M H:i\', time())'}
        //         })
        //     }
        // )
    })
    $('.reg_link').click(function (e) {
        e.preventDefault();
        $('#reg_form').css('display', 'flex');
    })
    $('.shade').click(function (e) {
        e.preventDefault();
        $(this).parent().css('display', 'none');
    })
    $('.cross').click(function (e) {
        e.preventDefault();
        $(this).parents('.forma').css('display', 'none');
    })
    $('.reg_form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/article/reg.php",
            data: $(this).serialize(),
            success: function (data) {
                res = jQuery.parseJSON(data);
                if (res.res == '1') {
                    location.href = location.href
                } else {
                    alert('Произошла ошибка, обновите страницу и попробуйте снова');
                }
            }
        })
    })
    $('.auth_form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/article/auth.php",
            data: $(this).serialize(),
            success: function (data) {
                res = jQuery.parseJSON(data);
                if (res.res == '1') {
                    location.href = location.href
                } else {
                    alert('Пара логин-пароль не совпадают с существующими в системе. Попробуйте снова');
                }
            }
        })
    })
    $('.deauth_link').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/article/deauth.php",
            data: $(this).serialize(),
            success: function (data) {
                location.href = location.href
            }
        })
    })
    $(document).on('click', '.edit_link', function (e) {
        debugger;
        e.preventDefault();
        id = $(this).data('id');
        text = $('.comm_text[data-id=' + id + '] div').text();
        mew_block = $('.comment').html();
        mew_block = mew_block.replace('^', text);
        $('.comm_text[data-id=' + id + ']').replaceWith(mew_block);
        $('#comment').css('display', 'flex');
        for_display = $(this)
        for_display.css('display', 'none');
        $(this).parents('.comment_one').find('.comm_sumb').click(function (e) {
            e.preventDefault();
            new_text = $(this).parents('.comment_ed').find('.comm_edit').val();
            for_replace = $(this).parents('.replace_div');
            $.ajax({
                type: "POST",
                url: "/article/comment.php",
                data: {'text': new_text, 'id': id},
                success: function (data) {
                    res = jQuery.parseJSON(data);
                    if (res.res == 1) {
                        for_replace.replaceWith('<div class="comm_text" data-id=' + id + '> <div>' + new_text + '</div></div>')
                    } else {
                        alert('Произошла ошибка, попробуйте снова.');
                    }
                }
            })
        })
        $(this).parents('.comment_one').find('.comm_cancel').click(function (e) {
            e.preventDefault();
            new_text = $(this).parents('.comment').find('.comm_edit').val();
            for_replace = $(this).parents('.replace_div');
            for_replace.replaceWith('<div class="comm_text" data-id=' + id + '> <div>' + text + '</div></div>')
            for_display.css('display', 'block');
        })
    })
    $('.branch_link').click(function (e) {
        e.preventDefault();
        id = $(this).data('id');
        auth = $(this).data('auth');
        $(this).css('display', 'none');
        $.ajax({
            type: "POST",
            url: "/article/branch.php",
            data: {'id': id, 'auth':auth},
            success: function (data) {
                if (data != '') {
                    $('.branch_div[data-id=' + id + ']').append(data);
                } else {
                    alert('Возникла проблема, обновите страницу и попробуйте снова.');
                }
            }
        })
    })
    $(document).on('click', '.reply_link', function (e) {
        // $('.reply_link').click(function (e) {
        debugger;
        e.preventDefault();
        id = $(this).data('id');
        mew_block = $('.comment').html();
        mew_block = mew_block.replace('^', '');
        mew_block = mew_block.replace('Редактирование комментария', 'Ответ на комментарий:');
        for_display = $(this)
        for_display.css('display', 'none');
        $(this).parents('.comment_one').append(mew_block);
        $(this).parents('.comment_one').find('.comm_sumb').click(function (e) {
            e.preventDefault();
            text = $(this).parents('.comment_ed').find('.comm_edit').val();
            for_remove = $(this).parents('.replace_div');
            $.ajax({
                type: "POST",
                url: "/article/comment.php",
                data: {'text': text, 'parent': id},
                success: function (data) {
                    res = jQuery.parseJSON(data);
                    if (res.res == 2) {
                        for_remove.remove();
                        location.href = location.href
                    } else if (res.res == 1) {
                        alert('Пустое поле комментария.');
                    }
                }
            })
        })
        $(this).parents('.comment_one').find('.comm_cancel').click(function (e) {
            e.preventDefault();
            for_remove = $(this).parents('.replace_div');
            for_remove.remove();
            for_display.css('display', 'block');
        })
    })
})