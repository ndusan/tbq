<? $view->extend('UserBundle::layout.html.php') ?>


<table class="display">
    <thead>
        <tr>
            <th>firstname</th>
            <th>lastname</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($userCollection as $user):?>
        <tr>
            <td><?=$user->getFirstname();?></td>
            <td><?=$user->getLastname(); ?></td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>