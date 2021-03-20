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
        <script src="{{asset('js/app.js')}}" type="text/JavaScript"> </script>
    </body>
</html>