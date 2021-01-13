<? for ($i = 0; $i < count($pages); $i++): ?>
    <tr wares_id="<?= $pages[$i]['id'] ?>">
        <td><?= $pages[$i]['page_title'] ?></td>
        <td><?= $pages[$i]['url'] ?></td>
        <td><?= $pages[$i]['theme_title'] ?></td>
        <td style="text-align: center;">
            <?= ($pages[$i]['visible'] == '1') ? '<span class="badge badge-success">' . $lang['pages'][$_SESSION['lang']]['s_opened'] . '</span>' : '<span class="badge badge-danger">' . $lang['pages'][$_SESSION['lang']]['s_close'] . '</span>' ?>
        </td>
        <td><a href="?content=<?= $pages[$i]['id'] ?>" class="btn-sm btn-primary">материалы</a></td>
        <td style="text-align: center;">
            <a href="?edit=<?= $pages[$i]['id'] ?>" class="btn-sm btn-primary"><?= $lang['pages'][$_SESSION['lang']]['edit'] ?></a>
            <a href="/<?= $pages[$i]['url'] ?>/" target="_blank" class="btn-sm btn-primary"><?= $lang['pages'][$_SESSION['lang']]['show'] ?></a>
            <!--
            <input type="button" value="<?= $lang['pages'][$_SESSION['lang']]['role'] ?>" class="btn-sm btn-primary"/>
            -->
        </td>
    </tr>
<? endfor; ?>