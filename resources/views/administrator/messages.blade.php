@extends('layouts.admin')
@section('title')
    Messages
@stop
@section('header_files')
    <link rel="stylesheet" href="/css/admin_messages.css"/>

    <script src="/js/admin_messages.js" type="text/javascript"></script>
@stop

@section('content')

        <div class="container-fluid">
            <!--ADD YOUR CODE HERE -->
            @if(Session::has('message'))

               <div class="alert alert-success">{{Session('message')}}</div>
            @endif
            @if(count($messages) == 0)
                {{"No messages found!"}}
             @else   
            <div class="table-responsive">
              <table class="table  table-hover">
                <thead>
                      <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Delete</th>
                        <th>Replied</th>
                      </tr>
                    </thead>
                     <tbody> 
                     @foreach ($messages as $message) 
                          <tr>
                            <td>{{$message->created_at}}</td>

                            <td>{{$message->sender_name}}
                                <div class = "mail">
                                <span aria-hidden = "true"><</span>
                                {{$message->sender_email}}
                                <span aria-hidden = "true">></span>
                                </div>
                            </td>

                            <td><p>{{$message->message}}  </p>
                                
                                <button class="rep btn btn-success">Reply</button>
                            
                            <div class="first" style ="display: none;">
                                <form action="../admin/messages/{{$message->id}}" method="POST">
                                   {{csrf_field()}}
                                <textarea class="form-control" type ="input" name="Reply" placeholder="Write a Reply..."></textarea> 
                                <button class="sub btn btn-success" name = "submit" type="submit">Send</button>
                            </form>
                            </div>
                            </td>

                            <td>
                                <a href='/admin/deletemessage/{{$message->id}}'>
                             <span class = "glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </td>

                            <td >
                                @if($message->replied)
                             <span class = "glyphicon glyphicon-ok"></span>
                             @endif
                            </td>
                          </tr>
                          @endforeach
                          
                    </tbody>
              </table>
            </div>
            @endif

            <!--CODE ENDS HERE -->

        </div>
 @stop

