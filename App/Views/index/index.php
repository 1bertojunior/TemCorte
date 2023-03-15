<?php
    $website = $info ["website"];
	$website_info = $website["info"];
	$website_address = $website["address"];
	$website_social = $website["social"];
    // echo "<pre>";
	// print_r($website_social);
?>


<section class="banner-area">
    <div class="banner-img"></div>
    <h1>O local para <span>grandes homens</span></h1>
    <h3>A <?= $website_info['name'] ?> é o local ideal para grandes homens,que tem como objetivo cortar o cabelo e barbear de forma clássica e relaxante… Homens que valorizam um <strong>ambiente confortável, em uma atmosfera vintage</strong>, buscando não somente um corte bem feito, como uma experiência única e divertida!</h3>
    <a class="banner-btn" href="/scheduling">Agendamento</a>
</section>

<section class="services-area" id="services">
    <!-- <h6 class="section-title">Venha desfrutar do melhor estabelecimento.</h6> -->
    <h3 class="section-title">O melhor lhe espera!</h3>
    <ul class="services-content">
        <li>
            <i class="fa fa-check "></i>
            <h4>Qualidade</h4>
            <p>Vindo ao mercado de uma forma <strong>inovadora</strong> para realçar a beleza do público masculino, proporcionando um serviço de maior <em>qualidade!</em></p>
        </li>
        <li>
            <i class="fa fa-wifi"></i>
            <h4>Internet Gratuita</h4>
            <p>Navegue com internet 100% gratuita! Fique sempre <strong>conectado</strong> com internet de alta velocidade em nosso estabelecimento.</p>
        </li>
        <li>
            <i class="fa fa-calendar"></i>
            <h4>Agendamento</h4>
            <p>A inovação que você esperava!<strong> Otimize</strong> significativamente seu tempo, marque o seu melhor horário totalmente online.</p>
        </li>
    </ul>
</section>

<!-- <section class="about-area" id="about">
    <h3 class="section-title">Últimas notícias</h3>
    <ul class="about-content">
        <li class="about-left"></li>
        <li class="about-right">
            <h2>Cabeleireiro de Belém do Piauí participa de maior evento para Barbeiros do Mundo</h2>
            <p>Buscando se qualificar e adquirir novos conhecimentos a frente do mercado o profissional em cortes e designer de cabelos e barba, Israel Carvalho, de Belém do Piauí viajou cerca de …</p>
            <a class="about-btn" href="">Leia mais</a>
        </li>
    </ul>
</section> -->

<section class="contact-area" id="contact">
    <h3 class="section-title">Contatos</h3>
    <ul class="contact-content">
        <li>
            <i class="fa fa-map-marker"></i>
            <p><?= $website_address['city'] ?> - <?= $website_address['initials_state'] ?></p>
            <!-- <?= $website_address['name'] ?> -->
        </li>
        <li>
            <i class="fa fa-phone"></i>
            <p><?= $website_info['phone_mask'] ?><br>
            </p>
        </li>
        <li>
            <i class="fa fa-envelope"></i>
            <p><?= $website_info['email'] ?></p>
        </li>
    </ul>
</section>

<section class="contact-sociais" id="sociais">
    <h3 class="section-title-sociais">Siga nossas redes sociais!</h3>
    <ul class="sociais-content">
        <li>
            <a href="https://facebook.com/<?= $website_social['facebook'] ?>"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/<?= $website_social['instagram'] ?>"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
            <a href="https://wa.me/<?= $website_social['whatsapp'] ?>"><i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a>
            <!-- <i class="fa-brands fa-facebook"></i>
            <i class="fa fa-whatsapp"></i> -->
        </li>

    </ul>
</section>