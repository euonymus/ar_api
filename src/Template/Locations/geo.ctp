<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Geo Location') ?></legend>
        <?php
            echo $this->Form->control('latitude');
            echo $this->Form->control('longitude');
            echo $this->Form->control('distance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<? if (isset($locations) && $locations->count()): ?>
<div class="locations index large-9 medium-8 columns content">
    <h3><?= __('Locations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pin_image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('altitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('distance') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $val): ?>
            <tr>
                <td><?= $this->Number->format($val->id) ?></td>
                <td><?= h($val->name) ?></td>
                <td><?= h($val->pin_image) ?></td>
                <td><?= h($val->latitude) ?></td>
                <td><?= h($val->longitude) ?></td>
                <td><?= h($val->altitude) ?></td>
                <td><?= h($val->distance) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $val->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $val->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $val->id], ['confirm' => __('Are you sure you want to delete # {0}?', $val->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<? endif; ?>