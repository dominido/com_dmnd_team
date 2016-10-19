<?php

defined('_JEXEC') or exit();

?>

<h4><strong>Наша команда</strong></h4>
<hr class="hr-8" />

<?php $switchcat = ""; $flag = 0; $n = 0; for ($i=0; $i < count($this->items); $i++) { ?>

	<?php if ($this->items[$i]->category != $switchcat) { $flag = 1; $n = 0; ?>
	<?php if ($i > 0) echo '</div><hr class="hr-1" />'; ?>
		<h2><?php echo $this->items[$i]->category; ?></h2>
		<div class="grid-block grid-gutter">
	<?php $switchcat = $this->items[$i]->category; } ?>

	<?php if ($n > 0 && $n%2==0 && $flag == 0) { ?>
		</div>
		<hr class="hr-1" />
		<div class="grid-block grid-gutter">
	<?php } ?>

	<div class="grid-box width16">
		<div class="bfc-o">
			<a href="images/team/<?php echo $this->items[$i]->image; ?>" data-lightbox="on">
				<img src="images/team/thumb-<?php echo $this->items[$i]->image; ?>" alt="<?php echo $this->items[$i]->title; ?>" class="size-auto polaroid" />
			</a>
		</div>
	</div>

	<div class="grid-box width33">
		<div class="bfc-o">
			<h3 class="remove-margin-b"><?php echo $this->items[$i]->title; ?></h3>
			<small class="remove-margin"><?php echo $this->items[$i]->subtitle; ?><br /></small>
			<hr class="hr-2" />
			<div>
				<?php $phone = unserialize($this->items[$i]->phone); ?>
				<?php for ($j=0; $j < count($phone); $j++) { ?>
				<span class="halflings phone"><i></i><strong><?php echo $phone[$j]; ?></strong></span>
				<br />
				<?php } ?>
				<span class="halflings envelope"><i></i><strong><?php echo $this->items[$i]->email; ?></strong></span>
			</div>
		</div>
	</div>

<?php $flag = 0; $n++; } ?>
	</div>
