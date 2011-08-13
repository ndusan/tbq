<? $view->extend('UserBundle::layout.html.php') ?>

<form action="<?= (isset($user) ? $view['router']->generate('user.edit', array('id' => $user->getId())) : $view['router']->generate('user.add')); ?>" method="post" <?= $view['form']->enctype($form) ?> >
    <? echo $view['form']->errors($form) ?>
    <div>
            <div>
            <p>
                <?= $view['form']->label($form['firstname']) ?>
                <?= $view['form']->errors($form['firstname']) ?>
                <?= $view['form']->widget($form['firstname'], array('attr' => array('class' => 'input-flex'))) ?>
            </p>
            <p>
                <?= $view['form']->label($form['lastname']) ?>
                <?= $view['form']->errors($form['lastname']) ?>
                <?= $view['form']->widget($form['lastname'], array('attr' => array('class' => 'input-flex'))) ?>
            </p>
            <p>
                <?= $view['form']->label($form['email']) ?>
                <?= $view['form']->errors($form['email']) ?>
                <?= $view['form']->widget($form['email'], array('attr' => array('class' => 'input-flex'))) ?>
            </p>
            <p>
                <?= $view['form']->label($form['plainPassword']['first'], 'Password') ?>
                <?= $view['form']->errors($form['plainPassword']) ?>
                <?= $view['form']->widget($form['plainPassword']['first']) ?>
            </p>
            <p>
                <?= $view['form']->label($form['plainPassword']['second'], 'Repeat password') ?>
                <?= $view['form']->widget($form['plainPassword']['second']) ?>
            </p>
        </div>
        <?= $view['form']->rest($form) ?>
    </div>
    <input type="submit" />
</form>