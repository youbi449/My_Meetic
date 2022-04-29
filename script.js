$(document).ready(function () {
    $('.confirm').on('click', function () {
        return confirm('Êtes vous vraiment sur ? Zouker est bon pour la santé ');
    });

    $('.deco').on('click', function () {
        alert('A la prochaine ! :)');
    });

    var $slider = $('.slider'), // on cible le bloc du carrousel
        $img = $('.slider ul li'), // on cible les images contenues dans le carrousel
        indexImg = $img.length - 1, // on définit l'index du dernier élément
        i = 0, // on initialise un compteur
        $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
    $img.css('display', 'none'); // on cache les images
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante

    $('.next').click(function () { // image suivante

        i++; // on incrémente le compteur

        if (i <= indexImg) {
            $img.css('display', 'none'); // on cache les images
            $currentImg = $img.eq(i); // on définit la nouvelle image
            $currentImg.css('display', 'block'); // puis on l'affiche
        }
        else {
            i = indexImg;
        }

    });

    $('.prev').click(function () { // image précédente

        i--; // on décrémente le compteur, puis on réalise la même chose que pour la fonction "suivante"

        if (i >= 0) {
            $img.css('display', 'none');
            $currentImg = $img.eq(i);
            $currentImg.css('display', 'block');
        }
        else {
            i = 0;
        }

    }); 
    
    $("#inscription").click(function () {

        $.ajax({
            url: 'inscription.php', // La ressource ciblée
            type: 'GET'
        });

    });
    
    $('.dropdown-content').hide();

    $('.dropdown span').hover(function(){
        $('.dropdown-content').show("fast");    // DROPDOWN 
    });

    $('.dropdown').mouseleave(function(){
        $('.dropdown-content').hide("fast");
    });

/*     $('.prev').hide();
    $('.next').hide();
    $('#nombreResultat').hide();

    $('#recherche').click(function(){
        $('.prev').show();
        $('.next').show();
        $('#nombreResultat').show();
    
    }) */
    

});
