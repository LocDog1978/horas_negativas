<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(0);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination">
		<!-- Botões "Primeira" e "Anterior" -->
		<li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled'; ?>">
			<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
				<span aria-hidden="true" class="fa fa-angle-double-left <?= $pager->hasPrevious() ? 'bigger-arrow' : ''; ?>"></span>
			</a>
		</li>
		<li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled'; ?>">
			<a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
				<span aria-hidden="true" class="fa fa-angle-left <?= $pager->hasPrevious() ? 'bigger-arrow' : ''; ?>"></span>
			</a>
		</li>

		<!-- Botões "Próxima" e "Última" -->
		<li class="page-item <?= $pager->hasNext() ? '' : 'disabled'; ?>">
			<a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
				<span aria-hidden="true" class="fa fa-angle-right <?= $pager->hasNext() ? 'bigger-arrow' : ''; ?>"></span>
			</a>
		</li>
		<li class="page-item <?= $pager->hasNext() ? '' : 'disabled'; ?>">
			<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
				<span aria-hidden="true" class="fa fa-angle-double-right <?= $pager->hasNext() ? 'bigger-arrow' : ''; ?>"></span>
			</a>
		</li>
	</ul>
</nav>

<style>
	.bigger-arrow {
		font-size: 1.3em;
		color: #007bff;
		font-weight: bold;
	}
	.disabled .bigger-arrow {
		color: inherit;
	}
</style>