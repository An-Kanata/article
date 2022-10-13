<script src="jquery-3.6.1.min.js"></script>
<script src="main.js"></script>
<link rel="stylesheet" href="styls.css" type="text/css"/>

<?php

include 'db.php';
/**@var $connection_loc*/

$art = file_get_contents('article.txt');

$auth = 0;

if (array_key_exists('hash', $_COOKIE) and array_key_exists('login', $_COOKIE)) {
    $hash = $_COOKIE['hash'];
    $login = $_COOKIE['login'];
    $command = "select * from users where hash ='$hash' and login = '$login'";
    $rows = mysqli_query($connection_loc, $command);
    $row = mysqli_fetch_array($rows);
    $auth = mysqli_num_rows($rows);
}

?>

<div class="container">
    <div class="left">
        <?php
        if (!$auth):
            ?>
            <a href="#" class="auth_link">Войти</a>
            <br>
            <a href="#" class="reg_link">Зарегистрироваться</a>
        <?php
        else:
        ?>
        <h3>Добрый день, <?= $row['login'];
            endif; ?></h3>
    </div>
    <div class="article">
        <?= $art ?>
        <br>
        <?php
        if ($auth):
            ?>
            <form method="post" action="" class="new_comment">
                <div style="width: 80%">
                    <textarea placeholder="Ваш комментарий..." name="comm" class="comm_input"></textarea>
                </div>
                <div style="width: 20%">
                    <input type="submit" name="submit" class="comm_sumb">
                </div>
            </form>
            <?php
            ?>
        <?php
        else:
            ?>
            <div class="no_comment">
                <i style="color: #a9302a">Писать комментарии могут только авторизованные пользователи.</i>
            </div>
        <?php
        endif;
        ?>
        <div class="comments">
            Комментарии
            <!--        тут будет вывод комментов-->
            <?php
            $command = "select comments.id, comments.text, comments.user, comments.levl, comments.parent, comments.main_parent, comments.time, user.login from comments left join (select id, login from users) as user on user.id=comments.user";
            $rows = mysqli_query($connection_loc, $command);
            $comments = array();
            $childs = array();
            foreach ($rows as $row) {
                $id = $row['id'];
                $text = $row['text'];
                $levl = $row['levl'];
                $parent = $row['parent'];
                $main_p = $row['main_parent'];
                $login = $row['login'];
                $time = $row['time'];
                if ($parent == 0) {
                    $comments[$id] = array('text' => $text, 'user' => $login, 'child' => 0, 'time'=>$time);
                } elseif (array_key_exists($main_p, $childs)) {
                    $childs[$main_p]++;
                } else {
                    $childs[$main_p] = 1;
                }
            }
            foreach ($comments as $id => $data):
                if (array_key_exists($id, $childs)) {
                    $data['child'] = $childs[$id];
                }
                ?>
                <div class="comment_one">
                    <div class="comm_line">
                        <div class="comm_name">
                            <b>👥 <?= $data['user'] ?> </b>
                        </div>
                        <?php if ($_COOKIE['login'] == $data['user']):
                            ?>
                            <a href="#" class="edit_link" data-id="<?= $id ?>">Редактировать</a>
                        <?php endif; ?>
                    </div>
                    <div class="comm_text" data-id="<?= $id ?>">
                        <div><?= $data['text'] ?></div>
                    </div>
                    <div class="comm_line">
                        <div class="branch">
                            <?php if ($data['child']): ?>
                                <a href="#" class="branch_link" data-id="<?= $id ?>" data-auth="<?= $auth ?>">Показать
                                    ветку (<?= $data['child'] ?>)</a>
                            <?php endif; ?>
                        </div>
                        <div class="time">
                            <?= date("d-M, H:i:s", $data['time']) ?>
                        </div>
                        <div class="reply">
                            <?php if ($auth):?>
                            <a href="#" class="reply_link" data-id="<?= $id ?>">Ответить</a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <?php if ($data['child']): ?>
                <div class="branch_div" data-id="<?= $id ?>"></div>
            <?php endif; ?>
            <?php
            endforeach;
            ?>
            <div class="comment">
                <div class="replace_div">
                    Редактирование комментария
                    <form method="post" action="" class="comment_ed">
                        <div style="width: 20%">
                            <input type="submit" value="Отмена" name="cancel" class="comm_cancel">
                        </div>
                        <div style="width: 80%">
                            <textarea name="comm" class="comm_edit">^</textarea>
                        </div>
                        <div style="width: 20%">
                            <input type="submit" name="submit" class="comm_sumb">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        <?php
        if ($auth):
            ?>
            <a href="#" class="deauth_link">Выйти</a>
        <?php
        endif;
        ?>
    </div>
</div>

<div id="reg_form" class="forma">
    <div class="shade"></div>
    <div class="modalka">
        <div class="cross">
            X
        </div>
        <div class="form">
            Регистрация
            <form method="post" action="" class="ul reg_form">
                <div>
                    <label for="">Логин:</label>
                    <input type="text" name="login">
                </div>
                <div>
                    <label for="">Пароль:</label>
                    <input type="text" name="pass">
                </div>
                <input type="submit" name="submit" class="subm">
            </form>
        </div>
    </div>
</div>

<div id="auth_form" class="forma">
    <div class="shade"></div>
    <div class="modalka">
        <div class="cross">
            X
        </div>
        <div class="form">
            Авторизация
            <form method="post" action="" class="ul auth_form">
                <div>
                    <label for="">Логин:</label>
                    <input type="text" name="login">
                </div>
                <div>
                    <label for="">Пароль:</label>
                    <input type="text" name="pass">
                </div>
                <input type="submit" name="submit" class="subm">
            </form>
        </div>
    </div>
</div>