window.addEventListener('load', () => {

  setTimeout(carga, 1500); //for local pages
  
  //carga(); 
  
    function carga () {
   
      //document.getElementById('circulo').className = 'hide';
  
      //document.getElementById('contenido').className = 'animated fadeInDown';
      // Error al cargar página, no se muestra sidenav
        
      if(document.getElementById('circulo').className = 'hide') {
          
          document.getElementById('contenido').className = 'animated fadeInDownBig';
          //fadeInDownBig   pulse   fadeInLeftBig   flipInX fadeInLeft
          
         }
    }
})