<?php
extract($data['page']);
$left = 2;
$right = 2;
$current = $number;
$end = $count;

if ($count > 1) :
?>
	<div class="container pagination justify-content-center">
		<div class="row">
			<?php if ($current == 1) { ?>
				<div class="col grey"><i class="fas fa-angle-left "></i></div>
			<?php } else { ?>
				<a href="<?= "?page=1"; ?>">
					<div class="col green"><i class="fas fa-angle-left "></i></div>
				</a>
			<?php } ?>
			<?php
			if ($current > $left && $current < ($end - $right)) {
				$end_point = (($current + $right) < $end) ? $current + $right : $end;
				for ($i = $current - $left; $i <= $end_point; $i++) {
			?>
					<a href="<?= "?page=$i"; ?>">
						<div class="col <?= $i == $current ? 'yellow green' : 'green' ?>"><?= $i; ?></div>
					</a>
				<?php
				}
			} elseif ($current <= $left) {
				$slice = 1 + $left - $current;
				$end_point = ($current + ($right + $slice)) < $end ? $current + ($right + $slice) : $end;
				for ($i = 1; $i <= $end_point; $i++) {
				?>
					<a href="<?= "?page=$i"; ?>">
						<div class="col <?= $i == $current ? 'yellow green' : 'green' ?>"><?= $i; ?></div>
					</a>
				<?php
				}
			} else {
				$slice = $right - ($end - $current);
				for ($i = (($current - ($left + $slice)) < 1) ? 1 : $current - ($left + $slice); $i <= $end; $i++) {
				?>
					<a href="<?= "?page=$i"; ?>">
						<div class="col <?= $i == $current ? 'yellow green' : 'green' ?>"><?= $i; ?></div>
					</a>
			<?php
				}
			}
			?>
			<?php if ($current == $end) { ?>
				<div class="col grey"><i class="fas fa-angle-right "></i></div>
			<?php } else { ?>
				<a href="<?= "?page=$end"; ?>">
					<div class="col green"><i class="fas fa-angle-right "></i></div>
				</a>
			<?php } ?>
		</div>
	</div>
<?php
endif;
?>