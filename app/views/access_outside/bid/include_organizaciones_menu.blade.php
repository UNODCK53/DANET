      //Esta funcion permite realizar un segundo submenu en organizaciones
      $('.dropdown-submenu a.test').on("mouseover", function(e){
        $('.submenu').css('display','none');
        var submenu='#submenu_'+this.name;
        $(submenu).empty();
        var cod=this.name;
        organizaciones=[{{$array[1]}}];
        organizaciones_query=[];
        for (var i =0; i<organizaciones[0].length; i++){
          var position=organizaciones_query.length;
          if (organizaciones[0][i].cod_depto==cod){
            organizaciones_query[position]=organizaciones[0][i].acronim;
            $(submenu).append("<li><a tabindex='-1' href='bid_public_organizacion?id="+organizaciones[0][i].nit+"' name='"+organizaciones[0][i].nit+"''>"+organizaciones[0][i].acronim+"</a></li>")
          }              
        }
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
      });