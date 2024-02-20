<!-- bottom footer -->
<div class="content-footer hidden-print">
  <nav class="footer-right">
    <ul class="nav">
      <li>
        <?= $this->Html->link('Errores','mailto://info@mocla.us?subject=Jugada SuperLiga - Error en ' .Cake\Routing\Router::url(null,true))?>
      </li>
    </ul>
  </nav>
  <nav class="footer-left">
    <ul class="nav">
      <li>
        <a href="javascript:;">
          &copy; <?= date('Y')?> Jugada SuperLiga
        </a>
      </li>
      <li class="hidden-md-down">
        <?= $this->Html->link('Ayuda','mailto://info@mocla.us?subject=Jugada SuperLiga  - Ayuda en: ' .Cake\Routing\Router::url(null,true))?>
      </li>
    </ul>
  </nav>
</div>
<!-- /bottom footer -->
