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
            
            button {
                margin: 50px;
                
            }
             svg {
                 height:30px;
                 width: 30px;

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
                 <h5>Exibindo {{$clientes->count()}} clientes de {{$clientes->total()}} ({{$clientes->firstItem()}} a {{$clientes->lastItem()}})</h5> <br>
                 <table class="table table-hover">
                     <thead>
                       <th scope="col">ID</th>
                       <th scope="col">Nome</th>
                       <th scope="col">Sobrenome</th>
                       <th scope="col">E-mail</th>
                     </thead>
                     <tbody>
                       @foreach($clientes as $cliente)
                         <tr>
                             <td>{{$cliente->id}}</td>
                             <td>{{$cliente->nome}}</td>
                             <td>{{$cliente->sobrenome}}</td>
                             <td>{{$cliente->email}}</td>
                         </tr>
                        @endforeach
                        </tbody>
                    </table>
             </div>
             <div class="card-footer">
                    {{ $clientes->onEachSide(2)->links() }}      
             </div>
          </div>
        </div>
        <button class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
        </button>
        <script src="{{asset('js/app.js')}}" type="text/JavaScript"> </script>
        <script type="text/JavaScript">

            function carregarClientes(pagina){ 
                $.get('/json', {page: pagina}, function(resp) { 
                    console.log(resp); 
                });
            }

            $(function() {
                 carregarClientes(2);
            });

        </script>
    </body>
</html>