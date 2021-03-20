<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>Paginação</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         <style>
             body {
                 padding:20px;
                 margin:10px;
             }
             
            
         </style>
    </head>
    <body>
        <div class="container">
          <div class="card text-center">
             <div class="card-header">
                 Tabela de Clientes
             </div>
             <div class="card-body">
                 <div class='card-title' id='cardTitle'>

                 </div>
                 <table id="tabelaClientes" class="table table-hover">
                     <thead>
                       <th scope="col">ID</th>
                       <th scope="col">Nome</th>
                       <th scope="col">Sobrenome</th>
                       <th scope="col">E-mail</th>
                     </thead>
                     <tbody>
                        
                        </tbody>
                    </table>
             </div>
             <div class="card-footer">
                <nav id="paginator">
                    <ul class="pagination">
                        <!--
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    -->
                    </ul>
                  </nav>
             </div>
          </div>
        </div>
        <script src="{{asset('js/app.js')}}" type="text/JavaScript"></script>
        <script type="text/JavaScript">

            function getProximoItem(data) {
                i = data.current_page + 1;
                if(data.current_page == data.last_page) {
                    s = '<li class="page-item disabled">'
                } else {
                    s = '<li class="page-item">'
                }
                s += '<a class="page-link" pagina="' + i + '" href="#">Próximo</a></li>'
                return s; 
            }
            
            function getItemAnterior(data) {
                i = data.current_page - 1;
                if(data.current_page == 1) {
                    s = '<li class="page-item disabled">'
                } else {
                    s = '<li class="page-item">'
                }
                s += '<a class="page-link"' + ' pagina="'+  i +'" href="#">Anterior</a></li>'
                return s; 
            }

            function getItem(data, i) {
              if(data.current_page == i) {
                s = '<li class="page-item active">'
              } else {
                 s = '<li class="page-item">'
              }
             s += '<a class="page-link" ' + ' pagina="'+  i  +'" href="#">'+ i + '</a></li>'
             return s; 
            }

            function lastPage(data) {
                if(data.current_page != data.last_page)
                return "<li class='page-item'><a class='page-link' pagina='"+ data.last_page + "' href='#'>" + data.last_page + "</a></li>"
            }

            function spaceMore(data) {
                i = data.current_page + 5;
                return "<li class='page-item'><a class='page-link' pagina='"+ i + "' href='#'>...</a></li>";
            }

            function spaceLess(data) {
                i = data.current_page - 5;
                return "<li class='page-item'><a class='page-link' pagina='"+ i + "' href='#'>...</a></li>";
            }
        
            function montarPaginator(data) {
                $('#paginator>ul>li').remove();
                $('#paginator>ul').append(getItemAnterior(data)); 
                if(data.current_page - 3 > 1) {
                    $('#paginator>ul').append(getItem(data,1));
                    $('#paginator>ul').append(spaceLess(data));
                }               
                n = 4 ;
                /* 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 */
                if(data.current_page - n/2 <= 2){
                    inicio = 1;
                    fim = inicio + n;
                }
                else if(data.last_page - data.current_page <= n) {
                   inicio = data.current_page - 4;
                   fim = data.last_page;
                }
                else  {
                    inicio = data.current_page - 2; 
                    fim = data.current_page + 2;      
                }
                for(i= inicio; i <= fim; i++) {
                   s = getItem(data, i);
                   $('#paginator>ul').append(s);
                }
                if( data.last_page - data.current_page > 4) {
                    $('#paginator>ul').append(spaceMore(data));
                    $('#paginator>ul').append(lastPage(data));
                } 

                $('#paginator>ul').append(getProximoItem(data));
            }

            function montarLinha(cliente){
                return '<tr>' +
                          '<td>'+cliente.id+'</td>' +
                          '<td>'+ cliente.nome+ '</td>' +
                          '<td>' + cliente.sobrenome + '</td>' +
                          '<td>' + cliente.email + '</td>' +
                        '</tr>';
            }

            function montarTabela(data){
               $('#tabelaClientes>tbody>tr').remove();
                for(i = 0; i < data.data.length; i++) {
                   line = montarLinha(data.data[i]);
                   $('#tabelaClientes>tbody').append(line);
                }
            }

            function carregarClientes(paginate){ 
                $.get('api/json', {page:paginate}, function(resp) { 
                    console.log(resp); 
                    montarTabela(resp);
                    montarPaginator(resp);
                    $('#paginator>ul>li>a').click(function(){
                        carregarClientes($(this).attr('pagina'));
                    });
                    $('#cardTitle').html('Exibindo ' + resp.per_page + ' clientes de ' +
                    resp.total + ' ( ' + resp.from + ' à ' + resp.to + ')' );
                });
            }

            $(function(){
               carregarClientes(1);
            });

        </script>
    </body>
</html>