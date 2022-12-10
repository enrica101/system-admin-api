<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        #data {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #data td, #data th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #data tr:nth-child(even){background-color: #f2f2f2;}
        
        #data tr:hover {background-color: #ddd;}
        
        #data th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #04AA6D;
          color: white;
        }
        </style>
    <title>Export PDF</title>
</head>
<body>
    <h1>Requests</h1>

<table id="data">
  <tr>
    <th>Request ID</th>
    <th>User ID</th>
    <th>Requester</th>
    <th>Responder ID</th>
    <th>Responder</th>
    <th>Type</th>
    <th>Location</th>
    <th>Status</th>
    <th>Created At</th>
  </tr>
  {{-- @dump(count($requests)); --}}
  {{-- @unless(count($requests) != null) --}}
  @if(count($requests) != 0)
 @forEach($requests as $request)
  <tr>
    <td>{{$request['requestId']}}</td>
    <td>{{$request['userId']}}</td>
    <td>{{$request['requester']}}</td>
    <td>{{$request['responderId']}}</td>
    <td>{{$request['responder']}}</td>
    <td>{{$request['type']}}</td>
    <td>{{$request['location']}}</td>
    <td>{{$request['status']}}</td>
    <td>{{$request['created_at']}}</td>
  </tr>
  @endforeach
    @else
    <tr>No records.</tr>
    @endif
    
   {{-- @endunless --}}
</table>

</body>
</html>