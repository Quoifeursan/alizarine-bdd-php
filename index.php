<?php
// Connexion à la base de données PostgreSQL en utilisant PDO
$serveur_bd = 'etu.bts-malraux72.net';
$nom_bd = 'a.morice';
$utilisateur_bd = 'a.morice';
$passe_bd = 'P@ssword';
$source_bd = "pgsql:host=$serveur_bd;port=5432;dbname=$nom_bd;user=$utilisateur_bd;password=$passe_bd";

try {
    $connexion = new PDO($source_bd);
    $sql = "SELECT id_image, url FROM alizarine.image ORDER BY id_image";
    $resultat = $connexion->query($sql);
    $images = $resultat->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie d'images</title>
    <style>
        header{
	position: sticky;
	top:0; 
	left:0;
	z-index: 100;
	margin: 0;
}
#global {
	color: #ffffff;
	background: #9b161e;
}
.contenu {
	align-items: center;
	text-align: center;
	color: #9b161e;
	background: #ffffff00;

}
#global {
	width: 100%;
	overflow: hidden;
}
a{
	color: blue;
}
#entete {
	padding: 0px;
	position: sticky;
	z-index: 1000;
	top: 0;
	left:0;
	background-color: #9b161e;;
	width: 100%;
	padding-right:10% ;
	padding-left:10px ;

}

body h1{
	margin-top: 5%;
	padding-bottom: 5%;
	text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white; 
}
#entete h1 {
	margin: 0;
	text-shadow: -1px -1px 0 #9b161e, 1px -1px 0 #9b161e, -1px 1px 0 #9b161e, 1px 1px 0 #9b161e; 
}
#entete h1 img {
	float: left;
	margin: 7px 20px 10px 0;
}
#entete .sous-titre {
	margin: 4px 0 15px 0;
}
.contenu {
	margin-left: 0%;
	padding: 10px 20px;
}
.contenu > :first-child {
	margin-top: 10px;
}
button{
	background-color: #ffffff;
	border-radius: 10px;
	border: none;
	padding-left: 30px;
	padding-right: 30px;
	padding-top: 10px;
	padding-bottom: 10px;
	margin-left: 10px;

}
.sous-titre a{
	font-size: 22px;
}


.horraires {

	background-color: #9b161e;;
	color: #ffffff;
	border-radius: 40px;
	margin: auto;
	padding-top:40px;
	padding-bottom:40px;
	padding-left:50px;
	padding-right:50px;
	width: 70%;
	text-align: center;
}
.contact{
	border: solid #6f1319 5px; 
	margin-left: 30%; 
	margin-right: 30%; 
	margin-bottom: 10%;
	border-radius: 30px;
}
/* CAROUSELS*/
#carouselAtelier{
width: 50%;
margin-left: auto;
margin-right: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    align-content: center;
	border-radius: 20px;
	border: 10px solid #9b161e;
}
#carouselOeuvres{
	width: 50%;
	margin-left: auto;
	margin-right: auto;
	display: flex;
	align-items: center;
	justify-content: center;
	align-content: center;
	border-radius: 20px;
	border: 10px solid #9b161e;
	}
#carouselExpo{
	width: 50%;
	margin-left: auto;
	margin-right: auto;
	display: flex;
	align-items: center;
	justify-content: center;
	align-content: center;
	border-radius: 20px;
	border: 10px solid #9b161e;
	margin-bottom: 10%;
}
.paint {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vh;
    pointer-events: none;
    z-index: -1; 
}
.paint img {
    width: auto;
    height: 80%;
    object-fit: cover;
    top: 20%;
    left: 30%;
}
        #image {
            max-width: 100%;
            cursor: pointer;
        }
    </style>
</head>
<header>
	<div id="global">
		<div id="entete" style="border-bottom: solid">
			<h1 style="padding: 0%;">


				<img style="border-radius: 10px;" src="img/logo.jpg" height="110" />

				
				Les Ateliers Alizarine<br>
			</h1>
			<h0 style="font-size: 20px;">cours de dessin et peinture, Florence Daubas</h0>
			<p class="sous-titre">
                <a href="#Galerie"><button style="border-radius: 10px;">Galerie</button></a>
                <a href="#informations"><button style="border-radius: 10px;">Informations</button></a>
				<a href="#Horaires"><button style="border-radius: 10px;">Horaires</button></a>
                <a href="#Contact"><button style="border-radius: 10px;">Contact</button></a>

			</p>
		</div>
		
		</div>
