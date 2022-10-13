<?php

include 'db.php';
/**@var $connection_loc */

$res = '';
if ($_POST) {
    $id = $_POST['id'];
    $auth = $_POST['auth'];
    $blocks = array();
    $branch = array();
    $command = "select comments.id, comments.text, comments.user, comments.levl, comments.parent, comments.main_parent, comments.time, user.login from comments left join (select id, login from users) as user on user.id=comments.user where comments.main_parent='$id' order by comments.levl";
    $rows = mysqli_query($connection_loc, $command);
    $comments = array();
    foreach ($rows as $row) {
        $id = $row['id'];
        $text = $row['text'];
        $levl = $row['levl'];
        $parent = $row['parent'];
        $main_p = $row['main_parent'];
        $login = $row['login'];
        $time = $row['time'];
        $comments[$id] = array('text' => $text, 'user' => $login, 'parent' => $parent, 'levl' => $levl, 'time' => $time);
        if ($levl == 1) {
            $branch[] = $id;
        } else {
            $key = array_search($parent, $branch);
            array_splice($branch, $key + 1, 0, $id);
        }
    }
    foreach ($branch as $id) {
        $blocks[$id] = $comments[$id];
    }
    foreach ($blocks as $id => $data) {
        $res .= '<div class="branch_comment_div">';
        for ($i = 0; $i < $data['levl']; $i++) {
            $res .= ' <div class="border_div" > </div> ';
        }
        $res .= '<div class="comment_one" style="margin-left: 2px">
        <div class="comm_line">
            <div class="comm_name">
                <b>👥 ' . $data['user'] . '</b>
            </div>';
        if ($_COOKIE['login'] == $data['user']) {
            $res .= '<a href="#" class="edit_link" data-id="' . $id . '">Редактировать</a>';
        }
        $res .= '</div>
        <div class="comm_text" data-id="' . $id . '">
            <div>' . $data['text'] . '</div>
        </div>
        <div class="comm_line"> <div class="branch">
                        </div>';
        $res .= '
                        <div class="time">
                            ' . date("d-M, H:i:s", $data['time']) . '
                        </div>
            <div class="reply">';
        if ($auth) {
            $res .= '<a href="#" class="reply_link" data-id="' . $id . '">Ответить</a>';

        }
        $res .= '  </div>
        </div>
    </div>
    </div>';

    }
}
echo $res;
