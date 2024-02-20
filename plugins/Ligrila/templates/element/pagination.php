<?php
$config = [
    'nextActive' => '<li class="next page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="next disabled page-item"><span class="page-link">{{text}}</span></li>',
    'prevActive' => '<li class="prev page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="prev disabled page-item"><span class="page-link">{{text}}</span></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="first page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="last page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="active page-item"><span class="page-link">{{text}}</span></li>',
    'ellipsis' => '<li class="ellipsis page-item">...</li>',
    'sort' => '<a class="page-link" href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="page-link" class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="page-link" class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="page-link" class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="page-link" class="desc locked" href="{{url}}">{{text}}</a>',
];

$this->Paginator->setTemplates($config);

?>
<nav class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('anterior')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            </ul>
</nav>