</header>
<body>
<div class="paint">
	<img src="img/pngeg.png" alt="paint" style="opacity: 0.4;">
  </div>
		<body style="text-align: center; color: #6f1319; font-family: 'Times New Roman', Times, serif;">
			<h1>Bienvenue sur le site des Ateliers Alizarine !!</h1>
			<hr style="background-color:#6f1319; width: 40%; height:6px; margin-left: 30%; border-radius: 3px;">
			<h1>Les ateliers !</h1>

    <?php if (!empty($images)): ?>
        <img style="
        width: 40%;
        border: solid 15px;
        border-radius: 10px;
        color: #6f1319;
        " 
        id="image" src="<?php echo $images[0]['url']; ?>" alt="Image from Database">
    <?php else: ?>
        <p>Aucune image trouvée.</p>
    <?php endif; ?>

    <script>
        // Tableau des URLs des images
        var images = <?php echo json_encode($images); ?>;
        var index = 0;

        // Fonction pour charger l'image suivante
        function chargerImageSuivante() {
            index = (index + 1) % images.length;
            document.getElementById('image').src = images[index].url;
        }

        // Ajouter un gestionnaire d'événements pour le clic sur l'image
        document.getElementById('image').addEventListener('click', chargerImageSuivante);
    </script>








































	

			





















			<div style="margin: 10%;
			/*background-color: #ffffffae;
			border: solid #6f1319 2px;
			border-radius: 10px;
			padding: 3%;*\
			">
			<b id="informations"
			style="font-size: 27px; 
			 
			color: #6f1319;

			">
				Notre association, “Les Ateliers AlizArine”, propose des cours de dessin et de
peinture à un large public dans différentes structures (Saulnières, Ardrières,
MPT Jean Moulin) de la ville du Mans, depuis 2003. Nous accueillons avec
plaisir les enfants, les collégiens, les lycéens, les étudiants, ainsi que les adultes
actifs et retraités.<br>

Florence Daubas, votre professeure, vous guide à travers la découverte et la
maîtrise de diverses pratiques artistiques telles que le fusain, les pastels,
l'aquarelle, l'acrylique, la peinture à l'huile et le modelage plâtre pour aborder le
volume. Les règles fondamentales du dessin et l'harmonie des couleurs font
partie intégrante de cet enseignement.<br>

Nous vous proposons d'explorer une variété de sujets et d'expérimenter
différents supports et outils tels que crayons, pinceaux, couteaux et techniques
mixtes, collages ...<br>

Pendant les cours, nous alternons entre des sujets libres et des sujets suggérés.<br>

Les sujets suggérés sont conçus pour vous encourager à utiliser de nouvelles
techniques, à explorer des effets de matière, et à stimuler votre imagination et
votre créativité. Ces propositions sont également élaborées dans le but de
favoriser votre progression et de mettre en lumière votre expression personnelle.<br>

Quant aux sujets libres, ils vous invitent à effectuer des recherches, à faire des
choix et à réfléchir à l'aspect esthétique et artistique de votre propre sujet.<br>

Nos ateliers de deux heures sont disponibles à différents endroits au Mans et à
divers horaires pour s'adapter à vos disponibilités. Une séance gratuite est même
proposée. Pour les cours destinés aux enfants le mercredi, tout le matériel est
fourni. Consultez l’onglet horaires pour obtenir plus d'informations.<br>

Explorez notre site pour en savoir plus sur les cours proposés, les horaires, et les
tarifs. Rejoignez-nous dans cette aventure artistique, où la passion de créer se
conjugue avec l'art de partager!<br>
			</b></div>





			


			<hr style="background-color:#6f1319; width: 40%; height:6px; margin-left: 30%; border-radius: 3px;">










				<br id="Horaires">

                <div class="horraires" style="font-size: larger; margin-top: 5%; margin-bottom: 10%; font-size: 27px; ">
                <p>

                    <b>M.LC Les Saulnières (avenue Rhin et Danube)</b><br>
						Lundi<br>
						18h30-20h30<br>
						Mardi<br>
						9h15-11h15<br>
						Mercredi<br>
						9h15-10h45.<br>
						10h45-12h15.<br>
						14h-15h20<br>
						15h30-17h30<br>
						Jeudi<br>
						9h15-11h15<br>
						Vendredi<br>
						9h15-11h15<br>
						14h-16h<br><br>
						<b>Maison de quartier les Ardrières (rue du Happeau)</b><br>
						Mardi <br>
						14h-16h<br>
						Jeudi <br>
						14h-16h<br><br>
						<b>Maison pour tous Jean Moulin (rue Robert collet)</b><br>
						Lundi <br>
						14h-16h<br><br>


                </p>
                </div>






				








				<br id="Contact">
				<div class="contact" style="background-color: #fff;">
                <h3>Contact</h3>
                <p>
                   
					<a style="text-decoration: none; font-size: 20px;" href="tel:+33608005844">06 08 00 58 44</a><br>
					<a style="text-decoration: none; font-size: 20px;" href="mailto:floflo.daubas@gmail.com">floflo.daubas@gmail.com</a>
                </p>
				</div>
	
		</div>
	</div>

</body>
<footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</footer>
</html>
