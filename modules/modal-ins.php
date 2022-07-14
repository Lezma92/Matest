    <!-- Modal  -->
    <div class="container section">

      <!-- Modal Structure -->
      <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content teal darken-2 white-text">
            <h4 class="flow-text center">INSTRUCCIONES</h4>
            <p class="ins">Antes de realizar el siguiente examen procura leer y examinar detenidamente la pregunta.</p>
            <p>Mucha suerte!</p>
        </div>
        <div class="modal-footer teal darken-1">
          <a href="../views/questions.php" class="modal-close waves-effect waves-green btn-flat">Realizar examen</a>
        </div>
      </div>

    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var el = document.querySelectorAll('.modal');
        var op = M.Modal.init(el, {
          /*dismissible: false,*/
          opacity: 0.8,
          isOpen: true
        });
      });
    </script>

    