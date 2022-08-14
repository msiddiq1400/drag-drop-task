<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Task Management</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="antialiased">
        <div class ="row" style="align-items: center">
            <div class ="col-md-2 margin-add-button">
                <a href = "{{ URL::to('tasks/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus-square"></i>Add New Task </button></a>
            </div>
            {{-- <select class="selectpicker col-md-2" style="margin-bottom:15px; margin-top: 15px">
                <option value="1">Project 1</option>
                <option value="2">Project 2</option>
            </select> --}}
              
            @if (session('status'))
                <div style = "color:white; margin-left:25px; margin-bottom:5px" >
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                   <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Project Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="tablecontents">
                                    @foreach ($tasks as $task)
                                        <tr class="row1" data-id="{{$task['id']}}">
                                            <td width="150">{{$task['id']}}</td>                            
                                            <td width="150">{{$task['name']}}</td> 
                                            <td width="150">{{$task['priority']}}</td> 
                                            <td width="150">{{$task['project_name']}}</td> 
                                            @php
                                                $id = $task['id']
                                            @endphp   
                                            <td width="150">
                                                <a class="btn btn-warning col-md-7" href="{!! URL::to("tasks/$id/edit") !!}"> Edit</a>
                                            </td> 
                                            <td width="150">
                                                <a class="btn btn-danger col-md-7" href="{!! URL::to("tasks/$id/delete") !!}"> Delete</a>
                                            </td>                                 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              updatePriorities();
          }
        });

        function updatePriorities() {
          var priority = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            priority.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('updatePriority') }}",
            data: {
              priority: priority,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
    </body>
</html>

