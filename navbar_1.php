       <!-- Static navbar -->
      <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a target = "_blank" class="navbar-brand" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/">UPMC Master Info</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a target="_blank" href="about.php">A propos</a></li>
                <li><a target="_blank" href="contact.php">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sp&eacute;cialit&eacute;s<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/androide">ANDROIDE</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/bim">BIM</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/dac">DAC</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/ima">IMA</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/res">RES</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/sar">SAR</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/sesi">SESI</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/sfpn">SFPN</a></li>
                  <li><a target="_blank" href="http://www-master.ufr-info-p6.jussieu.fr/lmd/specialite/stl">STL</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
              <li class="active">
                  <a>                
                    <?php if(isset($_SESSION['prenom'])) echo "Bonjour ".$_SESSION['prenom'];
                        else echo "Bonjour";?> 
                    <span class="sr-only">(current)</span>
                  </a>
              </li>
                <li><a></a></li>
                <li><a></a></li>
                <li><a></a></li>
                <li><a></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>