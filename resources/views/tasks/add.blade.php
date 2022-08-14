<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.3.4/parsley.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <link href="https://parsleyjs.org/src/parsley.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.3.4/parsley.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="antialiased">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row margin-top-5">
                            <h2 class ="col-md-10">Create New Task</h2>
                            <div>
                                <a href = "{{ URL::to('/tasks') }}"><button class="btn btn-danger pull-right"><i class="fa fa-fw fa-remove"></i>Cancel</button></a>
                            </div>
                        </div>
        
                        {!! Form::open(array('action'=>'TaskController@store','files' => true,'data-parsley-validate'=>'true')) !!}
                            <div class="form-group">
                                <label>Task Name</label>
                                {!! Form::text('name',null,array('class'=>'form-control','type'=>'text','data-parsley-required'=>'true')) !!}
                                </div>
                                <div class="form-group">
                                <label>Task Priority</label>
                                {!! Form::text('priority',null,array('class'=>'form-control', 'data-parsley-required'=>'true', 'data-parsley-min'=> '1', 'data-parsley-type'=>'number')) !!}
                                </div>
                                <div class="form-group"> 
                                    <label>Project</label>
                                   {!! Form::select('project_id', 
                                          array('' => 'Select a Project for task') + $projects,
                                          '',
                                          array('class' => 'form-control','data-parsley-required'=>true)) 
                                    !!}
                                </div>
                                <div class ="row">
                                    <div class ="col-md-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
