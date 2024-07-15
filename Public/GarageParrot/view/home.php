<?php include_once('../../garageparrot/controller/home.controller.php') ?>
<?php include_once('../../common/utilies.php') ?>

<form action="" method="post">

	<!-- input hidden csrf -->
	<input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

	<div class="container pt-3">

		<div class="col-12 bg-dark d-flex justify-content-center text-light mx-auto mb-3 rounded-3">

			<h2 class="px-0 py-3 m-0 w-100">

				<input
					class="text-center <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'text-light bg-transparent';} ?> "
					type="text"
					id="txt_titre1"
					name="txt_home_titre1"
					<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';}?>
					value="<?php echo escapeInput($Home[0]['titre1']); ?>"
				>

			</h2>

		</div>

	</div>

	<div class="container">

		<div class="row">

			<div class="col-12">

				<p>

					<textarea
						class="text-left <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>"
						name="txt_intro_chapter1"
						id="txt_intro_chapter1"
						rows="4"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['intro_chapter1']); ?></textarea>

				</p>

				<hr>

				<p>

					<textarea
						class="text-left <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>" 
						name="txt_intro_chapter2"
						id="txt_intro_chapter2"
						rows="4"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['intro_chapter2']); ?></textarea>

				</p>

			</div>

		</div>

	</div>
	
	<?php
	if($_SESSION['typeConnect'] === 'Administrator'){
	?>
		<div class="container text-center">

			<button
				class="btn btn-lg btn-primary fs-4"
				id="bt_home"
				name="bt_home"
				type="submit">Enregistrer la page d'accueil
			</button>

		</div>
	<?php
	}
	?>

	<div class="container pt-3">

		<div class="col-12 bg-dark d-flex justify-content-center text-light mx-auto mb-3 rounded-3">

			<h2 class="px-0 py-3 m-0 w-100">

				<input
					class="text-center <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'text-light bg-transparent';} ?>" 
					type="text"
					id="txt_home_titre2"
					name="txt_home_titre2"
					value="<?php echo escapeInput($Home[0]['titre2']); ?>"
					<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
				>

			</h2>

		</div>

	</div>

	<div class="container pb-0 pb-lg-3">

		<div class="row">

			<div class="d-flex flex-column flex-lg-row justify-content-center p-0 p-lg-5 m-0">
				
				<div class="col-12 col-lg-8 d-flex flex-column justify-content-center bg-light m-0 pe-0 pe-lg-5">

					<h2 class="text-center <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>">

						<input
							class="text-center fw-bold"
							id="txt_article1_titre"
							name="txt_article1_titre"
							type="text"
							value="<?php echo escapeInput($Home[0]['article1_titre']); ?>"
							<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						>

					</h2>

					<textarea
						class="text-left m-0 pe-0 pe-lg-5 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>" 
						name="txt_article1_chapter1"
						id="txt_article1_chapter1"
						rows="6"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['article1_chapter1']); ?></textarea>

				</div>

				<img
					class="m-0 ps-0 pb-3 pb-lg-0 ps-lg-5"
					src="img/photo/<?php echo escapeInput($Home[0]['article1_image1']); ?>"
					alt="photo mécanique"
				>

			</div>

			<hr>

		</div>

	</div>

	<div class="container pb-0 pb-lg-3">

		<div class="row">

			<div class="d-flex flex-column flex-lg-row justify-content-center p-0 p-lg-5 m-0">

				<img
					class="m-0 ps-0 pb-3 pb-lg-0"
					src="img/photo/<?php echo escapeInput($Home[0]['article1_image2']); ?>"
					alt="photo mécanique"
				>

				<div class="col-12 col-lg-8 d-flex flex-column justify-content-center bg-light m-0 ps-0 ps-lg-5">

					<h2 class="text-center <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>">

						<input
							class="text-center fw-bold"
							id="txt_article1_titre2"
							name="txt_article1_titre2"
							type="text"
							<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
							value="<?php echo escapeInput($Home[0]['article1_titre2']); ?>"
						>

					</h2>

					<textarea
						class="text-left m-0 pe-0 pb-3 pb-lg-0 pe-lg-5 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>"
						name="txt_article1_chapter2"
						id="txt_article1_chapter2"
						rows="6"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['article1_chapter2']); ?></textarea>

				</div>

			</div>

			<hr>

		</div>

	</div>

	<div class="container pb-0 pb-lg-3">

		<div class="row">

			<div class="d-flex flex-column flex-lg-row justify-content-center p-0 p-lg-5 m-0">

				<div class="col-12 col-lg-8 d-flex flex-column justify-content-center bg-light m-0 pe-0 pe-lg-5">

					<h2 class="text-center pt-3 pt-lg-0 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>">

						<input
							class="text-center fw-bold"
							id="txt_article2_titre"
							name="txt_article2_titre"
							type="text"
							<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
							value="<?php echo escapeInput($Home[0]['article2_titre']); ?>"
						>

					</h2>

					<textarea
						class="text-left m-0 pe-0 pe-lg-5 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>" 
						name="txt_article2_chapter1"
						id="txt_article2_chapter1"
						rows="6"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['article2_chapter1']); ?></textarea>

				</div>

				<img
					class="m-0 ps-0 pb-3 pb-lg-0 ps-lg-5"
					src="img/photo/<?php echo escapeInput($Home[0]['article2_image1']); ?>"
					alt="photo mécanique"
				>

			</div>

			<hr>

		</div>

	</div>

	<div class="container pb-0 pb-lg-3">

		<div class="row">

			<div class="d-flex flex-column flex-lg-row justify-content-center p-0 p-lg-5 ps-lg-0 m-0">
				
				<img
					class="m-0 ps-0 pb-3 pb-lg-0"
					src="img/photo/<?php echo escapeInput($Home[0]['article2_image2']); ?>"
					alt="photo mécanique"
				>

				<div class="col-12 col-lg-8 d-flex flex-column justify-content-center bg-light m-0 ps-0 ps-lg-5">
					
					<h2 class="text-center <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>">

						<input
							class="text-center fw-bold"
							id="txt_article2_titre2"
							name="txt_article2_titre2"
							type="text"
							<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
							value="<?php echo escapeInput($Home[0]['article2_titre2']); ?>"
						>

					</h2>

					<textarea
						class="text-left m-0 pe-0 pb-3 pb-lg-0 pe-lg-5 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent';} ?>"
						name="txt_article2_chapter2"
						id="txt_article2_chapter2"
						rows="6"
						<?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly disabled';} ?>
						style="text-align: justify;"
					><?php echo escapeInput($Home[0]['article2_chapter2']); ?></textarea>

				</div>

			</div>

		</div>

	</div>

	<?php
	if($_SESSION['typeConnect'] === 'Administrator'){
	?>

		<div class="container text-center">

			<button
				class="btn btn-lg btn-primary fs-4"
				id="bt_home"
				name="bt_home"
				type="submit">
				Enregistrer la page d'accueil
			</button>

		</div>

	<?php
	}
	?>

</form>

<div class="container pt-3">

	<?php include("../../garageparrot/module/comment.php");?>

</div>