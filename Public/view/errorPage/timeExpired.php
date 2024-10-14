<?php
	use Model\Utilities\Utilities;
	$local = Utilities::checkIfLocal();
?>

<section class="article__section">
	<H2 class="text-center article__section--sousTitre">Time of connexion is expired!</H2>
	<article class="text-center">
		<p class="article__paragraphe" style="color: red; font-size:20px;">
			</br>
			The time of connexion is expired. Please log in again.
			</br>
			Le temps de connexion est expiré. Veuillez vous reconnecter.
			</br>
			<a class="btn-primary" type="button" href="index.php?page=connexion">Connexion</a>
			<hr>
		</p>
	</article>
</section>

<?php if($urlGoldorak){

		if($local){?>

			<script>
				setTimeout(function(){
					window.location.href = "http://mycv/goldorak/index.php?page=connexion";
				}, 5000);
			</script>

		<?php }else{ ?>

			<script>
				setTimeout(function(){
					window.location.href = "https://www.follaco.fr/goldorak/index.php?page=connexion";
				}, 5000);
			</script>

		<?php } ?>

<?php }elseif($urlGarageparrot){

		if($local){?>

			<script>
				setTimeout(function(){
					window.location.href = "http://mycv/garageparrot/index.php?page=connexion";
				}, 5000);
			</script>

		<?php }else{ ?>

			<script>
				setTimeout(function(){
					window.location.href = "https://www.follaco.fr/garageparrot/index.php?page=connexion";
				}, 5000);
			</script>

		<?php } ?>

<?php }else{

		if($local){?>

			<script>
				setTimeout(function(){
					window.location.href = "http://mycv/index.php?page=connexion";
				}, 5000);
			</script>

		<?php }else{ ?>

			<script>
				setTimeout(function(){
					window.location.href = "https://www.follaco.fr/index.php?page=connexion";
				}, 5000);
			</script>

		<?php } ?>

<?php } ?>