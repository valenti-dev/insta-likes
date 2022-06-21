<? $version = '1.0.27'; ?>
</main>
<? include 'footer.php'; ?>
</div>
</body>
<? foreach ($styles as $style): ?>
    <link rel="<?= $style['rel']; ?>" href="<?= $style['href']; ?>?v=<?= $version; ?>" media="none" onload="if(media!='all')media='all'">
<? endforeach; ?>
<noscript>
    <? foreach ($styles as $style): ?>
        <link rel="<?= $style['rel']; ?>" href="<?= $style['href']; ?>?v=<?= $version; ?>">
    <? endforeach; ?>
</noscript>
<script src="/js/app.js?v=<?= $version; ?>"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
</html>
