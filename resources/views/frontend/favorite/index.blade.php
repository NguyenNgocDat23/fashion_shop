<!-- index.blade.php -->
@extends('frontend.base')
<!-- title -->
@section('title') Danh sách yêu thích @endsection 
<!-- content -->
@section('content')
<style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
    }
</style>
<div>
    <table id="customers">
  <tr>
    <th>Product</th>
    <th>Description</th>
    <th>Action</th>
  </tr>
  @forelse ($favorites as $data)
  <tr>
    <td> {{$data->product->name}}</td>  
    <td>{{$data->product->description}}</td>
    <td>
    <a style="color: #fff;
              border-radius: 4px;
              background: red;
              padding: 8px 16px;
              text-decoration: none;"
     href="{{route('favorite.destroy', $data->id)}}">Delete</a>
    </td>
  </tr>
  @empty
      <p style="text-align: center;">No favorites</p>
  @endforelse
</table>
    
</div>
@endsection
