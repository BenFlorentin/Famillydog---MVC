<div class="row" style="border-radius: 20px;background-color: white;opacity: 0.90;">
  <div class="col-xs-12 col-md-10">
    <fieldset>
      
      <?php 
      // inclure la gestion des erreurs
      require_once '../erreur/gestion_erreurs.php';
      require_once '../validation/gestion_validation.php';
      require_once '../include/unset.php';
      ?>

      <h1 class="text-center"> Famillydog</h1>
      <ul class="list-unstyled">
        <li><a href="https://www.facebook.com/Famillydog"><i class="fa fa-hand-o-right"></i> page Famillydog <i class="fa fa-facebook"></i></a></li>
        <li><a href="https://www.facebook.com/groups/277160812354444"><i class="fa fa-hand-o-right"></i> groupe Famillydog <i class="fa fa-facebook"></i></a></li>
      </ul>

      <br/><br/>
      <div class="row">
        <div class="col-xs-12 col-md-6 text-center">
          <em>Famillydog a été créer en ... par Alain CALABRO.
            Alain est passioné d'animaux. Il a travaillé pendant 20 ans comme agent de sécurité avec un chien.</em>
          </div>
          <div class="col-xs-12 col-md-6">
            <div class="fb-page" width="1000" height="730" data-href="https://www.facebook.com/Famillydog" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
              <div class="fb-xfbml-parse-ignore">
                <blockquote cite="https://www.facebook.com/Famillydog">
                  <a href="https://www.facebook.com/Famillydog">Famillydog</a>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  </html>


  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
