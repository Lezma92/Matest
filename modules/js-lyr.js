		function onlyL(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
      var x = document.querySelectorAll('select');
      var y = M.FormSelect.init(x);
    });

      const login = document.querySelectorAll(".modal");
      M.Modal.init(login,{
        opacity:0.7,
        dismissible:false
      });

      document.querySelector("#content").style.display="none";
      document.querySelector("#flayer").classList.add("progress");
      document.querySelector("#slayer").classList.add("indeterminate");

      setTimeout(function(){
          document.querySelector("#flayer").classList.remove("progress");
          document.querySelector("#slayer").classList.remove("indeterminate");
          document.querySelector("#content").style.display="block";
      },3000)

      